<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'blogTags' => BlogTag::latest('id')->get(),
        ];
        return view('admin.pages.blogTag.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'name'          => 'required|string|max:255|unique:blog_tags,name',
                // 'image'       => 'nullable|string',
                'meta_title'    => 'nullable|string|max:255',
                'description'   => 'nullable|string',
                'status'        => 'required|in:active,inactive',
            ], [
                'name.required'       => 'The name field is required.',
                'name.string'         => 'The name must be a string.',
                'name.max'            => 'The name may not be greater than :max characters.',
                'name.unique'         => 'This name has already been taken.',
                'meta_title.string'   => 'The meta title must be a string.',
                'meta_title.max'      => 'The meta title may not be greater than :max characters.',
                'description.string'  => 'The description must be a string.',
                'status.required'     => 'The status field is required.',
                'status.in'           => 'The status must be one of: active, inactive.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $uploadedFiles = $this->handleFileUpload($request);

            if (isset($uploadedFiles['error'])) {
                return redirect()->back()->with('error', $uploadedFiles['error']);
            }

            BlogTag::create([
                'name'        => $request->name,
                'image'       => $uploadedFiles['image'] ?? null,
                'meta_title'  => $request->meta_title,
                'description' => $request->description,
                'status'      => $request->status,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data has been saved successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the Tag: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        $blog_tag = BlogTag::findOrFail($id);
        try {
            $validator = Validator::make($request->all(), [
                'name'          => 'nullable|string|max:255|unique:blog_tags,name,' . $id,
                // 'image'       => 'nullable|string',
                'meta_title'    => 'nullable|string|max:255',
                'description'   => 'nullable|string',
                'status'        => 'required|in:active,inactive',
            ], [
                'name.string'         => 'The name must be a string.',
                'name.max'            => 'The name may not be greater than :max characters.',
                'name.unique'         => 'This name has already been taken.',
                'meta_title.string'   => 'The meta title must be a string.',
                'meta_title.max'      => 'The meta title may not be greater than :max characters.',
                'description.string'  => 'The description must be a string.',
                'status.required'     => 'The status field is required.',
                'status.in'           => 'The status must be one of: active, inactive.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $uploadedFiles = $this->handleFileUpload($request, $blog_tag);

            if (isset($uploadedFiles['error'])) {
                return redirect()->back()->with('error', $uploadedFiles['error']);
            }

            $blog_tag->update([
                'name'        => $request->name ?? $blog_tag->name,
                'image'       => $uploadedFiles['image'] ?? $blog_tag->image,
                'meta_title'  => $request->meta_title,
                'description' => $request->description,
                'status'      => $request->status,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Data has been updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'An error occurred while updating the Tag: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogTag $blog_tag)
    {
        $files = [
            'image' => $blog_tag->image,
        ];
        foreach ($files as $key => $file) {
            if (!empty($file)) {
                Storage::delete("public/" . $file);
            }
        }
        $blog_tag->delete();
    }

    /**
     * Handle file upload.
     */
    protected function handleFileUpload(Request $request, BlogTag $blog_tag = null)
    {
        $files = [
            'image' => $request->file('image'),
        ];

        $uploadedFiles = [];
        foreach ($files as $key => $file) {
            if (!empty($file)) {
                $filePath = 'blog_tag/' . $key;
                if ($blog_tag) {
                    $oldFile = $blog_tag->$key ?? null;
                    if ($oldFile) {
                        Storage::delete("public/" . $oldFile);
                    }
                }
                $uploadResult = customUpload($file, $filePath);
                if ($uploadResult['status'] === 0) {
                    return ['error' => $uploadResult['error_message']];
                }
                $uploadedFiles[$key] = $uploadResult['file_path'];
            } else {
                $uploadedFiles[$key] = null;
            }
        }

        return $uploadedFiles;
    }
}
