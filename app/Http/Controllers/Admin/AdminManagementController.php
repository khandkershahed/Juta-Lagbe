<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:view admin management|show admin management|delete admin management|create admin management|edit admin management|store admin management|update admin management')->only(['index', 'show', 'destroy','create', 'edit', 'store', 'update']);
    }
    public function index()
    {
        $data = [
            'admins' => Admin::latest()->get(),
        ];
        return view('admin.pages.adminManagement.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'admins' => Admin::latest()->get(),
        ];
        return view('admin.pages.adminManagement.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            'admins' => Admin::latest()->get(),
        ];
        return view('admin.pages.adminManagement.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
