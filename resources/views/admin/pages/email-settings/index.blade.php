<x-admin-app-layout :title="'Email-settings List'">
    <div class="card card-flash">
        <!--begin::Card header-->
        <div class="card-header mt-6">
            <!--begin::Card title-->
            <div class="card-title"></div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{ route('admin.active.mail.configuration') }}" class="btn btn-light-info rounded-2">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5"
                                fill="currentColor" />
                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Email Configer
                </a>
                <!--begin::Button-->
                <a href="{{ route('admin.email-settings.create') }}" class="btn btn-light-success rounded-2 ms-3">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5"
                                fill="currentColor" />
                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1"
                                transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Add Email-settings
                </a>
            </div>
        </div>
        <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="emailDT table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                    data-kt-check-target=".emailDT .emailDT-delete" value="1" />
                            </div>
                        </th>
                        <th>Mailer</th>
                        <th>Host</th>
                        <th>Port</th>
                        <th>Username</th>
                        <th>Encryption</th>
                        <th>From Address</th>
                        <th>From Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">

                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                var table = $('.emailDT').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.email-settings.index') }}",
                    columns: [{
                            data: 'checkbox',
                            name: 'checkbox',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'mail_mailer',
                            name: 'mail_mailer'
                        },
                        {
                            data: 'mail_host',
                            name: 'mail_host'
                        },
                        {
                            data: 'mail_port',
                            name: 'mail_port'
                        },
                        {
                            data: 'mail_username',
                            name: 'mail_username'
                        },
                        {
                            data: 'mail_encryption',
                            name: 'mail_encryption'
                        },
                        {
                            data: 'mail_from_address',
                            name: 'mail_from_address'
                        },
                        {
                            data: 'mail_from_name',
                            name: 'mail_from_name'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data, type, row) {
                                return `
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input status-toggle" type="checkbox" id="status_toggle_${row.id}" ${data == 1 ? 'checked' : ''} data-id="${row.id}" />
                                    </div>
                                `;
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });

                $(document).on('change', '.status-toggle', function() {
                    const id = $(this).data('id');
                    const route = "{{ route('admin.email-settings.toggle-status', ':id') }}".replace(':id', id);
                    toggleStatus(route, id);
                });
            });
        </script>
    @endpush
</x-admin-app-layout>
