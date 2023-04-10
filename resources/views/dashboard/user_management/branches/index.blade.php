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
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
													</svg>
												</span>
                            <!--end::Svg Icon-->
                            <input type="text" id="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{__('lang.search')}}" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Add customer-->
                            <a href="{{route('branches.create')}}" type="button" class="btn btn-primary" >{{__('lang.add')}}</a>
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
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="datatable">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" id="all_checked" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-125px">{{__('lang.name')}}</th>
                            <th class="min-w-125px">{{__('lang.email')}}</th>
                            <th class="min-w-125px">{{__('lang.address')}}</th>
                            <th class="min-w-125px">{{__('lang.Status')}}</th>
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

            // Private functions
            var initDatatable = function () {
                dt = $("#datatable").DataTable({
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    order: [[4, 'desc']],
                    stateSave: false,
                    select: {
                        style: 'multi',
                        selector: 'td:first-child input[type="checkbox"]',
                        className: 'row-selected'
                    },
                    ajax: {
                        url: "{{route('branches.index')}}",
                    },
                    columns: [
                        { data: 'id' },
                        { data: 'name' },
                        { data: 'email' },
                        { data: 'address' },
                        { data: 'status' },
                        { data: 'actions' },
                    ],
                    columnDefs: [
                        {
                            targets: 0,
                            orderable: false,

                        },
                        {
                            targets: 1,
                            orderable: false,
                            render: function (data,type,row) {
                                return row.user.name ;
                            }

                        },
                        {
                            targets: 2,
                            orderable: true,
                            render: function (data,type,row) {
                                return row.user.email ;
                            }

                        },
                        {
                            targets: 3,
                            orderable: false,

                        },
                        {
                            targets: 4,
                            orderable: true,

                        },
                        {
                            targets: 5,
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

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = function () {

                // const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
                const filterSearch = document.querySelector('#search');
                filterSearch.addEventListener('keyup', function (e) {
                    dt.search(e.target.value,'search').draw();
                });
            }

            // Filter Datatable
            var handleFilterDatatable = () => {
                // Select filter options
                // const filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');
                // const filterButton = document.querySelector('#filter');
                // Filter datatable on submit
                filterButton.addEventListener('click', function () {
                    // Get filter values
                    let paymentValue = '';



                });
            }

            // Delete customer
            var handleDeleteRows = () => {
                // Select all delete buttons
                // const deleteButtons = document.querySelectorAll('[data-kt-docs-table-filter="delete_row"]');
                const deleteButtons = document.querySelectorAll('#delete_row');

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
                                        axios.post('/admin/branches/'+record_id+'/delete').then(function (response) {
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
            }

            // Reset Filter
            var handleResetForm = () => {
                // Select reset button
                // const resetButton = document.querySelector('[data-kt-docs-table-filter="reset"]');
                const resetButton = document.querySelector('#reset');

                // Reset datatable
                resetButton.addEventListener('click', function () {
                    dt.search('').draw();
                });
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
                                    axios.post('/admin/branches/delete-selected',{'ids':ids}).then(function (response) {
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
                    // handleFilterDatatable();
                    handleDeleteRows();
                    // handleResetForm();
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
