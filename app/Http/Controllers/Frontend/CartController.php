<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Wishlist;
use App\Models\OrderItem;
use App\Mail\UserOrderMail;
use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Symfony\Component\Console\Logger\ConsoleLogger;

class CartController extends Controller
{

    public function addToCart(Request $request, $id)
    {
        try {
            // Find the product or fail
            $product = Product::findOrFail($id);
            $quantity = $request->input('quantity', 1); // Default to 1 if no quantity is provided

            if (!empty($product->unit_price) || !empty($product->unit_discount_price)) {
                Cart::instance('cart')->add([
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $quantity,
                    'price' => !empty($product->unit_discount_price) ? $product->unit_discount_price : $product->unit_price,
                ])->associate('App\Models\Product');

                $formattedSubtotal = Cart::instance('cart')->subtotal();
                $cleanSubtotal = preg_replace('/[^\d.]/', '', $formattedSubtotal);
                $subTotal = (float)$cleanSubtotal;
                // Get the updated cart content
                $data = [
                    'cartItems' => Cart::instance('cart')->content(),
                    'total'     => Cart::instance('cart')->total(),
                    'cartCount' => Cart::instance('cart')->count(),
                    'subTotal'  => $subTotal,
                ];

                // Return the JSON response with cart data
                return response()->json([
                    'success'    => 'Successfully added to your cart.',
                    'cartCount'  => $data['cartCount'],
                    'subTotal'   => $subTotal,
                    'cartHeader' => view('frontend.pages.cart.partials.minicart', $data)->render(),
                ]);
            } else {
                return response()->json([
                    'error' => 'Failed to add this product to your cart. Contact our support team.'
                ], 500);
            }
        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function wishListStore(Request $request, $id)
    {
        try {
            // Check if user is authenticated
            if (!Auth::check()) {
                return response()->json([
                    'error' => 'Log in first to add product to your wishlist.'
                ]); // Use 401 Unauthorized status code for unauthenticated users
            }

            $user = Auth::user();
            $product = Product::find($id);

            if (!$product) {
                return response()->json([
                    'error' => 'Product not found.'
                ]); // Use 404 Not Found status code for non-existent products
            }

            // Check if the product is already in the user's wishlist
            $wishlistExists = Wishlist::where('product_id', $id)
                ->where('user_id', $user->id)
                ->exists();

            if ($wishlistExists) {
                return response()->json([
                    'error' => 'The Product is already in your wishlist.'
                ]); // Use 400 Bad Request status code for conflicts
            }

            // Add the product to the wishlist
            Wishlist::create([
                'product_id' => $id,
                'user_id' => $user->id,
            ]);

            $wishlistCount = Wishlist::where('user_id', $user->id)->count();

            return response()->json([
                'success' => 'Successfully added to your wishlist.',
                'wishlistCount' => $wishlistCount,
            ], 200); // Use 200 OK status code for successful operations

        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage(),
            ], 500); // Use 500 Internal Server Error status code for unexpected errors
        }
    }


    public function removeFromCart(Request $request)
    {
        $rowId = $request->input('rowId');

        if ($rowId) {
            // Assuming you're using Hardevine Cart
            Cart::instance('cart')->remove($rowId);

            $data = [
                'cartItems' => Cart::instance('cart')->content(),
                'total'     => Cart::instance('cart')->total(),
                'cartCount' => Cart::instance('cart')->count(),
                'subTotal'  => Cart::instance('cart')->subtotal(),
            ];
            return response()->json([
                'success' => 'Cart Item removed Successfully.',
                'cartCount' => $data['cartCount'],
                'cartHeader' => view('frontend.pages.cart.partials.minicart', $data)->render(),
                'cartTable' => view('frontend.pages.cart.partials.cartTable', $data)->render(),
            ]);
        }

        return response()->json(['error' => 'Unable to remove item.'], 400);
    }
    public function checkoutStore(Request $request)
    {
        ini_set('max_execution_time', 300);

        // Validate the request data
        $totalAmount = preg_replace('/[^0-9.]/', '', $request->input('total_amount'));
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = $totalAmount;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");

        // Prepare payment request data
        $request_data_json = json_encode($request->all());
        // Create an instance of the BkashPaymentTokenize class
        // $bkashPayment = new BkashPaymentTokenize();

        // Now call the cPayment method on the instance
        // $response = $bkashPayment->cPayment($request_data_json);
        $response = BkashPaymentTokenize::cPayment($request_data_json);
        Log::error('bKash API Error', [
            'response' => $response,
            'request'  => $request_data_json
        ]);

        // If bKash URL exists, redirect to payment gateway
        if (isset($response['bkashURL'])) {
            return redirect()->away($response['bkashURL']);
        } else {
            return redirect()->back()->with('error-alert2', $response['statusMessage']);
        }

        // Validation of request data
        $validator = Validator::make($request->all(), [
            'name'           => 'nullable|string|max: 255',
            'address'        => 'nullable|string',
            'email'          => 'required|email',
            'phone'          => 'required|string|max: 20',
            'thana'          => 'nullable|string',
            'district'       => 'nullable|string',
            'order_note'     => 'nullable|string',
            'sub_total'      => 'required',
            'total_amount'   => 'required|min:0',
        ], [
            'order_note.string' => 'The order note must be a string.',
            'total_amount.required' => 'The total amount is required.',
            'total_amount.numeric' => 'The total amount must be a number.',
            'total_amount.min' => 'The total amount must be at least 0.',
            'shipping_id.required' => 'The shipping method is required.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

        // Start the database transaction, but don't create the order yet
        DB::beginTransaction();
        try {
            // Get the next order number
            $typePrefix = 'JL';
            $year = date('Y');
            $lastCode = Order::where('order_number', 'like', $typePrefix . '-' . $year . '%')
                ->orderBy('id', 'desc')
                ->first();
            $newNumber = $lastCode ? (int) substr($lastCode->order_number, strlen($typePrefix . '-' . $year)) + 1 : 1;
            $code = $typePrefix . '-' . $year . $newNumber;

            // Store the payment attempt without saving the order
            $orderData = [
                'order_number' => $code,
                'user_id' => auth()->id(),
                'shipping_method_id' => $request->input('shipping_id'),
                'sub_total' => $request->input('sub_total'),
                'total_amount' => $totalAmount,
                'payment_status' => 'pending',
                'status' => 'pending',
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'order_note' => $request->input('order_note'),
                'created_by' => auth()->id(),
                'created_at' => Carbon::now(),
            ];

            // Store order temporarily
            $tempOrder = new Order($orderData);
            $tempOrder->save();

            // Continue with further order processing...
            // Store items in the order_items table (this will happen later after successful payment)

            // Do not commit yet, wait for the payment verification

            return redirect()->away($response['bkashURL']); // Redirect to bKash payment gateway
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function wishlistDestroy(string $id)
    {
        Wishlist::findOrFail($id)->delete();
    }

    public function cartDestroy(string $rowId)
    {
        Cart::instance('cart')->remove($rowId);
    }

    public function cartClear()
    {
        Cart::instance('cart')->destroy();
    }

    public function updateCart(Request $request)
    {
        try {
            $items = $request->input('items');
            if (!is_array($items)) {
                throw new \Exception('Invalid data format');
            }

            foreach ($items as $item) {
                $rowId = $item['rowId'];
                $quantity = $item['qty'];
                if (empty($rowId) || !is_numeric($quantity)) {
                    throw new \Exception('Invalid item data');
                }
                Cart::instance('cart')->update($rowId, $quantity);
            }

            return response()->json([
                'success' => 'Cart updated successfully.',
            ], 200);
        } catch (\Exception $e) {
            // \Log::error('Cart update error: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success'){
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response){ //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */
                return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        }else if ($request->status == 'cancel'){
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }
}
