<?php

namespace App\Http\Controllers\Frontend;

use Log; 
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\UserOrderMail;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name'           => 'nullable|string|max: 255',
            'address'        => 'nullable|string',
            'email'          => 'required|email',
            'phone'          => 'required|string|max: 20',
            'thana'          => 'nullable|string',
            'district'       => 'nullable|string',
            'order_note'     => 'nullable|string',
            // 'payment_method' => 'required|in:cod,stripe,paypal',
            'sub_total'      => 'required',
            'total_amount'   => 'required|min:0',
        ], [
            'order_note.string' => 'The order note must be a string.',
            'payment_method.required' => 'The payment method is required.',
            'payment_method.in' => 'The selected payment method is invalid.',
            'total_amount.required' => 'The total amount is required.',
            'total_amount.numeric' => 'The total amount must be a number.',
            'total_amount.min' => 'The total amount must be at least 0.',
            'shipping_id.required' => 'The shipping method is required.',
            'shipping_id.exists' => 'The selected shipping method does not exist.',
        ]);


        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
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
                $shipping_charge = "0";
                $shipping_method_id = null;
            }

            $order = Order::create([
                'order_number'                 => $code, // Generate a unique order number
                'user_id'                      => auth()->id(), // Assuming user is logged in
                'shipping_method_id'           => $shipping_method_id,
                'sub_total'                    => $request->input('sub_total'), // Use Cart instance
                'coupon'                       => $request->input('coupon', 0),
                'discount'                     => $request->input('discount', 0),
                'total_amount'                 => $totalAmount,
                'quantity'                     => Cart::instance('cart')->count(), // Total quantity of items in cart
                'shipping_charge'              => $shipping_charge,
                'payment_method'               => $request->input('payment_method'),
                'payment_status'               => 'unpaid',
                'status'                       => 'pending',
                'shipped_to_different_address' => $request->has('ship-address') ? 'yes': 'no',
                'name'                         => $request->input('name'),
                'email'                        => $request->input('email'),
                'phone'                        => $request->input('phone'),
                'delivery_location'            => $request->input('delivery_location'),
                'thana'                        => $request->input('thana'),
                'district'                     => $request->input('district'),
                'address'                      => $request->input('address'),
                'order_note'                   => $request->input('order_note'),
                'created_by'                   => auth()->id(),
                'order_created_at'             => Carbon::now(),
                'created_at'                   => Carbon::now(),
            ]);

            // Add items to order_items table
            foreach (Cart::instance('cart')->content() as $item) {
                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_id'    => $item->id,
                    'user_id'       => auth()->id(),
                    'product_name'  => $item->name,
                    'product_color' => $item->model->color ?? null,
                    'product_sku'   => $item->model->sku ?? null,
                    'price'         => $item->price,
                    'tax'           => $item->tax ?? 0,
                    'quantity'      => $item->qty,
                    'subtotal'      => $item->qty * $item->price,
                ]);

                // Update product stock
                $product = Product::find($item->id);
                $product->update([
                    'box_stock' => $product->box_stock - $item->qty,
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Clear the cart after successful order
            Cart::instance('cart')->destroy();
            $order = Order::with('orderItems')->where('id', $order->id)->first();
            $user = Auth::user();
            $data = [
                'order' =>  $order,
                'user'  => $user,
            ];

            try {
                $setting = Setting::first();
                $data = [
                    'order'             => $order,
                    'order_items'       => $order->orderItems,
                    'user'              => $user,
                    'shipping_charge'   => $shipping_charge,
                    'shipping_method'   => ($shipping_method) ? $shipping_method->title : null ,
                ];
                Mail::to([$request->input('shipping_email'), $user->email])->send(new UserOrderMail($user->name, $data, $setting));
            } catch (\Exception $e) {
                // Handle PDF save exception
                // flash()->error('Failed to generate PDF: ' . $e->getMessage());
                Session::flash('error', 'Failed to send Mail: ' . $e->getMessage());
                // Session::flush();
            }

            Session::flash('success', 'Order placed successfully!');

            return redirect()->route('checkout.success', $order->order_number);
            // }
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
}
