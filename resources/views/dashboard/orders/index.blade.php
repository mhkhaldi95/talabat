@extends('layout.master')
@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">

                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Add customer-->
{{--                            <a href="{{route('coupons.create')}}" type="button" class="btn btn-primary" >{{__('lang.add')}}</a>--}}
                            <!--end::Add customer-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                                <span class="me-2" data-kt-customer-table-select="selected_count"></span>{{__('lang.selected')}}</div>
                            <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected" id="delete_selected">{{__('lang.delete_selected')}}</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Form-->
                <form action="#">
                    <!--begin::Card-->
                    <div class="card mb-7">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Compact form-->
                            <div class="d-flex align-items-center">
                                <!--begin::Input group-->
                                <div class="position-relative w-md-400px me-md-2">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span
                                        class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                                  height="2" rx="1"
                                                                  transform="rotate(45 17.0365 15.1223)"
                                                                  fill="currentColor"/>
															<path
                                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                fill="currentColor"/>
														</svg>
													</span>
                                    <!--end::Svg Icon-->
                                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{__('lang.search')}}" />
                                </div>
                                <!--end::Input group-->

                                <!--begin:Action-->
                                <div class="d-flex align-items-center">
                                    <a id="kt_horizontal_search_advanced_link" class="btn btn-link"
                                       data-bs-toggle="collapse" href="#kt_advanced_search_form">البحث المتقدم</a>
                                </div>
                                <!--end:Action-->
                            </div>
                            <!--end::Compact form-->
                            <!--begin::Advance form-->
                            <div class="collapse" id="kt_advanced_search_form">
                                <!--begin::Separator-->
                                <div class="separator separator-dashed mt-9 mb-6"></div>
                                <!--end::Separator-->
                                <!--begin::Row-->
                                <div class="row g-8 mb-8">
                                    <!--begin::Row-->
                                    <div class="row g-8 academic-dev">
                                        <!--begin::Col-->
                                        <div class="col-lg-3">
                                            <!--begin::Label-->
                                            <label class="form-label fs-5 fw-bold mb-3">{{__('lang.user')}}:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select form-select-solid  w-250px fw-bolder " data-kt-select2="true" data-placeholder="{{__('lang.select')}}" data-allow-clear="true"  id="customer_filter" >
                                                <option></option>
                                                @foreach($customers as $customer)
                                                    <option value="{{$customer->id}}" >{{$customer->name}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-lg-3">
                                            <!--begin::Label-->
                                            <label class="form-label fs-5 fw-bold mb-3">{{__('lang.branch')}}:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select form-select-solid  w-250px fw-bolder " data-kt-select2="true" data-placeholder="{{__('lang.select')}}" data-allow-clear="true"  id="branch_filter" >
                                                <option></option>
                                                @foreach($branches as $branch)
                                                    <option value="{{$branch->branch->id}}" >{{$branch->branch->address}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Col-->
                                        <div class="col-lg-3">
                                            <!--begin::Label-->
                                            <label class="form-label fs-5 fw-bold mb-3">{{__('lang.Status')}}:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select form-select-solid w-250px fw-bolder status_filter" data-kt-select2="true" data-placeholder="{{__('lang.select')}}" data-allow-clear="true"  id="status_filter" >
                                                <option></option>
                                                <option value="{{\App\Constants\Enum::INITIATED}}" >{{__('lang.'.\App\Constants\Enum::INITIATED)}}</option>
                                                <option value="{{\App\Constants\Enum::PAID}}" >{{__('lang.'.\App\Constants\Enum::PAID)}}</option>
                                                <option value="{{\App\Constants\Enum::REJECT}}" >{{__('lang.'.\App\Constants\Enum::REJECT)}}</option>
                                                <option value="{{\App\Constants\Enum::ACCEPT}}" >{{__('lang.'.\App\Constants\Enum::ACCEPT)}}</option>
                                                <option value="{{\App\Constants\Enum::DONE}}" >{{__('lang.'.\App\Constants\Enum::DONE)}}</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Col-->



                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Advance form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </form>
                <!--end::Form-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-70px text-start">
                              #
                            </th>
                            <th class="min-w-125px">{{__('lang.branch')}}</th>
                            <th class="min-w-125px">{{__('lang.user')}}</th>
                            <th class="min-w-125px">{{__('lang.price')}}</th>
                            <th class="min-w-125px">{{__('lang.date')}}</th>
                            <th class="min-w-125px">{{__('lang.status')}}</th>

                            <th class="text-end min-w-70px">{{__('lang.actions')}}</th>
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
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Modals-->
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection
@section('scripts')
    <script>

        // $("#datatable").DataTable();
        "use strict";

        // Class definition
        var KTDatatablesServerSide = function () {
            // Shared variables
            var table;
            var dt;
            var filterPayment;

            // Private functions
            var initDatatable = function () {
                dt = $("#datatable").DataTable({
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    order: [],
                    stateSave: true,
                    select: {
                        style: 'multi',
                        selector: 'td:first-child input[type="checkbox"]',
                        className: 'row-selected'
                    },
                    ajax: {
                        // url: "https://preview.keenthemes.com/api/datatables.php",
                        url: "{{url()->current()}}",
                    },
                    columns: [
                        { data: 'id' },
                        { data: 'branch' },
                        { data: 'user' },
                        { data: 'price' },
                        { data: 'created_at' },
                        { data: 'status' },
                        { data: 'actions' },
                    ],
                    columnDefs: [

                        {
                            targets: 0,
                            orderable: true,
                        },
                        {
                            targets: -1,
                            data: null,
                            orderable: false,
                            className: 'text-end',
                        },
                    ],
                    // Add data-filter attribute
                    createdRow: function (row, data, dataIndex) {
                        // $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
                    }
                });

                table = dt.$;

                // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
                dt.on('draw', function () {
                    initToggleToolbar();
                    toggleToolbars();
                    handleDeleteRows();
                    KTMenu.createInstances();
                });
            }
            $('#status_filter').change(function (){
                dt.search($(this).val().toLowerCase(), 'status').draw();
            });
            $('#customer_filter').change(function (){
                dt.search($(this).val().toLowerCase(), 'user_id').draw();
            });
            $('#branch_filter').change(function (){
                dt.search($(this).val().toLowerCase(), 'branch_id').draw();
            });

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = function () {

                // const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
                const filterSearch = document.querySelector('#search');
                filterSearch.addEventListener('keyup', function (e) {
                    dt.search(e.target.value,"search").draw();
                });
            }

            // Filter Datatable
            var handleFilterDatatable = () => {
                // Select filter options
                filterPayment = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]');
                // filterPayment = document.querySelector('#payment_type');
                // const filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');

            }

            // Delete customer
            var handleDeleteRows = () => {
                // Select all delete buttons
                const deleteButtons = document.querySelectorAll('[data-kt-docs-table-filter="delete_row"]');
                const receiveButtons = document.querySelectorAll('[data-kt-docs-table-filter="receive-order"]');

                deleteButtons.forEach(d => {
                    // Delete button on click
                    d.addEventListener('click', function (e) {
                        e.preventDefault();
                        // Select parent row
                        const parent = e.target.closest('tr');
                        var record_id = $(parent.children[0]).children().children().val();
                        // Get customer name
                        const customerName = parent.querySelectorAll('td')[1].innerText;

                        // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "{{__('lang.Are you sure you want to delete')}} " + customerName + "?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, delete!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                // Simulate delete request -- for demo purpose only
                                Swal.fire({
                                    text: "Deleting " + customerName,
                                    icon: "info",
                                    buttonsStyling: false,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function () {
                                    Swal.fire({
                                        text: "You have deleted " + customerName + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                        // delete row data from server and re-draw datatable
                                        axios.post('/admin/orders/'+record_id+'/delete').then(function (response) {
                                            dt.draw();
                                        })
                                    });
                                });
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: customerName + " was not deleted.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    })
                });
                receiveButtons.forEach(d => {
                    // Delete button on click
                    d.addEventListener('click', function (e) {
                        e.preventDefault();
                        // Select parent row
                        const parent = e.target.closest('tr');
                        var record_id = $(parent.children[0]).children().children().val();
                        // Get customer name
                        const orderID = parent.querySelectorAll('td')[0].innerText;

                        // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "{{__('lang.Are you sure you want to receive order')}} #" + orderID + "?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, receive!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-success",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                // Simulate delete request -- for demo purpose only
                                Swal.fire({
                                    text: "Receiving order #" + orderID,
                                    icon: "info",
                                    buttonsStyling: false,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function () {
                                    Swal.fire({
                                        text: "You have received order #" + orderID + "!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                        // delete row data from server and re-draw datatable
                                        axios.get('/admin/orders/'+orderID+'/receive').then(function (response) {
                                            dt.draw();
                                        })
                                    });
                                });
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: 'order #'+orderID + " was not received.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    })
                });
            }

            // Reset Filter
            var handleResetForm = () => {
                // Select reset button
                // const resetButton = document.querySelector('[data-kt-docs-table-filter="reset"]');

            }

            // Init toggle toolbar
            var initToggleToolbar = function () {
                // Toggle selected action toolbar
                // Select all checkboxes
                const container = document.querySelector('#datatable');
                const checkboxes = container.querySelectorAll('[type="checkbox"]');

                // Select elements
                const deleteSelected = document.querySelector('#delete_selected');
                // Toggle delete selected toolbar
                checkboxes.forEach(c => {
                    // Checkbox on click event
                    c.addEventListener('click', function () {
                        setTimeout(function () {
                            toggleToolbars();
                        }, 50);
                    });
                });


                // Deleted selected rows
                deleteSelected.addEventListener('click', function () {
                    // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "{{__('lang.confirm_delete_message')}}",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        showLoaderOnConfirm: true,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        },
                    }).then(function (result) {
                        if (result.value) {
                            // Simulate delete request -- for demo purpose only
                            Swal.fire({
                                text: "{{__('lang.Deleting selected records')}}",
                                icon: "info",
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function () {
                                Swal.fire({
                                    text: "{{__('lang.You have deleted all selected records!')}}",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    const ids = [];
                                    const headerCheck = container.querySelectorAll('[type="checkbox"]');
                                        headerCheck.forEach((element) => {
                                        if(element.checked == true)
                                            ids.push(parseInt($(element).val()));
                                    });
                                    // delete row data from server and re-draw datatable
                                    axios.post('/admin/orders/delete-selected',{'ids':ids}).then(function (response) {
                                        dt.draw();
                                    })
                                });

                                // Remove header checked box

                                const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];

                                headerCheckbox.checked = false;
                            });
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: "Selected records was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                });
            }

            // Toggle toolbars
            var toggleToolbars = function () {
                // Define variables
                const container = document.querySelector('#datatable');
                const toolbarBase = document.querySelector('[data-kt-customer-table-toolbar="base"]');
                const toolbarSelected = document.querySelector('[data-kt-customer-table-toolbar="selected"]');
                const selectedCount = document.querySelector('[data-kt-customer-table-select="selected_count"]');

                // Select refreshed checkbox DOM elements
                const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

                // Detect checkboxes state & count
                let checkedState = false;
                let count = 0;

                // Count checked boxes
                allCheckboxes.forEach(c => {
                    if (c.checked) {
                        checkedState = true;
                        count++;
                    }
                });

                // Toggle toolbars
                if (checkedState) {
                    selectedCount.innerHTML = count;
                    toolbarBase.classList.add('d-none');
                    toolbarSelected.classList.remove('d-none');
                } else {
                    toolbarBase.classList.remove('d-none');
                    toolbarSelected.classList.add('d-none');
                }
            }

            // Public methods
            return {
                init: function () {
                    initDatatable();
                    handleSearchDatatable();
                    initToggleToolbar();
                    handleFilterDatatable();
                    handleDeleteRows();
                    handleResetForm();
                }
            }
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTDatatablesServerSide.init();
        });
        $(document).ready(function() {
            //set initial state.
            $('#all_checked').val(this.checked);

            $('#all_checked').change(function() {
                const headerAllCheck = document.querySelector('#datatable').querySelectorAll('[type="checkbox"]');
                if(this.checked) {
                    headerAllCheck.forEach((element) => {
                        element.checked = true
                    });
                }else{
                    headerAllCheck.forEach((element) => {
                        element.checked = false
                    });
                }
                $('#all_checked').val(this.checked);
            });
        });
    </script>
@endsection
