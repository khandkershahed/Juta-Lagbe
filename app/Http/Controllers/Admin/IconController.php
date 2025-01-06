<?php

namespace App\Http\Controllers\Admin;

use App\Models\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\IconRequest;
use Yajra\DataTables\Facades\DataTables;

class IconController extends Controller
{
    /**
     * The function sets middleware permissions for specific actions in a PHP class constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:view icon|show icon|edit icon|delete icon|create icon')->only(['index', 'create', 'show', 'edit', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Icon::latest('id')->get();
            return DataTables::of($data)
                ->addColumn('DT_RowIndex', function ($row) {
                    return $row->id;
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('admin.icons.show', [$row->id]);
                    $editUrl = route('admin.icons.edit', [$row->id]);
                    $deleteUrl = route('admin.icons.destroy', [$row->id]);
                    return '<a href="' . $showUrl . '" class="text-info"><i class="fas fa-edit text-info"></i></a>' .
                        '<a href="' . $editUrl . '" class="text-primary ms-4"><i class="fas fa-pen text-primary"></i></a>' .
                        '<a href="' . $deleteUrl . '" class="text-danger ms-4 delete"><i class="fas fa-trash-alt text-danger"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pages.icons.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.icons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IconRequest $request)
    {
        try {
            // Start a transaction
            DB::beginTransaction();

            $mainFileImage = $request->file('image');
            $mainFileImageGlobal = handaleFileUpload($mainFileImage, 'icons');

            // Create the Icon
            Icon::create([
                'name'   => $request->input('name'),
                'image'  => $mainFileImageGlobal,
                'status' => $request->input('status'),
            ]);

            // Commit the transaction
            DB::commit();

            return redirect()->route('admin.icons.index')->with('success', 'Icon created successfully');
        } catch (\Exception $e) {
            // An error occurred; cancel the transaction...
            DB::rollback();

            // and return to the previous page with the error message
            return redirect()->back()->with('error', 'An error occurred while creating the icon: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Icon $icon)
    {
        return view('admin.pages.icons.show', ['icon' => $icon]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Icon $icon)
    {
        return view('admin.pages.icons.edit', ['icon' => $icon]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IconRequest $request, Icon $icon)
    {
        try {
            // Start a transaction
            DB::beginTransaction();

            $mainFileImage = $request->file('image');
            $mainFileImageGlobal = $mainFileImage ? handaleFileUpload($mainFileImage, 'icons') : $icon->image;

            // Delete the old image
            if ($mainFileImage && File::exists(storage_path('app/public/' . $icon->image))) {
                File::delete(storage_path('app/public/' . $icon->image));
            }

            // Update the Icon
            $icon->update([
                'name'   => $request->input('name'),
                'image'  => $mainFileImageGlobal,
                'status' => $request->input('status'),
            ]);

            // Commit the transaction
            DB::commit();

            return redirect()->route('admin.icons.index')->with('success', 'Icon updated successfully');
        } catch (\Exception $e) {
            // An error occurred; cancel the transaction...
            DB::rollback();

            // and return to the previous page with the error message
            return redirect()->back()->with('error', 'Error updating icon: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Icon $icon)
    {
        //Delete the image if it exists
        if ($icon->image && File::exists(storage_path('app/public/' . $icon->image))) {
            File::delete(storage_path('app/public/' . $icon->image));
        }
        $icon->delete();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function toggleStatus(string $id)
    {
        $icon = Icon::findOrFail($id);
        $icon->status = !$icon->status;
        $icon->save();
        return response()->json(['success' => $icon->status]);
    }
}
