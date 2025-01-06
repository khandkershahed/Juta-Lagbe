<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Support\Facades\Auth;

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
            'related_products' => Product::select('id', 'slug', 'meta_title', 'thumbnail', 'name', 'box_discount_price','unit_discount_price', 'box_price', 'unit_price')->with('multiImages')->where('status', 'published')->inRandomOrder()->limit(12)->get(),
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
        return view('user.pages.viewCatalouge',$data);
    }
}
