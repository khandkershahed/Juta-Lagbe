<x-frontend-app-layout :title="'View Catalouge'">
    <style>
        .checkbox-wrapper-28 {
            --size: 20px;
            position: relative;
        }

        .checkbox-wrapper-28 *,
        .checkbox-wrapper-28 *:before,
        .checkbox-wrapper-28 *:after {
            box-sizing: border-box;
        }

        .checkbox-wrapper-28 .promoted-input-checkbox {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        .checkbox-wrapper-28 input:checked~svg {
            height: calc(var(--size) * 0.6);
            -webkit-animation: draw-checkbox-28 ease-in-out 0.2s forwards;
            animation: draw-checkbox-28 ease-in-out 0.2s forwards;
        }

        .checkbox-wrapper-28 label:active::after {
            background-color: #e6e6e6;
        }

        .checkbox-wrapper-28 label {
            color: var(--site-green);
            line-height: var(--size);
            cursor: pointer;
            position: relative;
        }

        .checkbox-wrapper-28 label:after {
            content: "";
            height: var(--size);
            width: var(--size);
            margin-right: 8px;
            float: left;
            border: 2px solid var(--site-green);
            border-radius: 3px;
            transition: 0.15s all ease-out;
        }

        .checkbox-wrapper-28 svg {
            stroke: var(--site-green);
            stroke-width: 3px;
            height: 0;
            width: calc(var(--size) * 0.6);
            position: absolute;
            left: calc(var(--size)* 0.18);
            top: calc(var(--size)* 0.30);
            stroke-dasharray: 33;
        }

        .checkbox-wrapper-29 svg {
            stroke: var(--site-green);
            stroke-width: 3px;
            height: 0;
            width: calc(var(--size) * 0.6);
            position: absolute;
            left: calc(var(--size)* 0.70);
            top: calc(var(--size)* 0.30);
            stroke-dasharray: 33;
        }

        @-webkit-keyframes draw-checkbox-28 {
            0% {
                stroke-dashoffset: 33;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes draw-checkbox-28 {
            0% {
                stroke-dashoffset: 33;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .form-check-inputs {
            position: absolute;
            margin-left: 0;
            bottom: 0;
            top: 10px;
            left: 15px;
        }

        input:focus {
            outline: none;
            box-shadow: none;
        }
    </style>
    <div class="breadcrumb-wrap">
        <div class="banner b-top bg-size bread-img">
            <img class="bg-img bg-top" src="img/banner-p.jpg" alt="banner" style="display: none;">
            <div class="container-lg">
                <div class="breadcrumb-box">
                    <div class="title-box3 text-center">
                        <h1>
                            Catalogue Library
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="ps-account">
        <div class="user-dashboard py-0 py-lg-8">
            <div class="container">
                <div class="row g-3 g-xl-4 tab-wrap">
                    <div class="col-lg-4 col-xl-3 sticky">
                        <!-- Sidebar here -->
                        @include('user.layouts.sidebar')
                    </div>
                    <div class="col-lg-8 col-xl-9">
                        <div class="card border-0">
                            <div class="card-header border-0 d-flex justify-content-between align-items-center">
                                <h4 class="mb-0 pb-0">Download Product Data</h4>
                                <div class="d-flex align-items-center">
                                    <div class="pr-3">
                                        <select class="form-control" name="" id="exampleFormControlSelect1"
                                            style="border-radius: 5px;">
                                            <option>Select Category</option>
                                            <option value="Meal Prep Boxes">Meal Prep Boxes</option>
                                            <option value="Takeaway Boxes">Takeaway Boxes</option>
                                            <option value="Beverage Containers">Beverage Containers</option>
                                            <option value="Cutlery & Accessories">Cutlery & Accessories</option>
                                        </select>
                                    </div>
                                    <div class="checkbox-wrapper-28">
                                        <input id="tmp-28" name="" type="checkbox"
                                            class="promoted-input-checkbox" />
                                        <svg>
                                            <use xlink:href="#checkmark-28" />
                                        </svg>
                                        <label for="tmp-28">
                                            Show All Product
                                        </label>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                                            <symbol id="checkmark-28" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-miterlimit="10" fill="none"
                                                    d="M22.9 3.7l-15.2 16.6-6.6-7.1">
                                                </path>
                                            </symbol>
                                        </svg>
                                    </div>
                                    <div class=" checkbox-wrapper-28 checkbox-wrapper-29 pl-3">
                                        <input id="tmp-29" name="" type="checkbox"
                                            class="promoted-input-checkbox" />
                                        <svg>
                                            <use xlink:href="#checkmark-29" />
                                        </svg>
                                        <label for="tmp-29">
                                            Download Excel
                                        </label>
                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
                                            <symbol id="checkmark-29" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-miterlimit="10" fill="none"
                                                    d="M22.9 3.7l-15.2 16.6-6.6-7.1">
                                                </path>
                                            </symbol>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mt-4">
                                    <table class="table table-striped order-history-table">
                                        <thead>
                                            <tr>
                                                <th width="8%" class="pl-3">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <input type="checkbox" class="form-check-inputs">
                                                    </div>
                                                </th>
                                                <th width="7%">SL</th>
                                                <th width="10%" class="text-center">Image</th>
                                                <th width="30%">Name</th>
                                                <th width="20%">Category</th>
                                                <th width="15%" class="text-center">QTY</th>
                                                <th width="20%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <input type="checkbox" class="">
                                                    </div>
                                                </td>
                                                <td>01</td>
                                                <td class="text-center">
                                                    <div>
                                                        <img src="http://127.0.0.1:8000/storage/products/thumbnail/rvBMkP0kJk1724828238.jpg"
                                                            class="" width="50px" height="50px" alt="">
                                                    </div>
                                                </td>
                                                <td>1 Compartment Meal Prep Containers (950ml)</td>
                                                <td> Meal Prep Boxes </td>
                                                <td class="text-center">10</td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)">
                                                        <i class="fa-solid fa-print"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#showProductData" class="pl-2">
                                                        <i class="fa-solid fa-expand"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="pl-2">
                                                        <i class="fa-solid fa-file-csv"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="showProductData" tabindex="-1" aria-labelledby="showProductDataLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header border-0 bg-info p-4">
                    <h5 class="modal-title text-white" id="showProductDataLabel">USB Air Cooler – Desktop</h5>
                    <button type="button" class="close fs-4 text-white" data-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark text-white" style="font-size: 22px"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light" style="background-color: #eee">
                                <tr>
                                    <th scope="col">Sl</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price/Availability</th>
                                    <th scope="col">Picture</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <div>
                                            <h4>USB Air Cooler – Desktop </h4>
                                            <p>5V, 500ma-2A portable and lightweight 3 speed fan
                                                control(low/medium/high) LED night light Long running time 8/10/12 hours
                                                high, mid, low water capacity 500ml cools and humidifies USB powered USB
                                                lead (supplied) Power supply required: Powerbank, USB adaptor or PC (not
                                                supplied) Input Voltage:220-240V Power usage: 7W
                                                Dimension;H16xW16.5xD14.5cm</p>
                                            <p><strong>SKU No:</strong> COOLER-16</p>
                                            <p><strong>Category:</strong>Baby Product</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <h4>৳ 5.75/pc</h4>
                                            <p><strong>Stock:</strong>150 Box</p>
                                            <p><strong>Box</strong>16 pcs</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="http://127.0.0.1:8000/storage/products/thumbnail/rvBMkP0kJk1724828238.jpg"
                                                class="img-fluid" alt="">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-app-layout>
