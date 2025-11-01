<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Faq;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\BlogTag;
use App\Models\Product;
use App\Models\Setting;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\DealBanner;
use App\Models\PageBanner;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\ShippingMethod;
use App\Models\ProductSizeStock;
use App\Models\TermsAndCondition;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use lemonpatwari\bangladeshgeocode\Models\Thana;
use lemonpatwari\bangladeshgeocode\Models\District;
use lemonpatwari\bangladeshgeocode\Models\Division;

class HomeController extends Controller
{
    public function home()
    {
        // $latestproducts = Product::with('multiImages', 'reviews')
        //     ->latest()
        //     ->take(8)
        //     ->get();
        // $latestProductIds = $latestproducts->pluck('id')->toArray();
        $randomproducts = Product::inRandomOrder()->take(12)->get(); // Remove take(12) to fetch all products
        // $randomproducts = Product::inRandomOrder()
        //     ->whereNotIn('id', $latestProductIds)
        //     ->get(); // Remove take(12) to fetch all products
        $oneMonthAgo = Carbon::now()->subMonth();
        $oneMonthAgo = Carbon::now()->subMonth();

        $latestproducts = Product::join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.created_at', '>=', $oneMonthAgo)
            ->groupBy(
                'products.id',
                'products.brand_id',
                'products.category_id',
                'products.name',
                'products.slug',
                'products.sku_code',
                'products.mf_code',
                'products.product_code',
                'products.barcode_id',
                'products.barcode',
                'products.tags',
                'products.color',
                'products.size',
                'products.video_link',
                'products.short_description',
                'products.overview',
                'products.description',
                'products.specification',
                'products.warranty',
                'products.thumbnail',
                'products.box_contains',
                'products.vat',
                'products.tax',
                'products.box_price',
                'products.box_discount_price',
                'products.unit_price',
                'products.unit_discount_price',
                'products.product_type',
                'products.box_stock',
                'products.stock',
                'products.rating',
                'products.is_refurbished',
                'products.length',
                'products.width',
                'products.height',
                'products.meta_title',
                'products.meta_keywords',
                'products.meta_description',
                'products.create_date',
                'products.added_by',
                'products.status',
                'products.created_at',
                'products.updated_at'
            )
            ->select('products.*', DB::raw('SUM(order_items.quantity) as total_ordered'))
            ->orderByDesc('total_ordered')
            ->with('multiImages') // Optional, if you're using this relationship
            ->take(10)
            ->get();

        // dd($latestproducts);
        $special_offer = SpecialOffer::latest()->first();
        $specialproducts = $special_offer ? $special_offer->products() : null;

        $data = [
            'slider'                    => PageBanner::active()->where('page_name', 'home_slider')->latest('id')->first(),
            'deal_products'             => Product::with('multiImages', 'reviews')->whereNotNull('unit_discount_price')->inRandomOrder()->limit(15)->get(),
            'categorys'                 => Category::select('name', 'logo', 'video_link', 'id', 'slug')->get(),
            'latestproducts'            => $latestproducts,
            'randomproducts'            => $randomproducts,
            'specialproducts'           => $specialproducts,
        ];
        return view('frontend.pages.home', $data);
    }


    public function contact()
    {
        return view('frontend.pages.contact');
    }
    public function aboutUs()
    {
        $data = [
            'blog_posts'     => BlogPost::latest('id')->where('status', 'publish')->get(),
        ];
        return view('frontend.pages.aboutUs', $data);
    }
    public function returnPolicy()
    {
        return view('frontend.pages.returnPolicy');
    }
    public function privacyPolicy()
    {
        $data = [
            'banner'  => PageBanner::active()->where('page_name', 'privacy')->latest('id')->first(),
            'privacy' => PrivacyPolicy::latest('id')->where('status', 'active')->first(),
        ];
        return view('frontend.pages.privacyPolicy', $data);
    }
    public function termsCondition()
    {
        $data = [
            'banner'  => PageBanner::active()->where('page_name', 'terms')->latest('id')->first(),
            'terms'   => TermsAndCondition::latest('id')->where('status', 'active')->first(),
        ];
        return view('frontend.pages.termsCondition', $data);
    }
    public function faq()
    {
        $data = [
            'banner'  => PageBanner::active()->where('page_name', 'faq')->latest('id')->first(),
            'faqs'    => Faq::orderBy('order', 'asc')->where('status', 'active')->get(),
        ];
        return view('frontend.pages.faq', $data);
    }
    public function allBlog()
    {
        $data = [
            'blog_posts'     => BlogPost::latest('id')->where('status', 'publish')->get(),
            'blog_categorys' => BlogCategory::latest('id')->where('status', 'active')->get(),
            'blog_tags'      => BlogTag::latest('id')->where('status', 'active')->get(),
        ];
        return view('frontend.pages.blog.allBlog', $data);
    }
    public function blogDetails($slug)
    {
        $data = [
            'blog'           => BlogPost::where('slug', $slug)->first(),
            'blog_posts'     => BlogPost::inRandomOrder()->latest('id')->where('status', 'publish')->get(),
            'blog_categorys' => BlogCategory::latest('id')->where('status', 'active')->get(),
            'blog_tags'      => BlogTag::latest('id')->where('status', 'active')->get(),
        ];
        return view('frontend.pages.blog.blogDetails', $data);
    }
    // public function productDetails($slug)
    // {
    //     $data = [
    //         'shippingmethods'  => ShippingMethod::active()->get(),
    //         'product'          => Product::with('reviews', 'multiImages')->where('slug', $slug)->first(),
    //         'related_products' => Product::select('id', 'slug', 'color', 'meta_title', 'thumbnail', 'name', 'box_discount_price', 'unit_discount_price', 'box_price', 'unit_price')->with('multiImages')->where('status', 'published')->inRandomOrder()->limit(12)->get(),
    //     ];
    //     return view('frontend.pages.product.productDetails', $data);
    // }

    // Your existing controller function, updated.
    use Illuminate\View\View;
    use App\Models\Product; // Make sure these paths are correct
    use App\Models\ShippingMethod;

    // ...

    public function productDetails($slug)
    {
        // 1. Eager load all relationships, including 'sizes'
        $product = Product::with('reviews', 'multiImages', 'sizes')
            ->where('slug', $slug)
            ->first();

        // 2. Add a check for 404 if product not found
        if (!$product) {
            abort(404, 'Product not found');
        }

        // 3. Calculate the overall availability
        $overallAvailability = 'out of stock';
        if ($product->sizes && $product->sizes->some(function ($size) {
            return $size->stock > 0;
        })) {
            $overallAvailability = 'in stock';
        }

        // 4. Build the data array, adding the new variable
        $data = [
            'shippingmethods'     => ShippingMethod::active()->get(),
            'product'             => $product,
            'related_products'    => Product::select('id', 'slug', 'color', 'meta_title', 'thumbnail', 'name', 'box_discount_price', 'unit_discount_price', 'box_price', 'unit_price')
                ->with('multiImages')
                ->where('status', 'published')
                ->inRandomOrder()
                ->limit(12)
                ->get(),
            'overallAvailability' => $overallAvailability, 
        ];

        // 5. Pass the data to the view
        return view('frontend.pages.product.productDetails', $data);
    }

    // public function categoryProducts(Request $request, $slug)
    // {
    //     // Using caching to avoid fetching the same categories on every request
    //     $categories = Cache::remember('categories', 60, function () {
    //         return Category::orderBy('name', 'ASC')->active()->get(['id', 'name', 'slug']);
    //     });

    //     // Use eager loading to prevent N+1 problem
    //     $category = Category::with(['catProducts.multiImages', 'catProducts.reviews'])
    //         ->where('slug', $slug)
    //         ->firstOrFail();

    //     // Pass the data to the view
    //     $data = [
    //         'category'   => $category,
    //         'categories' => $categories,
    //     ];

    //     return view('frontend.pages.categoryDetails', $data);
    // }

    public function categoryProducts(Request $request, $slug)
    {
        // Using caching to avoid fetching the same categories on every request
        $categories = Category::orderBy('name', 'ASC')->active()->get(['id', 'name', 'slug']);

        // Fetch the category
        $category = Category::where('slug', $slug)->firstOrFail();

        // Ensure you are querying products with the correct category ID in JSON format
        // $query = Product::whereJsonContains('category_id', json_encode($category->id)); // Adjusted to use $category->id
        $query = Product::query();
        $query->whereJsonContains('category_id', (string) $category->id);
        // Apply price filter if present
        if ($request->has('price_min') && $request->has('price_max')) {
            $priceMin = $request->input('price_min');
            $priceMax = $request->input('price_max');
            $query->whereBetween('unit_price', [$priceMin, $priceMax]);
        }

        // Apply size filter if present
        // if ($request->has('size')) {
        //     $size = $request->input('size');
        //     $query->whereJsonContains('size', $size);
        // }

        if ($request->has('size') && !empty($request->size)) {
            $size = $request->size;
            // dd($size);
            $query->whereHas('sizes', function ($q) use ($size) {
                $q->where('size', $size);
            });
        }




        // Get the products based on the query
        $catProducts = $query->get();

        // Pass the data to the view
        $data = [
            'category'       => $category,
            'categories'     => $categories,
            'catProducts'    => $catProducts,
            'price_min'      => $request->input('price_min', 10), // Default price_min if not provided
            'price_max'      => $request->input('price_max', 10000), // Default price_max if not provided
            'selected_size'  => $request->input('size', null), // Pass selected size to the view
            'sizes'          => ['38', '39', '40', '41', '42', '43', '44'], // Static sizes (can be dynamic if needed)
        ];

        return view('frontend.pages.categoryDetails', $data);
    }






    public function compareList()
    {

        $data = [
            'categories'   => Category::orderBy('name', 'ASC')->active()->get(),
        ];
        return view('frontend.pages.cart.compareList', $data);
    }
    public function specialproducts($slug)
    {
        $special_offer = SpecialOffer::where('slug', $slug)->firstOrFail();
        $data = [
            'special_offer'     => $special_offer,
            'special_products'  => $special_offer->products(),
        ];
        return view('frontend.pages.special', $data);
    }

    public function cart()
    {
        $data = [
            'cartItems' => Cart::instance('cart')->content(),
            'related_products' => Product::select('id', 'slug', 'meta_title', 'thumbnail', 'name', 'unit_discount_price', 'unit_price')->with('multiImages')->inRandomOrder()->limit(12)->get(),
        ];
        return view('frontend.pages.cart.mycart', $data);
    }
    public function getDistrictsByDivision($divisionName)
    {
        // Find the division
        $division = Division::where('bn_name', $divisionName)->first();

        if ($division) {
            // Get the districts related to the division
            $districts = $division->districts; // Assuming the relationship is defined like $division->districts

            return response()->json($districts);
        }

        return response()->json([]);
    }
    public function getShippingCahrgeByThana($thanaName)
    {

        $thana = Thana::where('bn_name', $thanaName)->first();
        $charge = ShippingMethod::whereJsonContains('thana', optional($thana->district)->bn_name)->first();
        // dd($thana, $charge);

        if ($thana) {
            $price = $charge->price;
            return response()->json(['price' => $price, 'id' => $charge->id]);
        }

        return response()->json([]);
    }

    public function getThanasByDistrict($districtName)
    {
        $district = District::where('bn_name', $districtName)->first();

        if ($district) {
            $thanas = $district->thanas;

            return response()->json($thanas);
        }

        return response()->json([]);
    }
    public function checkout()
    {
        $setting = Setting::first();
        $minimumOrderAmount = $setting->minimum_order_amount ?? 0;

        $formattedSubtotal = Cart::instance('cart')->subtotal();
        $cleanSubtotal = preg_replace('/[^\d.]/', '', $formattedSubtotal);
        $subTotal = (float)$cleanSubtotal;

        if ($subTotal > $minimumOrderAmount) {
            // $data = [
            $shippingmethods = ShippingMethod::active()->get();
            $cartItems       = Cart::instance('cart')->content();
            $total           = Cart::instance('cart')->total();
            $cartCount       = Cart::instance('cart')->count();
            $user            = Auth::user();
            $subTotal        = $subTotal;
            $bd_divisions   = Division::all();
            // ];
            return view('frontend.pages.cart.checkout', compact(
                'shippingmethods',
                'cartItems',
                'total',
                'cartCount',
                'user',
                'subTotal',
                'bd_divisions'
            ));
        } else {
            // Redirect back with error message
            Session::flash('error', "Order Process Failed. Try Again.");
            // Session::flush();
            return redirect()->back()->withInput();
        }
    }
    public function buyNow($id)
    {
        try {
            $product = Product::findOrFail($id);
            $quantity = 1;
            if (!empty($product->unit_price) || !empty($product->unit_discount_price)) {
                Cart::instance('cart')->add([
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $quantity,
                    'price' => !empty($product->unit_discount_price) ? $product->unit_discount_price : $product->unit_price,
                ])->associate('App\Models\Product');
                return redirect()->route('cart');
            } else {
                Session::flash('error', 'Failed to add this product to your cart. Contact our support team.');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
    }


    public function globalSearch(Request $request)
    {
        $query = trim($request->get('term', '')); // Trim leading/trailing spaces
        $query = preg_replace('/\s+/', ' ', $query); // Normalize multiple spaces to a single space
        $query = addslashes($query);  // Sanitize special characters

        // Step 3: Get products with a case-insensitive match for the name
        $data['products'] = Product::join('brands', 'products.brand_id', '=', 'brands.id')
            ->whereRaw('LOWER(products.name) LIKE ?', ['%' . strtolower($query) . '%'])
            ->where('products.status', 'published')
            ->where('brands.status', 'active')
            ->limit(50)  // Temporarily increase the limit for debugging
            ->get([
                'products.id',
                'products.name',
                'products.slug',
                'products.thumbnail',
                'products.box_price',
                'products.box_discount_price',
                'products.unit_price',
                'products.unit_discount_price',
                'products.box_stock',
                'products.short_description'
            ]);
        $data['categorys'] = Category::where('name', 'LIKE', '%' . $query . '%')->limit(2)->get(['id', 'name', 'slug']);
        $data['brands'] = Brand::where('name', 'LIKE', '%' . $query . '%')->where('status', 'active')->limit(5)->get(['id', 'name', 'slug']);

        return response()->json(view('frontend.layouts.search', $data)->render());
    } // end method

    public function checkoutSuccess(Request $request)
    {


        $data = session('bkash_checkout_data');

        if (!$data) {
            return view('bkash.fail', ['response' => 'Session expired.']);
        }

        DB::beginTransaction();

        try {
            $user = User::firstOrCreate(
                ['phone' => $data['phone']],
                [
                    'name'     => $data['name'],
                    'email'    => $data['email'],
                    'thana'    => $data['thana'],
                    'district' => $data['district'],
                    'status'   => 'active',
                    'password' => Hash::make(Str::random(8)),
                ]
            );

            Auth::login($user);
            $request->session()->regenerate();
            $user_id = $user->id;

            $order = Order::create([
                'order_number'       => $data['order_number'],
                'user_id'            => $user_id,
                'shipping_method_id' => $data['shipping_method_id'],
                'sub_total'          => $data['sub_total'],
                'quantity'           => $data['quantity'],
                'shipping_charge'    => $data['shipping_charge'],
                'total_amount'       => $data['total_amount'],
                'payment_status'     => 'delivery_charge_paid',
                'status'             => 'pending',
                'name'               => $data['name'],
                'email'              => $data['email'],
                'phone'              => $data['phone'],
                'thana'              => $data['thana'],
                'district'           => $data['district'],
                'address'            => $data['address'],
                'order_note'         => $data['order_note'],
                'created_by'         => $user_id,
                'order_created_at'   => $data['order_created_at'],
                'created_at'         => $data['created_at'],
            ]);

            foreach (Cart::instance('cart')->content() as $item) {
                OrderItem::create([
                    'order_id'      => $order->id,
                    'product_id'    => $item->id,
                    'user_id'       => $user_id,
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
                    ProductSizeStock::where('product_id', $item->id)
                        ->where('size', $item->options->size)
                        ->decrement('stock', $item->qty);
                }
            }



            DB::commit();

            Cart::instance('cart')->destroy();
            session()->forget('bkash_checkout_data');
            Session::flash('success', 'Order placed successfully!');

            return view('user.pages.orderHistory', [
                'pendingOrdersCount'   => Order::where('status', 'pending')->count(),
                'deliveredOrdersCount' => Order::where('status', 'delivered')->count(),
                'orders'               => Order::with('orderItems')->where('user_id', $user_id)->latest()->get(),
                'latest_order'         => Order::with('orderItems')->where('user_id', $user_id)->latest()->first(),
                // 'latest_order'         => Order::with('orderItems')->where('user_id', $user_id)->latest()->first(['total_amount',]),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return view('bkash.fail', ['response' => 'Order failed: ' . $e->getMessage()]);
        }
    }
}
