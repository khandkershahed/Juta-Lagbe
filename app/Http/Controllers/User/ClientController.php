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
        ];
        return view('user.pages.orderHistory', $data);
    }
    public function paymentSuccess()
    {
        $pendingOrder = session('pending_order');
        DB::beginTransaction();
        try {
            // $order = Order::create($pendingOrder);
            $order = Order::create([
                'order_number'       => $pendingOrder['order_number'],
                'user_id'            => $pendingOrder['user_id'],
                'shipping_method_id' => $pendingOrder['shipping_method_id'],
                'sub_total'          => $pendingOrder['sub_total'],
                'quantity'           => $pendingOrder['quantity'],
                'shipping_charge'    => $pendingOrder['shipping_charge'],
                'total_amount'       => $pendingOrder['total_amount'],
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
                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_id'    => $item->id,
                    'user_id'       => $pendingOrder['user_id'],
                    'product_name'  => $item->name,
                    'product_color' => $item->model->color ?? null,
                    'product_sku'   => $item->model->sku ?? null,
                    'size'          => $item->options->size ?? null,
                    'price'         => $item->price,
                    'tax'           => $item->tax ?? 0,
                    'quantity'      => $item->qty,
                    'subtotal'      => $item->qty * $item->price,
                ]);

                // Update product stock
                $product = Product::find($item->id);
                $product->update([
                    'stock' => $product->stock - $item->qty,
                ]);
            }
            DB::commit();
            Cart::instance('cart')->destroy();
            session()->forget('pending_order');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Order processing failed: ' . $e->getMessage());
        }
        $data = [
            'pendingOrdersCount'   => Order::latest('id')->where('status', 'pending')->count(),
            'deliveredOrdersCount' => Order::latest('id')->where('status', 'delivered')->count(),
            'orders'               => Order::with('orderItems')->where('user_id', Auth::user()->id)->latest('id')->get(),
        ];
        return view('user.pages.orderHistory', $data);
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
