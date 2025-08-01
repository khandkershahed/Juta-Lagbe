<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\DealBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function allProducts()
    {
        // $category = Category::where('slug', $slug)->firstOrFail();

        $data = [
            // 'category'                => $category,
            'categories'   => Category::orderBy('name', 'ASC')->active()->get(),
            'brands'       => Brand::orderBy('name', 'ASC')->active()->get(),
            'products'     => Product::with('reviews')->latest('id')->active()->paginate(10),
            'deal'         => DealBanner::active()->inRandomOrder()->first(),
            'sizes'        => ['38', '39', '40', '41', '42', '43', '44'],
            // 'productCount' => Product::active()->count(),
        ];
        return view('frontend.pages.product.allProducts', $data);
    }


    public function filterProducts(Request $request)
    {
        $query = Product::query();
        // Filter by Categories
        if ($request->has('categories') && !empty($request->categories)) {
            $categories = $request->categories;
            $query->where(function ($query) use ($categories) {
                foreach ($categories as $category) {
                    $query->orWhereJsonContains('category_id', $category);
                }
            });
        }

        // Filter by Subcategories
        if ($request->has('subcategories') && !empty($request->subcategories)) {
            $subcategories = $request->subcategories;
            $query->where(function ($query) use ($subcategories) {
                foreach ($subcategories as $subcategory) {
                    $query->orWhereJsonContains('category_id', $subcategory);
                }
            });
        }
        // Filter by Brand
        if ($request->has('brands')) {
            $query->whereIn('brand_id', $request->brands);
        }

        // Filter by Price Range
        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('unit_price', [$request->price_min, $request->price_max]);
        }
        // if ($request->has('sizes') && !empty($request->sizes)) {
        //     $sizes = $request->sizes;
        //     $query->where(function ($query) use ($sizes) {
        //         foreach ($sizes as $size) {
        //             $query->orWhereJsonContains('size', $size);
        //         }
        //     });
        // }
        // ✅ Filter by Sizes
        // Filter by Sizes
        if ($request->has('sizes') && !empty($request->sizes)) {
            $size = $request->sizes;
            $query->whereHas('sizes', function ($q) use ($size) {
                $q->where('size', $size);
            });
        }


        // Sort products
        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'latest':
                    $query->orderBy('id', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('id', 'asc');
                    break;
                case 'name-asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name-desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price-asc':
                    $query->orderBy('unit_price', 'asc');
                    break;
                case 'price-desc':
                    $query->orderBy('unit_price', 'desc');
                    break;
            }
        }

        $perPage = $request->has('showPage') ? (int)$request->showPage : 10;
        $products = $query->active()->paginate($perPage);

        $productCount = $products->count();
        Log::info('Filtered products count', ['count' => $products->count()]);

        // return view('frontend.pages.product.partial.getProduct', compact('products'))->render();
        return response()->json([
            'productCount'   => $productCount,
            'html' => view('frontend.pages.product.partial.getProduct', compact('products'))->render(),
        ]);
    }
}
