<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class BkashController extends Controller
{
    private $base_url;
    private $username;
    private $password;
    private $app_key;
    private $app_secret;

    public function __construct()
    {
        env('SANDBOX') ? $this->base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta' : $this->base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta';
        $this->username = env('BKASH_USERNAME');
        $this->password = env('BKASH_PASSWORD');
        $this->app_key = env('BKASH_APP_KEY');
        $this->app_secret = env('BKASH_APP_SECRET');
    }
    public function authHeaders()
    {
        return array(
            'Content-Type:application/json',
            'Authorization:' . $this->grant(),
            'X-APP-Key:' . $this->app_key
        );
    }

    public function curlWithBody($url, $header, $method, $body_data)
    {
        $curl = curl_init($this->base_url . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body_data);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    function getIdTokenFromRefreshToken($refresh_token)
    {

        $header = array(
            'Content-Type:application/json',
            'username:' . $this->username,
            'password:' . $this->password
        );

        $body_data = array('app_key' => $this->app_key, 'app_secret' => $this->app_secret, 'refresh_token' => $refresh_token);

        $response = $this->curlWithBody('/tokenized/checkout/token/refresh', $header, 'POST', json_encode($body_data));

        $idToken = json_decode($response)->id_token;

        return $idToken;
    }

    public function grant()
    {

        if (!Schema::hasTable('bkash_token')) {
            DB::beginTransaction();
            Schema::create('bkash_token', function ($table) {
                $table->boolean('sandbox_mode')->notNullable();
                $table->bigInteger('id_expiry')->notNullable();
                $table->string('id_token', 2048)->notNullable();
                $table->bigInteger('refresh_expiry')->notNullable();
                $table->string('refresh_token', 2048)->notNullable();
            });
            $insertedRows = DB::table('bkash_token')->insert([
                'sandbox_mode' => 1,
                'id_expiry' => 0,
                'id_token' => 'id_token',
                'refresh_expiry' => 0,
                'refresh_token' => 'refresh_token',
            ]);

            if ($insertedRows > 0) {

                // echo 'Row inserted successfully.';
            } else {
                echo 'Error inserting row.';
            }



            $insertedRows = DB::table('bkash_token')->insert([
                'sandbox_mode' => 0,
                'id_expiry' => 0,
                'id_token' => 'id_token',
                'refresh_expiry' => 0,
                'refresh_token' => 'refresh_token',
            ]);

            if ($insertedRows > 0) {
                // echo 'Row inserted successfully.';

            } else {
                echo 'Error inserting row.';
            }
            // DB::commit();
        }


        DB::beginTransaction();

        $sandbox = env('SANDBOX');

        $tokenData = DB::table('bkash_token')->where('sandbox_mode', $sandbox)->first();

        if ($tokenData) {
            // Access the token data
            $idExpiry = $tokenData->id_expiry;
            $idToken = $tokenData->id_token;
            $refreshExpiry = $tokenData->refresh_expiry;
            $refreshToken = $tokenData->refresh_token;

            if ($idExpiry > time()) {
                // dd("Id token from db: ".$idToken);
                return $idToken;
            }
            if ($refreshExpiry > time()) {
                $idToken = $this->getIdTokenFromRefreshToken($refreshToken);
                $updatedRows = DB::table('bkash_token')
                    ->where('sandbox_mode', $sandbox)
                    ->update([
                        'id_expiry' => time() + 3600, // Set new expiry time
                        'id_token' => $idToken,
                    ]);

                if ($updatedRows > 0) {
                    DB::commit();
                    //echo 'Rows updated successfully.';
                } else {
                    //echo 'Error updating rows.';
                }
                // dd("Id token from refresh api: ".$idToken);
                return $idToken;
            }
            // Do something with the token data
        } else {
            echo 'Token not found.';
        }


        $header = array(
            'Content-Type:application/json',
            'username:' . $this->username,
            'password:' . $this->password
        );

        $body_data = array('app_key' => $this->app_key, 'app_secret' => $this->app_secret);

        $response = $this->curlWithBody('/tokenized/checkout/token/grant', $header, 'POST', json_encode($body_data));

        $idToken = json_decode($response)->id_token;

        $updatedRows = DB::table('bkash_token')
            ->where('sandbox_mode', $sandbox)
            ->update([
                'id_expiry' => time() + 3600, // Set new expiry time
                'id_token' => $idToken,
                'refresh_expiry' => time() + 864000,
                'refresh_token' => json_decode($response)->refresh_token,
            ]);

        if ($updatedRows > 0) {
            DB::commit();
            //echo 'Rows updated successfully.';
        } else {
            //echo 'Error updating rows.';
        }
        // dd("Id token from grant api: ".$idToken);
        return $idToken;
    }

    public function payment(Request $request)
    {
        return view('bkash.pay');
    }

    public function createPayment(Request $request)
    {
        if (!$request->total_amount || $request->total_amount < 1) {
            return response()->json(['error' => 'You should pay greater than 1 TK !!'], 400);
        }



        $header = $this->authHeaders();

        try {
            if (Auth::check()) {
                $user_id = auth()->id();
            } else {
                $user = User::where('phone', $request->input('phone'))->first();
                if ($user) {
                    Auth::login($user);
                    $request->session()->regenerate();
                } else {
                    $password = Str::random(8); // or you can change 8 to any desired length
                    $hashedPassword = Hash::make($password);
                    $user = User::create([
                        'phone'    => $request->input('phone'),
                        'name'     => $request->input('name'),
                        'thana'    => $request->input('thana'),
                        'district' => $request->input('district'),
                        'status'   => 'active',
                        'password' => $hashedPassword,
                    ]);

                    // Log the user in after registration
                    Auth::login($user);
                    $request->session()->regenerate();
                }
                // Get the user ID to track their order
                $user_id = auth()->id();
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Check Your Mobile Number Correctly.');
            return redirect()->back()->withInput();
        }


        ini_set('max_execution_time', 300);
        $totalAmount = preg_replace('/[^0-9.]/', '', $request->input('total_amount'));
        $validator = Validator::make($request->all(), [
            'name'           => 'nullable|string|max:255',
            'address'        => 'nullable|string',
            'email'          => 'nullable|email',
            'phone'          => 'required|string|max:20',
            'thana'          => 'nullable|string',
            'district'       => 'nullable|string',
            'order_note'     => 'nullable|string',
            'sub_total'      => 'nullable',
            'total_amount'   => 'required|min:0',
        ], [
            'order_note.string'     => 'The order note must be a string.',
            'total_amount.required' => 'The total amount is required.',
            'total_amount.numeric'  => 'The total amount must be a number.',
            'total_amount.min'      => 'The total amount must be at least 0.',
            'shipping_id.required'  => 'The shipping method is required.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

        try {
            // Get the next order number
            $typePrefix = 'JL';
            $year = date('Y');
            $lastCode = Order::where('order_number', 'like', $typePrefix . '-' . $year . '%')
                ->orderBy('id', 'desc')
                ->first();
            $newNumber = $lastCode ? (int) substr($lastCode->order_number, strlen($typePrefix . '-' . $year)) + 1 : 1;
            $code = $typePrefix . '-' . $year . $newNumber;
            $shipping_method = ShippingMethod::find($request->input('shipping_id'));
            if ($shipping_method) {
                $shipping_method_id = $shipping_method->id;
                $shipping_charge = $shipping_method->price;
            } else {
                $shipping_charge = 130;
                $totalAmount = $totalAmount + $shipping_charge;
                $shipping_method_id = null;
            }
            // $order = Order::create([
            //     'order_number'       => $code,
            //     'user_id'            => $user_id,
            //     'shipping_method_id' => $shipping_method_id,
            //     'sub_total'          => $request->input('sub_total'),
            //     'quantity'           => Cart::instance('cart')->count(),
            //     'shipping_charge'    => $shipping_charge,
            //     'total_amount'       => $totalAmount,
            //     'payment_status'     => 'cod',
            //     // 'payment_status'     => $request->input('payment_status'),
            //     'status'             => 'pending',
            //     'name'               => $request->input('name'),
            //     'email'              => $request->input('email'),
            //     'phone'              => $request->input('phone'),
            //     'thana'              => $request->input('thana'),
            //     'district'           => $request->input('district'),
            //     'address'            => $request->input('address'),
            //     'order_note'         => $request->input('order_note'),
            //     'created_by'         => $user_id,
            //     'order_created_at'   => Carbon::now(),
            //     'created_at'         => Carbon::now(),
            // ]);

            // foreach (Cart::instance('cart')->content() as $item) {
            //     OrderItem::create([
            //         'order_id'      => $order->id,
            //         'product_id'    => $item->id,
            //         'user_id'       => $user_id,
            //         'product_name'  => $item->name,
            //         'product_color' => $item->model->color ?? null,
            //         'product_sku'   => $item->model->sku ?? null,
            //         'size'          => $item->options->size ?? null,
            //         'price'         => $item->price,
            //         'tax'           => $item->tax ?? 0,
            //         'quantity'      => $item->qty,
            //         'subtotal'      => $item->qty * $item->price,
            //     ]);

            //     // Update product stock
            //     $product = Product::find($item->id);
            //     $product->update([
            //         'box_stock' => $product->box_stock - $item->qty,
            //     ]);
            // }

            // Commit the transaction
            DB::commit();

            // Clear the cart after successful order
            Cart::instance('cart')->destroy();
            Session::flash('success', 'Order placed successfully!');
            // return redirect()->route('bkash.payment', $order->order_number);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput();
        }

        $website_url = URL::to("/user/order/history");

        $body_data = array(
            'mode' => '0011',
            'payerReference' => $code ? $code : $request->input('phone'), // pass oderId or anything
            'callbackURL' => $website_url,
            // 'callbackURL' => $website_url . '/bkash-callback',
            'amount' => $request->total_amount,
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => $code ? $code : "Inv_" . Str::random(6)
        );

        $response = $this->curlWithBody('/tokenized/checkout/create', $header, 'POST', json_encode($body_data));

        // dd($response);

        return redirect((json_decode($response)->bkashURL));
    }

    public function executePayment($paymentID)
    {

        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID
        );


        $response = $this->curlWithBody('/tokenized/checkout/execute', $header, 'POST', json_encode($body_data));

        return $response;
    }
    public function queryPayment($paymentID)
    {
        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/status', $header, 'POST', json_encode($body_data));

        return $response;
    }

    public function callback(Request $request)
    {
        $allRequest = $request->all();
        if (isset($allRequest['status']) && $allRequest['status'] == 'success') {
            $response = $this->executePayment($allRequest['paymentID']);

            // dd($response);
            if (is_null($response)) {
                sleep(1);
                $response = $this->queryPayment($allRequest['paymentID']);
            }

            $res_array = json_decode($response, true);

            if (array_key_exists("statusCode", $res_array) && $res_array['statusCode'] == '0000' && array_key_exists("transactionStatus", $res_array) && $res_array['transactionStatus'] == 'Completed') {
                // payment success case
                return view('bkash.success')->with([
                    'response' => $res_array['trxID']
                ]);
            }

            return view('bkash.fail')->with([
                'response' => $res_array['statusMessage'],
            ]);
        } else {
            return view('bkash.fail')->with([
                'response' => 'Payment Failed !!',
            ]);
        }
    }
    public function getRefund(Request $request)
    {
        return view('bkash.refund');
    }

    public function refundPayment(Request $request)
    {
        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $request->paymentID,
            'trxID' => $request->trxID
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/refund', $header, 'POST', json_encode($body_data));

        $res_array = json_decode($response, true);

        $message = "Refund Failed !!";

        if (!isset($res_array['refundTrxID'])) {

            $body_data = array(
                'paymentID' => $request->paymentID,
                'amount' => $request->amount,
                'trxID' => $request->trxID,
                'sku' => 'sku',
                'reason' => 'Quality issue'
            );

            $response = $this->curlWithBody('/tokenized/checkout/payment/refund', $header, 'POST', json_encode($body_data));

            $res_array = json_decode($response, true);

            if (isset($res_array['refundTrxID'])) {
                // your database insert operation
                $message = "Refund successful !!.Your Refund TrxID : " . $res_array['refundTrxID'];
            }
        } else {
            $message = "Already Refunded !!.Your Refund TrxID : " . $res_array['refundTrxID'];
        }

        return view('bkash.refund')->with([
            'response' => $message,
        ]);
    }

    public function queryPaymentAPI(Request $request, $paymentID)
    {
        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/status', $header, 'POST', json_encode($body_data));

        return $response;
    }


    public function getSearchTransaction(Request $request)
    {
        return view('bkash.search');
    }

    public function searchTransaction(Request $request)
    {

        $header = $this->authHeaders();
        $body_data = array(
            'trxID' => $request->trxID,
        );

        $response = $this->curlWithBody('/tokenized/checkout/general/searchTransaction', $header, 'POST', json_encode($body_data));


        return view('bkash.search')->with([
            'response' => $response,
        ]);
    }
}
