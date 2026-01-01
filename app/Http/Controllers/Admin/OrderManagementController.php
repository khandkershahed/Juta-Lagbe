<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class OrderManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     ini_set('memory_limit', '256M');
    //     // Get the current month and year for comparison
    //     $currentMonth = now()->month;
    //     $currentYear = now()->year;
    //     $orders = Order::with('orderItems')->latest()->get();
    //     $data = [
    //         'orders' => $orders, // Group by user_id
    //         'pendingOrdersCount' => $orders->where('status', 'pending')->count(),
    //         'deliveredOrdersCount' => $orders->where('status', 'delivered')->count(),
    //     ];

    //     // Return the view with the data
    //     return view('admin.pages.orderManagement.index', $data);
    // }

    public function index(Request $request)
    {
        $baseQuery = Order::with(['orderItems.product', 'user'])
            ->latest();

        // counts from DB (not memory)
        $pendingOrdersCount   = Order::pending()->count();
        $deliveredOrdersCount = Order::delivered()->count();

        // pagination (server-side)
        $orders = $baseQuery->paginate(15);

        if ($request->ajax()) {
            return view('admin.pages.orderManagement.partial.indexTable', compact('orders'))->render();
        }

        return view('admin.pages.orderManagement.index', [
            'orders' => $orders,
            'pendingOrdersCount' => $pendingOrdersCount,
            'deliveredOrdersCount' => $deliveredOrdersCount,
        ]);
    }


    public function orderDetails($id)
    {

        $data = [
            'order' => Order::with('orderItems', 'user')->where('id', $id)->first(),
        ];
        return view('admin.pages.orderManagement.orderDetails', $data);
    }

    public function orderReport(Request $request)
    {
        // Base query (never execute directly)
        $baseQuery = Order::query();

        // Date range filter
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $baseQuery->whereBetween('order_created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // Aggregates (SQL level, no memory load)
        $total_sale = (clone $baseQuery)->sum('total_amount');

        $pendingOrdersCount = (clone $baseQuery)
            ->pending()
            ->count();

        $deliveredOrdersCount = (clone $baseQuery)
            ->delivered()
            ->count();

        // Paginated orders with relations (server-side loading)
        $orders = (clone $baseQuery)
            ->with([
                'orderItems.product',
                'user'
            ])
            ->latest('order_created_at')
            ->paginate(15);

        // Shared data
        $data = [
            'orders'               => $orders,
            'total_sale'           => $total_sale,
            'pendingOrdersCount'   => $pendingOrdersCount,
            'deliveredOrdersCount' => $deliveredOrdersCount,
        ];

        // AJAX request → table only
        if ($request->ajax()) {
            return view('admin.pages.orderManagement.partial.orderReportTable', $data)->render();
        }

        // Normal request → full page
        return view('admin.pages.orderManagement.orderReport', $data);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function statusUpdate(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
            'external_order_id' => $request->external_order_id,
        ]);
        Session::flash('success', 'Order Status Updated Successfully');
        return redirect()->back();
    }
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        foreach ($order->orderItems as $orderItem) {
            $orderItem->delete();
        }
        $order->delete();
    }
}
