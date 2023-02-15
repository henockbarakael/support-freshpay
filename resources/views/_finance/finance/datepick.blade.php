
@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Update Transaction</title>
    <meta name="description" content="FreshPay Support Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="FreshPay | Support Dashboard">
    <meta property="og:url" content="https://gofreshpay.com/">
    <meta property="og:site_name" content="Support Dashboard | FreshPay ">
    <link rel="canonical" href="https://gofreshpay.com/">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
    <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    {{-- <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> 

    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style type="text/css">
    .ui-state-highlight {
      border: 0 !important;
    }
 
    .ui-state-highlight a {
      background: #363636 !important;
      color: #fff !important;
    }
        .loading {
            z-index: 20;
            position: absolute;
            top: 0;
            left:-5px;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .loading-content {
            position: absolute;
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            top: 50%;
            left:50%;
            animation: spin 2s linear infinite;
            }
              
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
    </style>
</head> 
@endpush
@section('content')
@section('page','Dashboard')
@section('page-title','Update Transaction Status')
@section('subtitle','Update Transaction')
{!! Toastr::message() !!}
@include('sweetalert::alert')
<div class="post d-flex flex-column-fluid" id="kt_post">
<!--begin::Container-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <section id="loading">
                    <div id="loading-content"></div>
                </section>
                <form action="#" id="postForm">
                    @csrf
                    <!--begin::Card-->
                    <div class="card mb-7">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Compact form-->
                            <div class="d-flex align-items-center">
                                {{-- <div class="row g-8"> --}}
                                    <div class="col-sm-8 me-5">
                                        {{-- <label class="form-label">Basic example</label> --}}
                                        <input class="form-control form-control-solid" type="text" id="datePick"/>
                                    </div>
                                    <div class="col-sm-4">
                                        <!--begin::Radio group-->
                                        <div class="nav-group nav-group-fluid mt-1">
                                            <!--begin::Option-->
                                            <label>
                                                <button type="submit" class="btn btn-primary me-5">Get payout</button>
                                            </label>
                                        </div>
                                        <!--end::Radio group-->
                                    </div>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1" style="font-size: 12px">Transaction</span>
                            {{-- <span class="text-muted mt-1 fw-semibold fs-7">Total Transaction : {{$count}}</span> --}}
                        </h3>
                        <div class="card-toolbar">
                            <!--begin::Export dropdown-->
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="currentColor"></rect>
                                        <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="currentColor"></path>
                                        <path opacity="0.3" d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="currentColor"></path>
                                    </svg>
                                </span>Export Report
                            </button>
        
                            <!--begin::Menu-->
                            <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-export="csv">
                                    Export as CSV
                                </a>
                            </div>

                            </div>
                            <!--begin::Hide default export buttons-->
                            <div id="kt_datatable_example_buttons" class="d-none"></div>
                            <!--end::Hide default export buttons-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-dark table-striped align-middle gs-0 gy-4" id="kt_datatable_example_1">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        {{-- <th class="ps-4 min-w-40px">#</th> --}}
                                        <th class="min-w-40px">Merchant</th>
                                        <th class="min-w-40px">Customer</th>
                                        <th class="min-w-40px">Amount</th>
                                        <th class="min-w-40px">Currency</th>
                                        <th class="min-w-40px">Action</th>
                                        <th class="min-w-40px">Method</th>
                                        <th class="min-w-40px">Method</th>
                                    </tr>
                                </thead>
                                <tbody id="table_content">
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

</div>
<!--end::Container-->
</div>
@section('script')
<script>var hostUrl = "assets/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/dubrox/Multiple-Dates-Picker-for-jQuery-UI@master/jquery-ui.multidatespicker.js"></script>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

<script>
    $(document).ready(function () {
      $('#datePick').multiDatesPicker();
    });
  </script>
<script type="text/javascript">

    $("#postForm").submit(function(e){
        e.preventDefault();
        var daterange = document.getElementById('datePick').value;
        $.ajax({
            url: "{{url('finance/pending-payout')}}",
            type: "POST",
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                daterange: daterange,
            },
            dataType: 'json',
            success: function (responseOutput) {
                if (responseOutput['success']==true) {
                    var responseInfo = responseOutput.data;
                    var bodyData = '';
                    $.each(responseInfo,function(index,row){
                        bodyData+=
                        bodyData+='<tr>'+
                                    '<td>'+row.customer_number+'</td>'+
                                    '<td>'+row.paydrc_reference+'</td>'+
                                    '<td>'+row.switch_reference+'</td>'+
                                    '<td>'+row.financial_institution_id+'</td>'+
                                    '<td>'+row.status+'</td>'+
                                    '<td>'+row.new_status+'</td>'+
                                    '<td>'+row.financial_status_description+'</td>';
                                  '</tr>';
                        
                    })
                    $('#table_content').html(bodyData);
                    $("#postForm")[0].reset();
                }
                else if(responseOutput['success']==false){
                    alert("Transaction not found. Please verify the reference!"); 
                    var responseInfo = responseOutput.data;
                    var bodyData = '';
                    $.each(responseInfo,function(index,row){
                        bodyData+=
                        bodyData+='<tr>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>'+
                                    '<td>Not found</td>';
                                  '</tr>';
                        
                    })
                    $('#table_content').html(bodyData);
                    $("#postForm")[0].reset();
                }
              
                    
        
            }
        });
    });
</script>
<script type="text/javascript">
  
    
      
</script>
<script type="text/javascript">
    $(document).ajaxStart(function() {
        $('#loading').addClass('loading');
        $('#loading-content').addClass('loading-content');
    });
    $(document).ajaxStop(function() {
        $('#loading').removeClass('loading');
        $('#loading-content').removeClass('loading-content');
    });
</script>
<script type="text/javascript">
    function successConfirmation(id) {
        Swal.fire({
            title: "Success?",
            icon: 'question',
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, success it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "{{url('finance/success-single/')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Done!", results.message, "success");
                            // refresh page after 2 seconds
                            setTimeout(function(){
                                window.location.replace("{{url('finance/update-result')}}");
                            },3000);
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
</script>

<script type="text/javascript">
    function failedConfirmation(id) {
        
        Swal.fire({
            title: "Failed?",
            icon: 'question',
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, failed it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var redirect = "{{route('finance.update.create')}}"
                $.ajax({
                    type: 'POST',
                    url: "{{url('finance/failed-single/')}}/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Done!", results.message, "success");
                            // refresh page after 2 seconds
                            // results.preventDefault();
                            // return false;
                            setTimeout(function(){
                                window.location.replace("{{url('finance/update-result')}}");
                            },3000);
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    }
                });

                

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
</script>

<script type="text/javascript">
    "use strict";
    
    // Class definition
    var KTDatatablesExample = function () {
        // Shared variables
        var table;
        var datatable;
    
        // Private functions
        var initDatatable = function () {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');
    
            tableRows.forEach(row => {
                const dateRow = row.querySelectorAll('td');
                const realDate = moment(dateRow[3].innerHTML, "DD MMM YYYY, LT").format(); // select date from 4th column in table
                dateRow[3].setAttribute('data-order', realDate);
            });
    
            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "order": [[ 0, 'desc' ]],
                "language": {
                "lengthMenu": "Show _MENU_",
                },
                "dom":
                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
            });
        }
    
        // Hook export buttons
        var exportButtons = () => {
            const documentTitle = 'Charge_'+'<?php ; ?>';
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {
                        extend: 'csvHtml5',
                        title: documentTitle
                    }
                ]
            }).container().appendTo($('#kt_datatable_example_buttons'));
    
            // Hook dropdown menu click event to datatable export buttons
            const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();
    
                    // Get clicked export value
                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);
    
                    // Trigger click event on hidden datatable export buttons
                    target.click();
                });
            });
        }
    
        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        // var handleSearchDatatable = () => {
        //     const filterSearch = document.querySelector('[data-kt-filter="search"]');
        //     filterSearch.addEventListener('keyup', function (e) {
        //         datatable.search(e.target.value).draw();
        //     });
        // }
    
        // Public methods
        return {
            init: function () {
                table = document.querySelector('#kt_datatable_example_1');
    
                if ( !table ) {
                    return;
                }
    
                initDatatable();
                exportButtons();
                // handleSearchDatatable();
            }
        };
    }();
    
    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesExample.init();
    });
</script>
@endsection
@endsection
