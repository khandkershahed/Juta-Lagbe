<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Brand;
use App\Models\Order;
use App\Models\BlogTag;
use App\Models\Product;
use App\Models\Setting;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\DealBanner;
use App\Models\PageBanner;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\ShippingMethod;
use App\Models\TermsAndCondition;
use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    public function home()
    {
        // Cache random categories for performance
        $categoryone = Cache::remember('categoryone', 60, function () {
            return Category::inRandomOrder()->active()->first();
        });

        $categoryoneproducts = collect(); // Default to empty collection
        if ($categoryone) {
            // Get products for category one with eager loading of related data
            $categoryoneproducts = $categoryone->products()->inRandomOrder()->with(['multiImages', 'reviews'])->paginate(8);
        }

        $categorytwo = null;
        $categorytwoproducts = collect(); // Default to empty collection
        if ($categoryone) {
            $categorytwo = Cache::remember('categorytwo', 60, function () use ($categoryone) {
                return Category::where('id', '!=', $categoryone->id)->inRandomOrder()->active()->first();
            });

            if ($categorytwo) {
                // Get products for category two with eager loading of related data
                $categorytwoproducts = $categorytwo->products()->inRandomOrder()->with(['multiImages', 'reviews'])->paginate(8);
            }
        }

        $categorythree = null;
        $categorythreeproducts = collect(); // Default to empty collection
        if (isset($categoryone, $categorytwo)) {
            $categorythree = Cache::remember('categorythree', 60, function () use ($categoryone, $categorytwo) {
                return Category::where('id', '!=', $categoryone->id)->where('id', '!=', $categorytwo->id)->inRandomOrder()->active()->first();
            });

            if ($categorythree) {
                // Get products for category three with eager loading of related data
                $categorythreeproducts = $categorythree->products()->inRandomOrder()->with(['multiImages', 'reviews'])->paginate(8);
            }
        }

        // Cache homepage data
        $data = Cache::remember('home_page_data', 60, function () use ($categoryone, $categorytwo, $categorythree, $categoryoneproducts, $categorytwoproducts, $categorythreeproducts) {
            return [
                'sliders'                   => PageBanner::active()->where('page_name', 'home_slider')->latest('id')->get(),
                'home_slider_bottom_first'  => PageBanner::active()->where('page_name', 'home_slider_bottom_first')->latest('id')->first(),
                'home_slider_bottom_second' => PageBanner::active()->where('page_name', 'home_slider_bottom_second')->latest('id')->first(),
                'home_slider_bottom_third'  => PageBanner::active()->where('page_name', 'home_slider_bottom_third')->latest('id')->first(),
                'blog_posts'                => BlogPost::active()->inRandomOrder()->get(),
                'deals'                     => DealBanner::active()->inRandomOrder()->limit(7)->get(),
                'blog'                      => BlogPost::inRandomOrder()->active()->first(),
                'categorys'                 => Category::orderBy('name', 'ASC')->active()->get(),
                'testimonials'              => Testimonial::latest()->where('status', 'active')->get(),
                'categoryone'               => $categoryone ?? '',
                'categoryoneproducts'       => $categoryoneproducts,
                'categorytwo'               => $categorytwo ?? '',
                'categorytwoproducts'       => $categorytwoproducts,
                'categorythree'             => $categorythree ?? '',
                'categorythreeproducts'     => $categorythreeproducts,
                'latest_products'           => Product::with('multiImages', 'reviews')->inRandomOrder()->where('status', 'published')->paginate(8),
                'deal_products'             => Product::with('multiImages', 'reviews')->whereNotNull('box_discount_price')->inRandomOrder()->limit(10)->get(),
            ];
        });

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
    public function productDetails($slug)
    {
        $data = [
            'product'          => Product::with('reviews', 'multiImages')->where('slug', $slug)->first(),
            'related_products' => Product::select('id', 'slug', 'color', 'meta_title', 'thumbnail', 'name', 'box_discount_price', 'unit_discount_price', 'box_price', 'unit_price')->with('multiImages')->where('status', 'published')->inRandomOrder()->limit(12)->get(),
        ];
        return view('frontend.pages.product.productDetails', $data);
    }
    // public function categoryProducts($slug)
    // {
    //     $category = Category::where('slug', $slug)->firstOrFail();
    //     $data = [
    //         'category'                => $category,
    //         'categories'              => Category::orderBy('name', 'ASC')->active()->get(),
    //     ];
    //     return view('frontend.pages.categoryDetails', $data);
    // }
    public function categoryProducts($slug)
    {
        // Using caching to avoid fetching the same categories on every request
        $categories = Cache::remember('categories', 60, function () {
            return Category::orderBy('name', 'ASC')->active()->get(['id', 'name', 'slug']);
        });

        // Use eager loading to prevent N+1 problem
        $category = Category::with(['catProducts.multiImages', 'catProducts.reviews'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Pass the data to the view
        $data = [
            'category'   => $category,
            'categories' => $categories,
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
    public function checkout()
    {
        $setting = Setting::first();
        $minimumOrderAmount = $setting->minimum_order_amount ?? 0;

        $formattedSubtotal = Cart::instance('cart')->subtotal();
        $cleanSubtotal = preg_replace('/[^\d.]/', '', $formattedSubtotal);
        $subTotal = (float)$cleanSubtotal;

        if ($subTotal > $minimumOrderAmount) {
            $data = [
                'shippingmethods' => ShippingMethod::active()->get(),
                'cartItems'       => Cart::instance('cart')->content(),
                'total'           => Cart::instance('cart')->total(),
                'cartCount'       => Cart::instance('cart')->count(),
                'user'            => Auth::user(),
                'subTotal'        => $subTotal,
            ];
            return view('frontend.pages.cart.checkout', $data);
        } else {
            // Redirect back with error message
            Session::flash('error', "'The added product price must be greater than'. $minimumOrderAmount . 'to proceed to check out.'");
            // Session::flush();
            return redirect()->back();
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


    public function checkoutSuccess($id)
    {

        $data = [
            'order'           => Order::with('orderItems')->where('order_number', $id)->first(),
            'user'            => Auth::user(),
        ];
        // dd(Cart::instance('cart'));
        return view('frontend.pages.cart.checkoutSuccess', $data);
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
}
