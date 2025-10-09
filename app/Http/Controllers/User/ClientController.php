<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Catalogue;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class ClientController extends Controller
{
    public function orderHistory()
    {
        $data = [

            'pendingOrdersCount'   => Order::latest('id')->where('status', 'pending')->count(),
            'deliveredOrdersCount' => Order::latest('id')->where('status', 'delivered')->count(),
            'orders'               => Order::with('orderItems')->where('user_id', Auth::user()->id)->latest('id')->get(),
            'latest_order'         => Order::with('orderItems')->where('user_id', Auth::user()->id)->latest('id')->first(),
        ];
        return view('user.pages.orderHistory', $data);
    }
    public function checkoutSuccess()
    {
        $data = [

            'pendingOrdersCount'   => Order::latest('id')->where('status', 'pending')->count(),
            'deliveredOrdersCount' => Order::latest('id')->where('status', 'delivered')->count(),
            'orders'               => Order::with('orderItems')->where('user_id', Auth::user()->id)->latest('id')->get(),
            'latest_order'         => Order::with('orderItems')->where('user_id', Auth::user()->id)->latest('id')->first(),
        ];
        return view('frontend.pages.cart.checkoutSuccess', $data);
    }
    public function paymentSuccess(Request $request)
    {
        // dd($request->status);
        $pendingOrder = session('pending_order');
        if ($request->status == 'success') {
            DB::beginTransaction();
            try {
                // Check if pending order exists
                if (empty($pendingOrder)) {
                    throw new \Exception('No pending order found.');
                }

                // Create the order
                $order = Order::create([
                    'order_number'       => $pendingOrder['order_number'],
                    'user_id'            => $pendingOrder['user_id'],
                    'shipping_method_id' => $pendingOrder['shipping_method_id'],
                    'sub_total'          => (float) $pendingOrder['sub_total'],  // Type casting
                    'quantity'           => (int) $pendingOrder['quantity'],    // Ensure quantity is an integer
                    'shipping_charge'    => (float) $pendingOrder['shipping_charge'],  // Type casting
                    'total_amount'       => (float) $pendingOrder['total_amount'],   // Type casting
                    'payment_status'     => $pendingOrder['payment_status'],
                    'status'             => $pendingOrder['status'],
                    'name'               => $pendingOrder['name'],
                    'email'              => $pendingOrder['email'],
                    'phone'              => $pendingOrder['phone'],
                    'thana'              => $pendingOrder['thana'],
                    'district'           => $pendingOrder['district'],
                    'address'            => $pendingOrder['address'],
                    'order_note'         => $pendingOrder['order_note'],
                    'created_by'         => $pendingOrder['created_by'],
                    'order_created_at'   => $pendingOrder['order_created_at'],
                    'created_at'         => $pendingOrder['created_at'],
                ]);

                foreach ($pendingOrder['cart_items'] as $item) {

                    $orderItem = OrderItem::create([
                        'order_id'      => $order->id,  // Accessing order's ID, which is correct
                        'product_id'    => $item['product_id'],  // Correct array access
                        'user_id'       => $pendingOrder['user_id'],
                        'product_name'  => $item['product_name'],
                        'product_color' => $item['product_color'] ?? null,
                        'product_sku'   => $item['product_sku'] ?? null,
                        'size'          => $item['size'] ?? null,
                        'price'         => (float) $item['price'],  // Type casting to float
                        'tax'           => (float) $item['tax'],    // Type casting to float
                        'quantity'      => (int) $item['quantity'],  // Ensure quantity is an integer
                        'subtotal'      => (float) $item['subtotal'], // Type casting to float
                    ]);

                    // Update product stock
                    $product = Product::find($item['product_id']);
                    if ($product) {
                        $product->update([
                            'stock' => $product->stock - (int) $item['quantity'],  // Update stock
                        ]);
                    }
                }

                // Commit the transaction
                DB::commit();

                // Clear the cart and session data
                Cart::instance('cart')->destroy();
                session()->forget('pending_order');
            } catch (\Exception $e) {
                // Rollback in case of any error
                DB::rollback();
                // Flash error message
                Session::flash('error', 'Order processing failed: ' . $e->getMessage());
            }

            // Prepare data to be sent to the view
            $data = [
                'pendingOrdersCount'   => Order::latest('id')->where('status', 'pending')->count(),
                'deliveredOrdersCount' => Order::latest('id')->where('status', 'delivered')->count(),
                'orders'               => Order::with('orderItems')->where('user_id', Auth::user()->id)->latest('id')->get(),
            ];

            // Return the view with order history
            return view('user.pages.orderHistory', $data);
        } else {
            Session::flash('error', 'Payment Unsuccessful');
            return redirect()->route('checkout');
        }
    }


    public function accountDetails()
    {
        return view('user.pages.accountDetails');
    }
    public function orderTracking()
    {
        return view('user.pages.orderTracking');
    }
    public function quickOrder()
    {
        $data = [
            'products'         => Product::inRandomOrder()->active()->get(),
            'related_products' => Product::select('id', 'slug', 'meta_title', 'thumbnail', 'name', 'box_discount_price', 'unit_discount_price', 'box_price', 'unit_price')->with('multiImages')->where('status', 'published')->inRandomOrder()->limit(12)->get(),
        ];
        return view('user.pages.quickOrder', $data);
    }
    public function stockHistory()
    {
        $data = [
            'categories' => Category::orderBy('name', 'ASC')->active()->get(),
        ];
        return view('user.pages.stockHistory', $data);
    }
    public function wishlist()
    {
        $data = [
            'wishlists' => Wishlist::with('product')->where('user_id', Auth::user()->id)->latest('id')->get(),
        ];
        return view('user.pages.wishlist', $data);
    }
    public function productData()
    {
        return view('user.pages.productData');
    }
    public function viewCatalouge()
    {
        $data = [
            'catalogues' => Catalogue::latest('id')->active()->get(),
        ];
        return view('user.pages.viewCatalouge', $data);
    }
}
