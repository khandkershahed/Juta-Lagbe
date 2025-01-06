<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'reviews' => ProductReview::latest('id')->get(),
        ];
        return view('admin.pages.productReview.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'products' => Product::latest('id')->get(['id','name']),
        ];
        return view('admin.pages.productReview.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'product_id'       => 'nullable|exists:products,id',
                'name'             => 'required|string|max:255|unique:product_reviews,name',
                'rating'           => 'required',
                'message'          => 'nullable|string',
                'status'           => 'required|in:active,inactive',
            ], [
                'product_id.exists'   => 'The selected Product does not exist.',
                'name.required'       => 'The name field is required.',
                'name.string'         => 'The name must be a string.',
                'name.max'            => 'The name may not be greater than :max characters.',
                'name.unique'         => 'This name has already been taken.',
                'name.required'       => 'The rating field is required.',
                'message.string'      => 'The description must be a string.',
                'status.required'     => 'The status field is required.',
                'status.in'           => 'The status must be one of: active, inactive.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $files = [
                'image' => $request->file('image'),
            ];
            $uploadedFiles = [];
            foreach ($files as $key => $file) {
                if (!empty($file)) {
                    $filePath = 'testimonials/' . $key;
                    $uploadedFiles[$key] = customUpload($file, $filePath);
                    if ($uploadedFiles[$key]['status'] === 0) {
                        return redirect()->back()->with('error', $uploadedFiles[$key]['error_message']);
                    }
                } else {
                    $uploadedFiles[$key] = ['status' => 0];
                }
            }
            ProductReview::create([
                "product_id" => $request->product_id,
                "name"       => $request->name,
                "date"       => $request->date,
                "rating"     => $request->rating,
                'image'      => $uploadedFiles['image']['status'] == 1 ? $uploadedFiles['image']['file_path'] : null,
                "message"    => $request->message,
                "status"     => $request->status,
            ]);
            DB::commit();
            Session::flash('success', 'Review Added Successfuly');
            return redirect()->route('admin.product-review.index');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Review Not Submited' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'review'   => ProductReview::find($id),
            'products' => Product::latest('id')->get(['id','name']),
        ];
        return view('admin.pages.productReview.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = ProductReview::find($id);
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'product_id'       => 'nullable|exists:products,id',
                'name'             => 'required|string|max:255|unique:product_reviews,name,' . $review->id,
                'rating'           => 'required',
                'message'          => 'nullable|string',
                'status'           => 'required|in:active,inactive',
            ], [
                'product_id.exists'   => 'The selected Product does not exist.',
                'name.required'       => 'The name field is required.',
                'name.string'         => 'The name must be a string.',
                'name.max'            => 'The name may not be greater than :max characters.',
                'name.unique'         => 'This name has already been taken.',
                'name.required'       => 'The rating field is required.',
                'message.string'      => 'The description must be a string.',
                'status.required'     => 'The status field is required.',
                'status.in'           => 'The status must be one of: active, inactive.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $files = [
                'image' => $request->file('image'),
            ];
            $uploadedFiles = [];
            foreach ($files as $key => $file) {
                if (!empty($file)) {
                    $filePath = 'reviews/' . $key;
                    $oldFile = $brand->$key ?? null;

                    if ($oldFile) {
                        Storage::delete("public/" . $oldFile);
                    }
                    $uploadedFiles[$key] = customUpload($file, $filePath);
                    if ($uploadedFiles[$key]['status'] === 0) {
                        return redirect()->back()->with('error', $uploadedFiles[$key]['error_message']);
                    }
                } else {
                    $uploadedFiles[$key] = ['status' => 0];
                }
            }
            $review->update([
                "product_id" => $request->product_id,
                "name"       => $request->name,
                "date"       => $request->date,
                "rating"     => $request->rating,
                'image'      => $uploadedFiles['image']['status'] == 1 ? $uploadedFiles['image']['file_path']: $review->image,
                "message"    => $request->message,
                "status"     => $request->status,
            ]);
            DB::commit();
            Session::flash('success', 'Review Updated Successfuly');
            return redirect()->route('admin.product-review.index');
        } catch (\Exception $e) {
            DB::rolllback();
            Session::flash('error', 'Review Not Submited' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = ProductReview::find($id);
        $files = [
            'image' => $review->image,
        ];
        foreach ($files as $key => $file) {
            if (!empty($file)) {
                $oldFile = $review->$key ?? null;
                if ($oldFile) {
                    Storage::delete("public/" . $oldFile);
                }
            }
        }
        $review->delete();
    }
}
