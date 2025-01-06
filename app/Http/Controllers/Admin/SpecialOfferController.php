<?php

namespace App\Http\Controllers\Admin;

use App\Models\SpecialOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SpecialOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'items' => SpecialOffer::latest()->get(),
        ];
        return view('admin.pages.special_offer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'products' => DB::table('products')->select('id', 'name')->latest('id')->get(),
        ];
        return view('admin.pages.special_offer.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string|max:255',
            'button_name'       => 'required|string|max:255',
            'button_link'       => 'nullable|string|max:255',
            'status'            => 'required|in:active,inactive,expired',
            'logo'              => 'nullable|file|mimes:webp,jpeg,png,jpg|max:2048',
            'image'             => 'nullable|file|mimes:webp,jpeg,png,jpg|max:2048',
            'banner_image'      => 'nullable|file|mimes:webp,jpeg,png,jpg|max:2048',
            'footer_banner'     => 'nullable|file|mimes:webp,jpeg,png,jpg|max:2048',
            'start_date'        => 'nullable|date',
            'end_date'          => 'nullable|date',
            'date'              => 'nullable|date',
        ]);

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

        DB::beginTransaction();

        try {
            // Handle file uploads
            $files = [
                'logo'          => $request->file('logo'),
                'image'         => $request->file('image'),
                'banner_image'  => $request->file('banner_image'),
                'footer_banner' => $request->file('footer_banner'),
            ];
            $uploadedFiles = [];
            foreach ($files as $key => $file) {
                if (!empty($file)) {
                    $filePath = 'special_offer/' . $key;
                    $uploadedFiles[$key] = customUpload($file, $filePath);
                    if ($uploadedFiles[$key]['status'] === 0) {
                        return redirect()->back()->with('error', $uploadedFiles[$key]['error_message']);
                    }
                } else {
                    $uploadedFiles[$key] = ['status' => 0];
                }
            }

            // Create the Special Offer model instance
            $offer = SpecialOffer::create([
                'created_by'        => Auth::guard('admin')->user()->id,
                'name'              => $request->name,
                'button_name'       => $request->button_name,
                'button_link'       => $request->button_link,
                'header_slogan'     => $request->header_slogan,
                'product_id'        => $request->has('product_id') ? json_encode($request->product_id) : null,  // Store product_id as JSON
                'start_date'        => $request->start_date,
                'end_date'          => $request->end_date,
                'date'              => $request->date,
                'status'            => $request->status,
                'logo'              => $uploadedFiles['logo']['status'] == 1 ? $uploadedFiles['logo']['file_path'] : null,
                'image'             => $uploadedFiles['image']['status'] == 1 ? $uploadedFiles['image']['file_path'] : null,
                'banner_image'      => $uploadedFiles['banner_image']['status'] == 1 ? $uploadedFiles['banner_image']['file_path'] : null,
                'footer_banner'     => $uploadedFiles['footer_banner']['status'] == 1 ? $uploadedFiles['footer_banner']['file_path'] : null,
                'created_at'        => now(), // Generating the slug
                'updated_at'        => now(),
            ]);

            DB::commit();

            return redirect()->route('admin.special-offer.index')->with('success', 'Special Offer created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'An error occurred while creating the Offer: ' . $e->getMessage());
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
            'offer'     => SpecialOffer::findOrFail($id),
            'products'  => DB::table('products')->select('id', 'name')->latest('id')->get(),
        ];

        return view('admin.pages.special_offer.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $offer = SpecialOffer::find($id);

        DB::beginTransaction();

        try {
            $files = [
                'logo'          => $request->file('logo'),
                'image'         => $request->file('image'),
                'banner_image'  => $request->file('banner_image'),
                'footer_banner' => $request->file('footer_banner'),
            ];
            $uploadedFiles = [];
            foreach ($files as $key => $file) {
                if (!empty($file)) {
                    $filePath = 'special_offer/' . $key;
                    $oldFile = $offer->$key ?? null;

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

            // Update the offer with the new or existing file paths
            $offer->update([

                'logo'          => $uploadedFiles['logo']['status'] == 1 ? $uploadedFiles['logo']['file_path'] : $offer->logo,
                'image'         => $uploadedFiles['image']['status'] == 1 ? $uploadedFiles['image']['file_path'] : $offer->image,
                'banner_image'  => $uploadedFiles['banner_image']['status'] == 1 ? $uploadedFiles['banner_image']['file_path'] : $offer->banner_image,
                'footer_banner' => $uploadedFiles['footer_banner']['status'] == 1 ? $uploadedFiles['footer_banner']['file_path'] : $offer->footer_banner,

                'updated_by'    => Auth::guard('admin')->user()->id,
                'name'          => $request->name,
                'button_name'   => $request->button_name,
                'button_link'   => $request->button_link,
                'header_slogan' => $request->header_slogan,
                'product_id'    => $request->product_id,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'date'          => $request->date,
                'status'        => $request->status,

            ]);

            DB::commit();

            return redirect()->route('admin.special-offer.index')->with('success', 'Special Offer updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while updating the offer: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $offer = SpecialOffer::findOrFail($id);

        // Delete associated files from storage
        $files = ['logo', 'image', 'banner_image', 'footer_banner'];

        foreach ($files as $key => $file) {
            if (!empty($file)) {
                $oldFile = $offer->$key ?? null;
                if ($oldFile) {
                    Storage::delete("public/" . $oldFile);
                }
            }
        }
        $offer->delete();

        DB::commit();
    }

    public function updateStatusSpecial(Request $request, $id)
    {
        $offer = SpecialOffer::findOrFail($id);
        $offer->status = $request->input('status');
        $offer->save();

        return response()->json(['success' => true]);
    }
}
