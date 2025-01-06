<x-admin-app-layout :title="'Staffs List'">
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                Manage Your Staff
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('admin.staff.create') }}" class="btn btn-light-primary">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                    transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        Add
                    </a>
                </div>
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                        <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                    </div>
                    <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete
                        Selected</button>
                </div>
            </div>
        </div>


        <div class="card-body py-4">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                        <th class="text-center">SL</th>
                        <th class="">Image</th>
                        <th class="">Name</th>
                        <th class="">Role</th>
                        <th class="">Email</th>
                        {{-- <th class="">Two-step</th>
                        <th class="">Joined Date</th> --}}
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">

                    @foreach ($staffs as $staff)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>

                            <td class="d-flex align-items-center">
                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                    <a href="javascript:void(0)">
                                        <div class="symbol-label rounded-0">
                                            <img src="{{ !empty($staff->photo) && file_exists(public_path('storage/' . $staff->photo)) ? asset('storage/' . $staff->photo) : asset('https://ui-avatars.com/api/?name=' . urlencode($staff->name)) }}"
                                                alt="{{ $staff->name }}" class="w-100" />
                                        </div>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="javascript:void(0)"
                                        class="text-gray-800 text-hover-primary mb-1">{{ $staff->name }}</a>
                                </div>
                            </td>
                            <td>
                                <span>{{ $staff->email }}</span>
                            </td>

                            <td>
                                @forelse ($staff->getRoleNames() as $role)
                                    <div class="badge badge-light-success fw-bolder">{{ $role }}</div>

                                @empty
                                    <div class="badge badge-light-danger fw-bolder">No Role</div>
                                @endforelse
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.staff.show', $staff->id) }}"
                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                    <i class="fa-solid fa-expand"></i>
                                </a>
                                <a href="{{ route('admin.staff.edit', $staff->id) }}"
                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px"
                                    title="Edit">
                                    <i class="fa-solid fa-user-pen"></i>
                                </a>
                                <a href="{{ route('admin.staff.destroy', $staff->id) }}"
                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px delete"
                                    title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-app-layout>
