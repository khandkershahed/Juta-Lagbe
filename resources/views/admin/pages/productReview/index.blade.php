<x-admin-app-layout :title="'Product Review List'">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-flush mt-10">
                    <div class="card-header bg-dark align-items-center">
                        <h3 class="card-title text-white">Review List</h3>
                        <div>
                            <a type="button" href="{{ route('admin.product-review.create') }}"
                                class="btn btn-light-primary">
                                <i class="fa-solid fa-plus"></i> Create
                            </a>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table my-datatable table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="text-center text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th width="5%">{{ __('Sl') }}</th>
                                    <th width="10%">{{ __('Product Image') }}</th>
                                    <th width="35%">{{ __('Product Name') }}</th>
                                    <th width="20%">{{ __('Client Name') }}</th>
                                    <th width="10%">{{ __('rating') }}</th>
                                    <th width="10%">{{ __('status') }}</th>
                                    <th width="10%" class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($reviews as $review)
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img class="w-50px h-50px"
                                                src="{{ asset('storage/' . optional($review->product)->thumbnail) }}"
                                                alt="{{ optional($review->product)->name }}"
                                                onerror="this.onerror=null; this.src='{{ asset('frontend/img/no-blogs.jpg') }}';">
                                        </td>
                                        <td>{{ optional($review->product)->name }}</td>
                                        <td class="text-center">
                                            {{ $review->name }}
                                        </td>

                                        <td class="text-center">{{ $review->rating }} <i class="fas fa-star text-warning"></i></td>
                                        <td>
                                            <span
                                                class="badge {{ $review->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $review->status == 'active' ? 'Active' : 'InActive' }}</span>
                                        </td>
                                        <td class="text-center">
                                            {{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                data-bs-toggle="modal" data-bs-target="#faqViewModal_{{ $faq->id }}">
                                                <i class="fa-solid fa-expand"></i>
                                            </a> --}}
                                            <a href="{{ route('admin.product-review.edit', $review->id) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <a href="{{ route('admin.product-review.destroy', $review->id) }}"
                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 delete"
                                                data-kt-docs-table-filter="delete_row">
                                                <i class="fa-solid fa-trash-can-arrow-up"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    @endpush
</x-admin-app-layout>
