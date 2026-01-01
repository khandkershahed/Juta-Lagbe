<tbody>
@foreach ($orders as $order)
@php
    $firstItem = $order->orderItems->first();
@endphp

<tr class="text-center">
    <td>{{ $loop->iteration }}</td>

    <td>
        @if($firstItem)
            <img width="40"
                src="{{ $firstItem->product?->thumbnail
                    ? asset('storage/'.$firstItem->product->thumbnail)
                    : asset('frontend/img/no-product.jpg') }}">
            <div>{{ $firstItem->product?->name }}</div>
        @endif
    </td>

    <td>{{ $firstItem?->price }}</td>
    <td>{{ $firstItem?->quantity }}</td>

    <td>
        <a href="{{ route('admin.orderDetails', $order->id) }}">
            {{ $order->order_number }}
        </a>
    </td>

    <td>{{ $order->phone }}</td>
    <td>{{ $order->user?->name }}</td>
    <td>{{ $order->created_at->format('d M Y') }}</td>

    <td>{{ $order->total_amount }}</td>
    <td>{{ $order->payment_status === 'cod' ? '0.00' : $order->total_amount }}</td>
    <td>{{ $order->payment_status === 'cod' ? $order->total_amount : '0.00' }}</td>

    <td>
        <span class="badge badge-light-primary">{{ ucfirst($order->status) }}</span>
    </td>

    <td>
        <button class="btn btn-sm btn-light" onclick="loadInvoice({{ $order->id }})">
            <i class="fa fa-print"></i>
        </button>

        <a href="{{ route('admin.orderDetails', $order->id) }}" class="btn btn-sm btn-light">
            <i class="fa fa-eye"></i>
        </a>

        <button class="btn btn-sm btn-light"
            data-bs-toggle="modal"
            data-bs-target="#changeDeliveryStatus-{{ $order->id }}">
            <i class="fa fa-cog"></i>
        </button>
    </td>
</tr>

{{-- DELIVERY STATUS MODAL --}}
<div class="modal fade" id="changeDeliveryStatus-{{ $order->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.order.update', $order->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Change Delivery Status (#{{ $order->order_number }})</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <x-metronic.select-option id="status" name="status" class="form-select">
                        <option value="processing" @selected($order->status=='processing')>Processing</option>
                        <option value="shipped" @selected($order->status=='shipped')>Shipped</option>
                        <option value="delivered" @selected($order->status=='delivered')>Delivered</option>
                        <option value="cancelled" @selected($order->status=='cancelled')>Cancelled</option>
                        <option value="returned" @selected($order->status=='returned')>Returned</option>
                    </x-metronic.select-option>
                </div>

                <div class="modal-footer">
                    <x-metronic.button type="submit" class="primary">Update</x-metronic.button>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
</tbody>

<div class="mt-4">
    {{ $orders->links() }}
</div>
