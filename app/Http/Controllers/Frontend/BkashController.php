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
use App\Models\ProductSizeStock;
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
        ini_set('max_execution_time', 300);
        $totalAmount = preg_replace('/[^0-9.]/', '', $request->input('total_amount'));
        $validator = Validator::make($request->all(), [
            'name'           => 'required|string|max:255',
            'address'        => 'required|string',
            'email'          => 'nullable|email',
            'phone'          => 'required|regex:/^\+?[0-9]{11,15}$/',
            'thana'          => 'required|string',
            'district'       => 'nullable|string',
            'order_note'     => 'nullable|string',
            'sub_total'      => 'nullable',
            'total_amount'   => 'required|min:0',
        ], [
            'order_note.string'     => 'The order note must be a string.',
            'phone.required'        => 'The phone number is required.',
            'phone.regex'           => 'Please enter a valid phone number (11–15 digits).',
            'total_amount.required' => 'The total amount is required.',
            'total_amount.numeric'  => 'The total amount must be a number.',
            'total_amount.min'      => 'The total amount must be at least 0.',
            'name.required'         => 'The name is required.',
            'name.string'           => 'The name must be a string.',
            'name.max'              => 'The name may not be greater than 255 characters.',
            'address.required'      => 'The address is required.',
            'address.string'        => 'The address must be a string.',
            'email.email'           => 'The email must be a valid email address.',
            'thana.required'        => 'The thana is required.',
            'thana.string'          => 'The thana must be a string.',
            'district.string'       => 'The district must be a string.',
            'sub_total.numeric'     => 'The sub total must be a number.',
            'sub_total.min'         => 'The sub total must be at least 0.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

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

                }
                // Get the user ID to track their order
                $user_id = $user->id;
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Check Your Mobile Number Correctly.');
            return redirect()->back()->withInput();
        }
        // Validate and store order-related data in session
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

        // Store data in session
        session([
            'bkash_checkout_data' => [
                'order_number'       => $code,
                'user_id'            => $user_id,
                'shipping_method_id' => $shipping_method_id,
                'sub_total'          => $request->input('sub_total'),
                'quantity'           => Cart::instance('cart')->count(),
                'shipping_charge'    => $shipping_charge,
                'total_amount'       => $totalAmount,
                'payment_status'     => 'unpaid',
                // 'payment_status'     => $request->input('payment_status'),
                'status'             => 'pending',
                'name'               => $request->input('name'),
                'email'              => $request->input('email'),
                'phone'              => $request->input('phone'),
                'thana'              => $request->input('thana'),
                'district'           => $request->input('district'),
                'address'            => $request->input('address'),
                'order_note'         => $request->input('order_note'),
                'created_by'         => $user_id,
                'order_created_at'   => Carbon::now(),
                'created_at'         => Carbon::now(),
            ]
        ]);

        $website_url = URL::to("/");

        $body_data = array(
            'mode' => '0011',
            'payerReference' => $code ? $code : $request->input('phone'), // pass oderId or anything
            'callbackURL' => $website_url . '/bkash-callback',
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

        if (isset($allRequest['status']) && $allRequest['status'] === 'success') {
            $response = $this->executePayment($allRequest['paymentID']);

            if (is_null($response)) {
                sleep(1);
                $response = $this->queryPayment($allRequest['paymentID']);
            }

            $res_array = json_decode($response, true);

            if (
                isset($res_array['statusCode'], $res_array['transactionStatus']) &&
                $res_array['statusCode'] === '0000' &&
                $res_array['transactionStatus'] === 'Completed'
            ) {
                $data = session('bkash_checkout_data');
                // dd($data);
                // ✅ Protect against missing session
                if (!$data) {
                    return view('bkash.fail')->with([
                        'response' => 'Session expired. Please try again.',
                    ]);
                }

                DB::beginTransaction(); // ✅ START TRANSACTION

                try {
                    // Create order
                    $order = Order::create([
                        'order_number'       => $data['order_number'],
                        'user_id'            => $data['user_id'],
                        'shipping_method_id' => $data['shipping_method_id'],
                        'sub_total'          => $data['sub_total'],
                        'quantity'           => $data['quantity'], // ✅ Use stored quantity
                        'shipping_charge'    => $data['shipping_charge'],
                        'total_amount'       => $data['total_amount'],
                        'payment_status'     => 'paid',
                        'status'             => 'pending',
                        'name'               => $data['name'],
                        'email'              => $data['email'],
                        'phone'              => $data['phone'],
                        'thana'              => $data['thana'],
                        'district'           => $data['district'],
                        'address'            => $data['address'],
                        'order_note'         => $data['order_note'],
                        'created_by'         => $data['user_id'],
                        'order_created_at'   => $data['order_created_at'],
                        'created_at'         => $data['created_at'],
                    ]);

                    // Create order items from current cart
                    foreach (Cart::instance('cart')->content() as $item) {
                        OrderItem::create([
                            'order_id'      => $order->id,
                            'product_id'    => $item->id,
                            'user_id'       => $data['user_id'],
                            'product_name'  => $item->name,
                            'product_color' => $item->model->color ?? null,
                            'product_sku'   => $item->model->sku ?? null,
                            'size'          => $item->options->size ?? null,
                            'price'         => $item->price,
                            'tax'           => $item->tax ?? 0,
                            'quantity'      => $item->qty,
                            'subtotal'      => $item->qty * $item->price,
                        ]);

                        if (!is_null($item->options->size)) {
                            $productSize = ProductSizeStock::where('product_id', $item->id)
                                ->where('size', $item->options->size)
                                ->first();

                            if ($productSize) {
                                $productSize->decrement('stock', $item->qty);
                            }
                        }
                    }

                    DB::commit();

                    Cart::instance('cart')->destroy();
                    session()->forget('bkash_checkout_data'); // ✅ Clear session
                    $user = User::find($data['user_id']);
                    Auth::login($user);
                    $request->session()->regenerate();
                    Session::flash('success', 'Order placed successfully!');

                    $data = [
                        'pendingOrdersCount'   => Order::latest('id')->where('status', 'pending')->count(),
                        'deliveredOrdersCount' => Order::latest('id')->where('status', 'delivered')->count(),
                        'orders'               => Order::with('orderItems')->where('user_id', Auth::id())->latest('id')->get(),
                        'latest_order'         => Order::where('user_id', Auth::id())->latest('id')->first(['total_amount']),
                        'response'             => $res_array['trxID']
                    ];

                    return view('user.pages.orderHistory', $data);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return view('bkash.fail')->with([
                        'response' => 'Order creation failed: ' . $e->getMessage(),
                    ]);
                }
            }

            return view('bkash.fail')->with([
                'response' => $res_array['statusMessage'] ?? 'Payment error',
            ]);
        }

        return view('bkash.fail')->with([
            'response' => 'Payment Failed !!',
        ]);
    }


    // public function callback(Request $request)
    // {
    //     $allRequest = $request->all();
    //     if (isset($allRequest['status']) && $allRequest['status'] == 'success') {
    //         $response = $this->executePayment($allRequest['paymentID']);

    //         // dd($response);
    //         if (is_null($response)) {
    //             sleep(1);
    //             $response = $this->queryPayment($allRequest['paymentID']);
    //         }

    //         $res_array = json_decode($response, true);

    //         if (array_key_exists("statusCode", $res_array) && $res_array['statusCode'] == '0000' && array_key_exists("transactionStatus", $res_array) && $res_array['transactionStatus'] == 'Completed') {
    //             $data = session('bkash_checkout_data');
    //             $order = Order::create([
    //                 'order_number'       => $data['order_number'],
    //                 'user_id'            => $data['user_id'],
    //                 'shipping_method_id' => $data['shipping_method_id'],
    //                 'sub_total'          => $data['sub_total'],
    //                 'quantity'           => Cart::instance('cart')->count(),
    //                 'shipping_charge'    => $data['shipping_charge'],
    //                 'total_amount'       => $data['total_amount'],
    //                 'payment_status'     => 'paid',
    //                 'status'             => 'pending',
    //                 'name'               => $data['name'],
    //                 'email'              => $data['email'],
    //                 'phone'              => $data['phone'],
    //                 'thana'              => $data['thana'],
    //                 'district'           => $data['district'],
    //                 'address'            => $data['address'],
    //                 'order_note'         => $data['order_note'],
    //                 'created_by'         => $data['user_id'],
    //                 'order_created_at'   => $data['order_created_at'],
    //                 'created_at'         => $data['created_at'],
    //             ]);

    //             foreach (Cart::instance('cart')->content() as $item) {
    //                 OrderItem::create([
    //                     'order_id'      => $order->id,
    //                     'product_id'    => $item->id,
    //                     'user_id'       => $data['user_id'],
    //                     'product_name'  => $item->name,
    //                     'product_color' => $item->model->color ?? null,
    //                     'product_sku'   => $item->model->sku ?? null,
    //                     'size'          => $item->options->size ?? null,
    //                     'price'         => $item->price,
    //                     'tax'           => $item->tax ?? 0,
    //                     'quantity'      => $item->qty,
    //                     'subtotal'      => $item->qty * $item->price,
    //                 ]);

    //                 if (!is_null($item->options->size)) {
    //                     $productSize = ProductSizeStock::where('product_id', $item->id)->where('size', $item->options->size)->first();
    //                     if ($productSize) {
    //                         $productSize->decrement('stock', $item->qty);
    //                     }
    //                 }
    //             }

    //             DB::commit();

    //             Cart::instance('cart')->destroy();
    //             session()->forget('bkash_checkout_data'); // clear session
    //             Session::flash('success', 'Order placed successfully!');
    //             $data = [
    //                 'pendingOrdersCount'   => Order::latest('id')->where('status', 'pending')->count(),
    //                 'deliveredOrdersCount' => Order::latest('id')->where('status', 'delivered')->count(),
    //                 'orders'               => Order::with('orderItems')->where('user_id', Auth::user()->id)->latest('id')->get(),
    //                 'latest_order'         => Order::where('user_id', Auth::user()->id)->latest('id')->first(['total_amount']),
    //                 'response'             => $res_array['trxID']
    //             ];
    //             return view('user.pages.orderHistory', $data);
    //         }

    //         return view('bkash.fail')->with([
    //             'response' => $res_array['statusMessage'],
    //         ]);
    //     } else {
    //         return view('bkash.fail')->with([
    //             'response' => 'Payment Failed !!',
    //         ]);
    //     }
    // }

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
