<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Wishlist;
use App\Models\OrderItem;
use App\Mail\UserOrderMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;

class CartController extends Controller
{

    public function addToCart(Request $request, $id)
    {
        try {
            // Find the product or fail
            $product = Product::findOrFail($id);
            $quantity = $request->input('quantity', 1); // Default to 1 if no quantity is provided
            $size = $request->input('size'); // Default to 1 if no quantity is provided

            if (!empty($product->unit_price) || !empty($product->unit_discount_price)) {
                Cart::instance('cart')->add([
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $quantity,
                    'price' => !empty($product->unit_discount_price) ? $product->unit_discount_price : $product->unit_price,
                    'options' => ['size' => $size],
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
    // public function checkoutStore(Request $request)
    // {

    //     try {
    //         if (Auth::check()) {
    //             $user_id = auth()->id();
    //         } else {
    //             $user = User::where('phone', $request->input('phone'))->first();

    //             if ($user) {
    //                 Auth::login($user);
    //                 $request->session()->regenerate();
    //             } else {
    //                 $password = Str::random(8); // or you can change 8 to any desired length
    //                 $hashedPassword = Hash::make($password);
    //                 $user = User::create([
    //                     'phone' => $request->input('phone'),
    //                     'name' => $request->input('name'),
    //                     'thana' => $request->input('thana'),
    //                     'district' => $request->input('district'),
    //                     'status' => 'active',
    //                     'password' => $hashedPassword,
    //                 ]);

    //                 // Log the user in after registration
    //                 Auth::login($user);
    //                 $request->session()->regenerate();
    //             }

    //             // Get the user ID to track their order
    //             $user_id = auth()->id();
    //         }
    //     } catch (\Exception $e) {
    //         Session::flash('error', 'Check Your Mobile Number Correctly.');
    //         return redirect()->back()->withInput();
    //     }


    //     ini_set('max_execution_time', 300);
    //     $totalAmount = preg_replace('/[^0-9.]/', '', $request->input('total_amount'));
    //     $validator = Validator::make($request->all(), [
    //         'name'           => 'nullable|string|max:255',
    //         'address'        => 'nullable|string',
    //         'email'          => 'nullable|email',
    //         'phone'          => 'required|string|max:20',
    //         'thana'          => 'nullable|string',
    //         'district'       => 'nullable|string',
    //         'order_note'     => 'nullable|string',
    //         'sub_total'      => 'nullable',
    //         'total_amount'   => 'required|min:0',
    //     ], [
    //         'order_note.string' => 'The order note must be a string.',
    //         'total_amount.required' => 'The total amount is required.',
    //         'total_amount.numeric' => 'The total amount must be a number.',
    //         'total_amount.min' => 'The total amount must be at least 0.',
    //         'shipping_id.required' => 'The shipping method is required.',
    //     ]);

    //     if ($validator->fails()) {
    //         foreach ($validator->messages()->all() as $message) {
    //             Session::flash('error', $message);
    //         }
    //         return redirect()->back()->withInput();
    //     }

    //     // Start the database transaction, but don't create the order yet
    //     DB::beginTransaction();
    //     try {
    //         // Get the next order number
    //         $typePrefix = 'JL';
    //         $year = date('Y');
    //         $lastCode = Order::where('order_number', 'like', $typePrefix . '-' . $year . '%')
    //             ->orderBy('id', 'desc')
    //             ->first();
    //         $newNumber = $lastCode ? (int) substr($lastCode->order_number, strlen($typePrefix . '-' . $year)) + 1 : 1;
    //         $code = $typePrefix . '-' . $year . $newNumber;
    //         $shipping_method = ShippingMethod::find($request->input('shipping_id'));
    //         if ($shipping_method) {
    //             $shipping_method_id = $shipping_method->id;
    //             $shipping_charge = $shipping_method->price;
    //         } else {
    //             $shipping_charge = "0";
    //             $shipping_method_id = null;
    //         }
    //         $order = Order::create([
    //             'order_number'       => $code,
    //             'user_id'            => $user_id,
    //             'shipping_method_id' => $shipping_method_id,
    //             'sub_total'          => $request->input('sub_total'),
    //             'quantity'           => Cart::instance('cart')->count(),
    //             'shipping_charge'    => $shipping_charge,
    //             'total_amount'       => $totalAmount,
    //             'payment_status'     => $request->input('payment_status'),
    //             'status'             => 'pending',
    //             'name'               => $request->input('name'),
    //             'email'              => $request->input('email'),
    //             'phone'              => $request->input('phone'),
    //             'thana'              => $request->input('thana'),
    //             'district'           => $request->input('district'),
    //             'address'            => $request->input('address'),
    //             'order_note'         => $request->input('order_note'),
    //             'created_by'         => $user_id,
    //             'order_created_at'   => Carbon::now(),
    //             'created_at'         => Carbon::now(),
    //         ]);

    //         foreach (Cart::instance('cart')->content() as $item) {
    //             OrderItem::create([
    //                 'order_id'      => $order->id,
    //                 'product_id'    => $item->id,
    //                 'user_id'       => $user_id,
    //                 'product_name'  => $item->name,
    //                 'product_color' => $item->model->color ?? null,
    //                 'product_sku'   => $item->model->sku ?? null,
    //                 'size'          => $item->options->size ?? null,
    //                 'price'         => $item->price,
    //                 'tax'           => $item->tax ?? 0,
    //                 'quantity'      => $item->qty,
    //                 'subtotal'      => $item->qty * $item->price,
    //             ]);

    //             // Update product stock
    //             $product = Product::find($item->id);
    //             $product->update([
    //                 'box_stock' => $product->box_stock - $item->qty,
    //             ]);
    //         }

    //         // Commit the transaction
    //         DB::commit();

    //         // Clear the cart after successful order
    //         Cart::instance('cart')->destroy();
    //         Session::flash('success', 'Order placed successfully!');
    //         return redirect()->route('bkash.payment', $order->order_number);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         Session::flash('error', $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }

    public function checkoutStore(Request $request)
    {
        try {
            if (Auth::check()) {
                $user_id = auth()->id();
            } else {
                $user = User::where('phone', $request->input('phone'))->first();
                if ($user) {
                    Auth::login($user);
                    $request->session()->regenerate();
                } else {
                    $password = Str::random(8);
                    $hashedPassword = Hash::make($password);
                    $user = User::create([
                        'phone' => $request->input('phone'),
                        'name' => $request->input('name'),
                        'thana' => $request->input('thana'),
                        'district' => $request->input('district'),
                        'status' => 'active',
                        'password' => $hashedPassword,
                    ]);
                    Auth::login($user);
                    $request->session()->regenerate();
                }
                $user_id = auth()->id();
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Check Your Mobile Number Correctly.');
            return redirect()->back()->withInput();
        }

        ini_set('max_execution_time', 300);
        $totalAmount = preg_replace('/[^0-9.]/', '', $request->input('total_amount'));

        // Validate input fields
        $validator = Validator::make($request->all(), [
            'name'         => 'nullable|string|max:255',
            'address'      => 'nullable|string',
            'email'        => 'nullable|email',
            'phone'        => 'required|string|max:20',
            'thana'        => 'nullable|string',
            'district'     => 'nullable|string',
            'order_note'   => 'nullable|string',
            'sub_total'    => 'nullable',
            'total_amount' => 'required|min:0',
        ]);

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

        // Generate order number (but do not store in database yet)
        $typePrefix = 'JL';
        $year = date('Y');
        $lastCode = Order::where('order_number', 'like', $typePrefix . '-' . $year . '%')
            ->orderBy('id', 'desc')
            ->first();
        $newNumber = $lastCode ? (int) substr($lastCode->order_number, strlen($typePrefix . '-' . $year)) + 1 : 1;
        $orderNumber = $typePrefix . '-' . $year . $newNumber;

        // Store cart items in session (to be saved after successful payment)
        $cartItems = [];
        foreach (Cart::instance('cart')->content() as $item) {
            $cartItems[] = [
                'product_id'    => $item->id,
                'product_name'  => $item->name,
                'product_color' => $item->model->color ?? null,
                'product_sku'   => $item->model->sku ?? null,
                'size'          => $item->options->size ?? null,
                'price'         => $item->price,
                'tax'           => $item->tax ?? 0,
                'quantity'      => $item->qty,
                'subtotal'      => $item->qty * $item->price,
            ];
        }

        // Store order details temporarily in session
        $request->session()->put('pending_order', [
            'order_number' => $orderNumber,
            'user_id' => $user_id,
            'sub_total' => $request->input('sub_total'),
            'quantity' => Cart::instance('cart')->count(),
            'total_amount' => $totalAmount,
            'payment_status' => 'pending',
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'thana' => $request->input('thana'),
            'district' => $request->input('district'),
            'address' => $request->input('address'),
            'order_note' => $request->input('order_note'),
            'created_by' => $user_id,
            'order_created_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'cart_items' => $cartItems, // Store cart items in session
        ]);

        // Redirect to bKash payment
        return redirect()->route('bkash.payment', $orderNumber);
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

    // public function checkoutStore(Request $request)
    // {

    //     try {
    //         if (Auth::check()) {
    //             $user_id = auth()->id();
    //         } else {
    //             $user = User::where('phone', $request->input('phone'))->first();

    //             if ($user) {
    //                 Auth::login($user);
    //                 $request->session()->regenerate();
    //             } else {
    //                 $password = Str::random(8); // or you can change 8 to any desired length
    //                 $hashedPassword = Hash::make($password);
    //                 $user = User::create([
    //                     'phone' => $request->input('phone'),
    //                     'name' => $request->input('name'),
    //                     'thana' => $request->input('thana'),
    //                     'district' => $request->input('district'),
    //                     'status' => 'active',
    //                     'password' => $hashedPassword,
    //                 ]);

    //                 // Log the user in after registration
    //                 Auth::login($user);
    //                 $request->session()->regenerate();
    //             }

    //             // Get the user ID to track their order
    //             $user_id = auth()->id();
    //         }
    //     } catch (\Exception $e) {
    //         Session::flash('error', 'Check Your Mobile Number Correctly.');
    //         return redirect()->back()->withInput();
    //     }




    //     ini_set('max_execution_time', 300);
    //     $totalAmount = preg_replace('/[^0-9.]/', '', $request->input('total_amount'));
    //     $validator = Validator::make($request->all(), [
    //         'name'           => 'nullable|string|max:255',
    //         'address'        => 'nullable|string',
    //         'email'          => 'nullable|email',
    //         'phone'          => 'required|string|max:20',
    //         'thana'          => 'nullable|string',
    //         'district'       => 'nullable|string',
    //         'order_note'     => 'nullable|string',
    //         'sub_total'      => 'nullable',
    //         'total_amount'   => 'required|min:0',
    //     ], [
    //         'order_note.string' => 'The order note must be a string.',
    //         'total_amount.required' => 'The total amount is required.',
    //         'total_amount.numeric' => 'The total amount must be a number.',
    //         'total_amount.min' => 'The total amount must be at least 0.',
    //         'shipping_id.required' => 'The shipping method is required.',
    //     ]);

    //     if ($validator->fails()) {
    //         foreach ($validator->messages()->all() as $message) {
    //             Session::flash('error', $message);
    //         }
    //         return redirect()->back()->withInput();
    //     }

    //     // Start the database transaction, but don't create the order yet
    //     DB::beginTransaction();
    //     try {
    //         // Get the next order number
    //         $typePrefix = 'JL';
    //         $year = date('Y');
    //         $lastCode = Order::where('order_number', 'like', $typePrefix . '-' . $year . '%')
    //             ->orderBy('id', 'desc')
    //             ->first();
    //         $newNumber = $lastCode ? (int) substr($lastCode->order_number, strlen($typePrefix . '-' . $year)) + 1 : 1;
    //         $code = $typePrefix . '-' . $year . $newNumber;
    //         $shipping_method = ShippingMethod::find($request->input('shipping_id'));
    //         if ($shipping_method) {
    //             $shipping_method_id = $shipping_method->id;
    //             $shipping_charge = $shipping_method->price;
    //         } else {
    //             $shipping_charge = "0";
    //             $shipping_method_id = null;
    //         }
    //         $order = Order::create([
    //             'order_number'       => $code,
    //             'user_id'            => $user_id,
    //             'shipping_method_id' => $shipping_method_id,
    //             'sub_total'          => $request->input('sub_total'),
    //             'quantity'           => Cart::instance('cart')->count(),
    //             'shipping_charge'    => $shipping_charge,
    //             'total_amount'       => $totalAmount,
    //             'payment_status'     => $request->input('payment_status'),
    //             'status'             => 'pending',
    //             'name'               => $request->input('name'),
    //             'email'              => $request->input('email'),
    //             'phone'              => $request->input('phone'),
    //             'thana'              => $request->input('thana'),
    //             'district'           => $request->input('district'),
    //             'address'            => $request->input('address'),
    //             'order_note'         => $request->input('order_note'),
    //             'created_by'         => $user_id,
    //             'order_created_at'   => Carbon::now(),
    //             'created_at'         => Carbon::now(),
    //         ]);

    //         foreach (Cart::instance('cart')->content() as $item) {
    //             OrderItem::create([
    //                 'order_id'      => $order->id,
    //                 'product_id'    => $item->id,
    //                 'user_id'       => $user_id,
    //                 'product_name'  => $item->name,
    //                 'product_color' => $item->model->color ?? null,
    //                 'product_sku'   => $item->model->sku ?? null,
    //                 'size'          => $item->options->size ?? null,
    //                 'price'         => $item->price,
    //                 'tax'           => $item->tax ?? 0,
    //                 'quantity'      => $item->qty,
    //                 'subtotal'      => $item->qty * $item->price,
    //             ]);

    //             // Update product stock
    //             $product = Product::find($item->id);
    //             $product->update([
    //                 'box_stock' => $product->box_stock - $item->qty,
    //             ]);
    //         }

    //         // Commit the transaction
    //         DB::commit();

    //         // Clear the cart after successful order
    //         Cart::instance('cart')->destroy();
    //         $order = Order::with('orderItems')->where('id', $order->id)->first();
    //         $user = Auth::user();
    //         $data = [
    //             'order' =>  $order,
    //             'user'  => $user,
    //         ];

    //         if (!empty($request->input('shipping_email')) && $user->email) {
    //             try {
    //                 $setting = Setting::first();
    //                 $data = [
    //                     'order'             => $order,
    //                     'order_items'       => $order->orderItems,
    //                     'user'              => $user,
    //                     'shipping_charge'   => $shipping_charge,
    //                     'shipping_method'   => ($shipping_method) ? $shipping_method->title : null,
    //                 ];
    //                 Mail::to([$request->input('shipping_email'), $user->email])->send(new UserOrderMail($user->name, $data, $setting));
    //             } catch (\Exception $e) {
    //                 Session::flash('error', 'Failed to send Mail: ' . $e->getMessage());
    //             }
    //         }

    //         Session::flash('success', 'Order placed successfully!');
    //         return redirect()->route('bkash.payment', $order->order_number);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         Session::flash('error', $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }

}
