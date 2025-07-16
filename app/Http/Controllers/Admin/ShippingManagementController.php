<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use App\Http\Controllers\Controller;
use lemonpatwari\bangladeshgeocode\Models\Thana;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use lemonpatwari\bangladeshgeocode\Models\District;

class ShippingManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'shipping_methods' => ShippingMethod::latest('id')->get(),
        ];
        return view('admin.pages.shippingManagement.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new shipping method
        $data = [
            'thanas' => District::all(),
        ];
        return view('admin.pages.shippingManagement.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:250',
            'location' => 'nullable|string|max:250',
            'duration' => 'nullable|string|max:250',
            'description' => 'nullable|string',
            'thana' => 'nullable|array',  // Validate as an array (if it is an array)
            'carrier' => 'nullable|string|max:250',
            'min_weight' => 'nullable|numeric|min:0',
            'max_weight' => 'nullable|numeric|min:0|gte:min_weight',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ], [
            'max_weight.gte' => 'The maximum weight must be greater than or equal to the minimum weight.',
            'status.in' => 'The status must be either active or inactive.',
        ]);

        // Check for validation failures
        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

        // Handle the 'thana' field as JSON
        $thana = $request->has('thana') ? $request->thana : null;

        // Create a new shipping method
        ShippingMethod::create([
            'title' => $request->title,
            'location' => $request->location,
            'duration' => $request->duration,
            'description' => $request->description,
            'carrier' => $request->carrier,
            'min_weight' => $request->min_weight,
            'max_weight' => $request->max_weight,
            'price' => $request->price,
            'status' => $request->status,
            'thana' => $thana,  // Store 'thana' as JSON
        ]);

        // Redirect with success message
        Session::flash('success', 'Shipping method has been created successfully!');
        return redirect()->back()->withInput();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'method' => ShippingMethod::findOrFail($id),
            'thanas' => District::all(),
        ];
        return view('admin.pages.shippingManagement.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the shipping method or fail
        $shippingMethod = ShippingMethod::findOrFail($id);

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:250',
            'location' => 'nullable|string|max:250',
            'duration' => 'nullable|string|max:250',
            'description' => 'nullable|string',
            'carrier' => 'nullable|string|max:250',
            'min_weight' => 'nullable|numeric|min:0',
            'max_weight' => 'nullable|numeric|min:0|gte:min_weight',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:active,inactive',
        ], [
            'max_weight.gte' => 'The maximum weight must be greater than or equal to the minimum weight.',
            'status.in' => 'The status must be either active or inactive.',
        ]);

        // Check for validation failures
        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $message) {
                Session::flash('error', $message);
            }
            return redirect()->back()->withInput();
        }

        // Handle the 'thana' field as JSON
        $thana = $request->has('thana') ? $request->thana : $shippingMethod->thana;

        // Update the shipping method
        $shippingMethod->update([
            'title'       => $request->title,
            'location'    => $request->location,
            'duration'    => $request->duration,
            'description' => $request->description,
            'carrier'     => $request->carrier,
            'min_weight'  => $request->min_weight,
            'max_weight'  => $request->max_weight,
            'price'       => $request->price,
            'status'      => $request->status,
            'thana'       => $thana,  // Store 'thana' as JSON
        ]);
        Session::flash('success', 'Shipping method has been updated successfully!');

        return redirect()->back()->withInput();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $shippingMethod = ShippingMethod::findOrFail($id);
        $shippingMethod->delete();
    }
}
