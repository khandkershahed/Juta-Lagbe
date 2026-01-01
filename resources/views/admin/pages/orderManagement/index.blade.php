<x-admin-app-layout :title="'Order Report'">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        thead {
            font-weight: bold;
        }

        /* ===== Bangla Fix for Invoice PDF ===== */
        .card-print,
        .card-print * {
            font-family: 'Noto Sans Bengali', system-ui, -apple-system, BlinkMacSystemFont, sans-serif !important;

        }

        /* Prevent canvas text splitting */
    </style>
    <div class="row">
        <div class="mx-auto col-xl-4">
            <div class="shadow-sm card card-flush">
                <div class="p-0 card-body">
                    <div class="d-flex flex-stack justify-content-between">
                        <div class="p-8 d-flex align-items-center me-3 rounded-3 bg-dark">
                            <a href="javascript:void(0)">
                                <span class="p-3 bg-black rounded-3 me-3"><i
                                        class="text-white fa-brands fa-product-hunt fs-3" aria-hidden="true"></i></span>
                            </a>
                            <div class="flex-grow-1">
                                <a href="#" class="text-white fs-5 fw-bold lh-0">Total Order
                                    <span class="pt-4 text-white fw-semibold d-block fs-6">{{ date('d M Y') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center pe-4">
                            <div>
                                <span class="text-gray-800 fs-3x fw-bold me-2 lh-1 ls-n2">{{ $orders->total() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto col-xl-4">
            <div class="shadow-sm card card-flush">
                <div class="p-0 card-body">
                    <div class="d-flex flex-stack justify-content-between">
                        <div class="p-8 d-flex align-items-center me-3 rounded-3 bg-dark">
                            <a href="javascript:void(0)">
                                <span class="p-3 bg-black rounded-3 me-3"><i
                                        class="text-white fa-solid fa-clock-rotate-left fs-3"
                                        aria-hidden="true"></i></span>
                            </a>
                            <div class="flex-grow-1">
                                <a href="#" class="text-white fs-5 fw-bold lh-0">Total Order Pending
                                    <span class="pt-4 text-white fw-semibold d-block fs-6">{{ date('d M Y') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center pe-4">
                            <div>
                                <span
                                    class="text-gray-800 fs-3x fw-bold me-2 lh-1 ls-n2">{{ $pendingOrdersCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto col-xl-4">
            <div class="shadow-sm card card-flush">
                <div class="p-0 card-body">
                    <div class="d-flex flex-stack justify-content-between">
                        <div class="p-8 d-flex align-items-center me-3 rounded-3 bg-dark">
                            <a href="javascript:void(0)">
                                <span class="p-3 bg-black rounded-3 me-3"><i class="text-white fa-solid fa-truck fs-3"
                                        aria-hidden="true"></i></span>
                            </a>
                            <div class="flex-grow-1">
                                <a href="#" class="text-white fs-5 fw-bold lh-0">Total Order Delivered
                                    <span class="pt-4 text-white fw-semibold d-block fs-6">{{ date('d M Y') }}</span>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center pe-4">
                            <div>
                                <span
                                    class="text-gray-800 fs-3x fw-bold me-2 lh-1 ls-n2">{{ $deliveredOrdersCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 card">
        <div class="card-header bg-dark align-items-center d-flex justify-content-between">
            <div>
                <h1 class="mb-0 text-center text-white w-100">Manage Your Orders</h1>
            </div>
        </div>

        <div class="card-body table-responsive" id="ordersTableContainer">
            @include('admin.pages.orderManagement.partial.indexTable')
        </div>
    </div>

    <div class="modal fade" id="globalInvoiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="border-0 modal-header d-flex justify-content-center">
                    <h1 class="mb-0" id="globalInvoiceModalTitle"></h1>
                </div>

                <div class="pt-0 modal-body" id="globalInvoiceModalBody">
                    <div class="text-center py-10">
                        <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('click', async function(e) {
                const link = e.target.closest('#ordersTableContainer .pagination a');
                if (link) {
                    e.preventDefault();

                    const url = link.getAttribute('href');
                    const container = document.getElementById('ordersTableContainer');

                    container.innerHTML = `
                        <div class="text-center py-10">
                            <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                        </div>
                    `;

                    try {
                        const res = await fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!res.ok) {
                            throw new Error('Failed to load orders');
                        }

                        const html = await res.text();
                        container.innerHTML = html;

                    } catch (err) {
                        container.innerHTML = `
                            <div class="alert alert-danger mb-0">
                                ${err.message ?? 'Something went wrong'}
                            </div>
                        `;
                    }

                    return;
                }

                const btn = e.target.closest('.js-invoice-print-btn');
                if (btn) {
                    e.preventDefault();

                    const url = btn.getAttribute('data-url');
                    const modalEl = document.getElementById('globalInvoiceModal');
                    const modalBody = document.getElementById('globalInvoiceModalBody');
                    const modalTitle = document.getElementById('globalInvoiceModalTitle');

                    modalTitle.innerHTML = '';
                    modalBody.innerHTML = `
                        <div class="text-center py-10">
                            <span class="spinner-border spinner-border-sm me-2"></span> Loading...
                        </div>
                    `;

                    const modal = new bootstrap.Modal(modalEl);
                    modal.show();

                    try {
                        const res = await fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!res.ok) {
                            throw new Error('Failed to load invoice');
                        }

                        const html = await res.text();
                        modalBody.innerHTML = html;

                        const title = btn.getAttribute('data-title');
                        if (title) {
                            modalTitle.innerHTML = title;
                        }

                    } catch (err) {
                        modalBody.innerHTML = `
                            <div class="alert alert-danger mb-0">
                                ${err.message ?? 'Something went wrong'}
                            </div>
                        `;
                    }

                    return;
                }
            });
        </script>
        <script>
            window.downloadInvoice = function(btnEl) {
                const btn = btnEl ? btnEl : document.getElementById('downloadInvoiceBtn');
                if (!btn) return;

                const spinner = btn.querySelector('.spinner-border');
                const text = btn.querySelector('.btn-text');

                btn.disabled = true;
                if (spinner) spinner.classList.remove('d-none');
                if (text) text.classList.add('opacity-50');

                // ✅ find the currently opened invoice card inside the modal
                const modalBody = document.getElementById('globalInvoiceModalBody');
                if (!modalBody) {
                    btn.disabled = false;
                    if (spinner) spinner.classList.add('d-none');
                    if (text) text.classList.remove('opacity-50');
                    return;
                }

                const card = modalBody.querySelector('.card-print');
                if (!card) {
                    btn.disabled = false;
                    if (spinner) spinner.classList.add('d-none');
                    if (text) text.classList.remove('opacity-50');
                    return;
                }

                // ✅ open a new window and print only invoice HTML
                const printWindow = window.open('', '_blank', 'width=900,height=650');
                if (!printWindow) {
                    btn.disabled = false;
                    if (spinner) spinner.classList.add('d-none');
                    if (text) text.classList.remove('opacity-50');
                    return;
                }

                // Clone current page styles so invoice looks the same
                const styles = Array.from(document.querySelectorAll('link[rel="stylesheet"], style'))
                    .map(el => el.outerHTML)
                    .join("\n");

                printWindow.document.open();
                printWindow.document.write(`
            <html>
                <head>
                    <title>Invoice</title>
                    ${styles}
                </head>
                <body>
                    ${card.outerHTML}
                </body>
            </html>
        `);
                printWindow.document.close();

                // Wait for assets/fonts then print
                printWindow.onload = function() {
                    setTimeout(function() {
                        printWindow.focus();
                        printWindow.print();
                        printWindow.close();

                        btn.disabled = false;
                        if (spinner) spinner.classList.add('d-none');
                        if (text) text.classList.remove('opacity-50');
                    }, 400);
                };
            };
        </script>
    @endpush
</x-admin-app-layout>
