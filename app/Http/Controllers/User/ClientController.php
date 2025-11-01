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
    // public function checkoutSuccess()
    // {
    //     $data = [

    //         'pendingOrdersCount'   => Order::latest('id')->where('status', 'pending')->count(),
    //         'deliveredOrdersCount' => Order::latest('id')->where('status', 'delivered')->count(),
    //         'orders'               => Order::with('orderItems')->where('user_id', Auth::user()->id)->latest('id')->get(),
    //         'latest_order'         => Order::with('orderItems')->where('user_id', Auth::user()->id)->latest('id')->first(),
    //     ];
    //     return view('frontend.pages.cart.checkoutSuccess', $data);
    // }



    public function checkoutSuccess()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the latest order with all necessary relationships
        $latest_order = Order::with('orderItems.product', 'user')
            ->where('user_id', $user->id)
            ->latest('id')
            ->first();

        $purchaseData = null;

        if ($latest_order) {
            $orderItems = $latest_order->orderItems;

            // --- 1. Category Logic (This is correct) ---
            $allCategoryIds = $orderItems->flatMap(function ($item) {
                return ($item->product && is_array($item->product->category_id)) ? $item->product->category_id : [];
            })->unique()->filter()->values();

            $contentCategories = Category::whereIn('id', $allCategoryIds)->pluck('name')->join(', ');


            // --- 2. Product & Contents Logic (THIS IS THE FIX) ---

            $contents = $orderItems->map(function ($item) {
                // 1. Try to get SKU from the order_items table (best for historical accuracy)
                $sku = $item->product_sku;

                // 2. If it's empty, fall back to the related product's sku_code
                // (We know $item->product exists because content_name is working)
                if (empty($sku) && $item->product) {
                    $sku = $item->product->sku_code; // Assuming 'sku_code' on products table
                }

                return [
                    'id' => $sku, // Use the SKU we found
                    'quantity' => (int) $item->quantity,
                    'item_price' => (float) $item->price,
                ];
            });
            // --- END OF FIX ---


            $contentIds = $contents->pluck('id')->filter()->values(); // This will now work
            $contentNames = $orderItems->pluck('product_name')->join(', ');

            // --- 3. User Data Logic (This is correct) ---
            $fullName = $latest_order->name ?? $user->name;
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? null;

            $user_data = [
                'em' => strtolower($latest_order->email ?? $user->email),
                'fn' => strtolower($firstName),
                'ln' => $lastName ? strtolower($lastName) : null,
                'ph' => preg_replace('/[^0-9]/', '', $latest_order->phone ?? $user->phone),
                'ct' => strtolower(str_replace(' ', '', $latest_order->thana ?? $user->thana)),
                'st' => strtolower($latest_order->district ?? $user->district),
                'zp' => null,
                'country' => 'bd',
            ];

            // --- 4. Ecommerce Data Object (This is correct) ---
            $ecommerceData = [
                'currency' => 'BDT',
                'value' => (float) $latest_order->total_amount,
                'content_name' => $contentNames,
                'content_category' => $contentCategories,
                'content_ids' => $contentIds, // This will now be populated
                'content_type' => 'product',
                'contents' => $contents, // This will now have the 'id'
                'num_items' => (int) $latest_order->quantity,
            ];

            // --- 5. Assemble Final Data (This is correct) ---
            $purchaseData = [
                'ecommerce' => $ecommerceData,
                'user_data' => array_filter($user_data),
                'eventID' => $latest_order->order_number
            ];
        }
        // dd($purchaseData);
        // --- Original Data for the Page (This is correct) ---
        $data = [
            'pendingOrdersCount'   => Order::pending()->where('user_id', $user->id)->count(),
            'deliveredOrdersCount' => Order::delivered()->where('user_id', $user->id)->count(),
            'orders'               => Order::with('orderItems')->where('user_id', $user->id)->latest('id')->get(),
            'latest_order'         => $latest_order,
            'purchaseData'         => $purchaseData,
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
