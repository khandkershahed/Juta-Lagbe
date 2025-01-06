<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'testimonials' => Testimonial::latest('id')->get(),
        ];
        return view('admin.pages.testimonial.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name'    => 'required|string|max:255|unique:testimonials,name',
                'rating'  => 'required',
                'message' => 'nullable|string',
                'status'  => 'required|in:active,inactive',
            ], [
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
            Testimonial::create([
                "name"         => $request->name,
                "company_name" => $request->company_name,
                "message"      => $request->message,
                "rating"       => $request->rating,
                'image'        => $uploadedFiles['image']['status'] == 1 ? $uploadedFiles['image']['file_path'] : null,
                "status"       => $request->status,
            ]);
            DB::commit();
            Session::flash('success', 'Testimonial Added Successfuly');
            return redirect()->route('admin.testimonial.index');
        } catch (\Exception $e) {
            DB::rolllback();
            Session::flash('error', 'Testimonial Not Submited' . $e->getMessage());
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
            'testimonial' => Testimonial::findOrFail($id),
        ];
        return view('admin.pages.testimonial.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::find($id);
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name'    => 'required|string|max:255|unique:testimonials,name,' . $testimonial->id,
                'rating'  => 'required',
                'message' => 'nullable|string',
                'status'  => 'required|in:active,inactive',
            ], [
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
            $testimonial->update([
                "name"         => $request->name,
                "company_name" => $request->company_name,
                'image'        => $uploadedFiles['image']['status'] == 1 ? $uploadedFiles['image']['file_path']: $testimonial->image,
                "message"      => $request->message,
                "rating"       => $request->rating,
                "status"       => $request->status,
            ]);
            DB::commit();
            Session::flash('success', 'Testimonial Added Successfuly');
            return redirect()->route('admin.testimonial.index');
        } catch (\Exception $e) {
            DB::rolllback();
            Session::flash('error', 'Testimonial Not Submited' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id);
        $files = [
            'image' => $testimonial->image,
        ];
        foreach ($files as $key => $file) {
            if (!empty($file)) {
                $oldFile = $testimonial->$key ?? null;
                if ($oldFile) {
                    Storage::delete("public/" . $oldFile);
                }
            }
        }
        $testimonial->delete();
    }
}
