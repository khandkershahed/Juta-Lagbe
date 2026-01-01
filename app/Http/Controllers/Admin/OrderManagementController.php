<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class OrderManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $deliveredOrdersCount = Order::where('status', 'delivered')->count();

        $orders = Order::with([
            'user',
            'orderItems.product'
        ])
            ->latest()
            ->paginate(25);

        if ($request->ajax()) {
            return view('admin.pages.orderManagement.partial.indexTable', compact(
                'orders',
                'pendingOrdersCount',
                'deliveredOrdersCount'
            ));
        }

        return view('admin.pages.orderManagement.index', compact(
            'orders',
            'pendingOrdersCount',
            'deliveredOrdersCount'
        ));
    }

    public function invoiceModal(Request $request, Order $order)
    {
        $order->load([
            'user',
            'orderItems.product'
        ]);

        $setting = null;
        if (class_exists(\App\Models\Setting::class)) {
            $setting = \App\Models\Setting::first();
        }

        return view('admin.pages.orderManagement.partial.invoice_two', compact('order', 'setting'));
    }

    public function downloadInvoicePdf(Order $order)
    {
        $order->load(['orderItems.product', 'user']);

        // If you use settings in invoice, load it here exactly like your current system
        $setting = \App\Models\Setting::first();

        $pdf = Pdf::loadView('admin.pages.orderManagement.partial.invoice_two', compact('order', 'setting'))
            ->setPaper('a4', 'portrait');

        $fileName = 'Invoice-' . $order->order_number . '.pdf';

        return $pdf->download($fileName);
    }
    // public function index()
    // {
    //     $data = [

    //         'pendingOrdersCount' => Order::where('status', 'pending')->count(),
    //         'deliveredOrdersCount' => Order::where('status', 'delivered')->count(),
    //         'orders' => Order::with('orderItems')->latest('created_at')->get(),
    //     ];
    //     return view('admin.pages.orderManagement.index', $data);
    // }

    public function orderDetails($id)
    {

        $data = [
            'order' => Order::with('orderItems', 'user')->where('id', $id)->first(),
        ];
        return view('admin.pages.orderManagement.orderDetails', $data);
    }
    public function orderReport(Request $request)
    {
        $query = Order::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $query->whereBetween('order_created_at', [$startDate, $endDate]);
        }

        $total_sale = (clone $query)->sum('total_amount');
        $pendingOrdersCount = (clone $query)->where('status', 'pending')->count();
        $deliveredOrdersCount = (clone $query)->where('status', 'delivered')->count();

        $orders = (clone $query)
            ->with(['user', 'orderItems.product'])
            ->latest('order_created_at')
            ->paginate(25);

        $data = [
            'total_sale' => $total_sale,
            'pendingOrdersCount' => $pendingOrdersCount,
            'deliveredOrdersCount' => $deliveredOrdersCount,
            'orders' => $orders,
        ];

        if ($request->ajax()) {
            return view('admin.pages.orderManagement.partial.orderReportTable', $data);
        }

        return view('admin.pages.orderManagement.orderReport', $data);
    }

    public function orderReportInvoiceModal(Request $request, Order $order)
    {
        $order->load(['user', 'orderItems.product']);

        $setting = null;
        if (class_exists(\App\Models\Setting::class)) {
            $setting = \App\Models\Setting::first();
        }

        return view('admin.pages.orderManagement.partial.invoice', compact('order', 'setting'));
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
