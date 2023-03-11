
@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Review Transaction</title>
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
    {{-- <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" /> --}}
    <!-- Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Datatables -->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" /> --}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"> --}}
    <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head> 
@endpush
@section('content')
@section('page','Dashboard')
@section('page-title','Review Transaction')
@section('subtitle','Transactions')
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
                <!--begin::API Overview-->
                <div class="card mb-5 mb-xxl-10">
                    <!--begin::Header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <div class="card-title">
                            <h3>Date range search</h3>
                        </div>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                <span class="form-check-label text-muted me-2">Paydrc</span>
                                <input class="form-check-input" id="switchValue" type="checkbox"  value="false" />
                                <span class="form-check-label text-muted">Switch</span>
                            </label>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-10">
                        <!--begin::Row-->
                        <div class="row mb-10 input-daterange">
                            <!--begin::Col-->
                            <div class="col-md-4 pb-10 pb-lg-0">
                                <input type="text" readonly id="start_date" placeholder="From Date" class="form-control form-control-solid"/>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-4 pb-10 pb-lg-0">
                                <input type="text" readonly id="end_date" placeholder="To Date" class="form-control form-control-solid"/>
                            </div>

                            <div class="col-md-4 pb-10 pb-lg-0">
                                <button type="button" name="filter" id="filter" class="btn btn-primary">Search</button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-secondary">Reset</button>
                            </div>
                            <div class="py-3 d-flex flex-stack flex-wrap">
                                <div class="d-flex my-3 ms-2">
                                    <label class="form-check form-check-custom form-check-solid me-5">
                                        Both 
                                    </label>
                                    <input class="form-check-input me-5 action" type="radio" value="both" name="action" />
                                    <label class="form-check form-check-custom form-check-solid me-5">
                                        Debit
                                    </label>
                                    <input class="form-check-input me-5 action" type="radio" value="debit" name="action" />
                                    <label class="form-check form-check-custom form-check-solid me-5">
                                        Credit
                                    </label>
                                    <input class="form-check-input action" type="radio" value="credit" name="action" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::API overview-->
                <div class="card mb-5 mb-xl-8">
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive paydrc">
                            <!--begin::Table-->
                            <table class="table table-dark table-striped align-middle gs-0 gy-4" id="paydrc_table">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 min-w-40px">#</th>
                                        <th class="min-w-40px">Merchant</th>
                                        <th class="min-w-40px">Customer</th>
                                        <th class="min-w-40px">Amount</th>
                                        <th class="min-w-40px">Currency</th>
                                        <th class="min-w-40px">Action</th>
                                        <th class="min-w-40px">Method</th>
                                        <th class="min-w-40px">Status</th>
                                        <th class="min-w-60px">ThirdParty</th>
                                        <th class="min-w-150px">Freshpay Ref.</th>
                                        <th class="min-w-150px">Switch Ref.</th>
                                        <th class="min-w-150px">Telco Ref.</th>
                                        <th class="min-w-150px">Created_at</th>
                                        <th class="min-w-150px">Updated_at</th>
                                        <th class="min-w-150px">Description</th>
                                    </tr>
                                </thead>

                                {{-- <tbody></tbody> --}}
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <div class="table-responsive switch" style="display: none">
                            <!--begin::Table-->
                            <table class="table table-primary table-striped align-middle gs-0 gy-4" id="switch_table">
                                <!--begin::Table head-->
                                <thead >
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 min-w-40px">#</th>
                                        <th class="min-w-40px">Customer</th>
                                        <th class="min-w-40px">Amount</th>
                                        <th class="min-w-40px">Currency</th>
                                        <th class="min-w-40px">Action</th>
                                        <th class="min-w-40px">Method</th>
                                        <th class="min-w-40px">Status</th>
                                        <th class="min-w-150px">Paydrc Ref.</th>
                                        <th class="min-w-150px">Switch Ref.</th>
                                        <th class="min-w-150px">Telco Ref.</th>
                                        <th class="min-w-150px">Created_at</th>
                                        <th class="min-w-150px">Updated_at</th>
                                    </tr>
                                </thead>

                                {{-- <tbody></tbody> --}}
                                <!--end::Table body-->
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
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
<!-- Datepicker -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Datatables -->
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"> --}}
{{-- </script> --}}
<!-- Momentjs -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script>
    $("#switchValue").on('change', function() {
        if ($(this).is(':checked')) {
            $('#switch_table').DataTable().destroy();
            switchStatus = $(this).is(':checked');
            switch_data();
            function switch_data(start_date = '', end_date = '', action = ''){
                $('#switch_table').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: {
                        url:'{{  route('admin.switch.daterange') }}',
                        data:{start_date:start_date, end_date:end_date, action:action}
                    },

                    columns: [
                        {class : "text-center", data: 'id', name: 'id'},
                        // {data: 'merchant_code', name: 'merchant_code'},
                        {data: 'source_account_number', name: 'source_account_number'},
                        {data: 'amount', name: 'amount'},
                        {data: 'currency', name: 'currency'},
                        {data: 'trans_type', name: 'trans_type'},
                        {data: 'financial_institution', name: 'financial_institution'},
                        {data: 'status', name: 'status'},
                        {data: 'merchant_ref', name: 'merchant_ref'},
                        {data: 'trans_ref_no', name: 'trans_ref_no'},
                        {data: 'financial_institution_transaction_id', name: 'financial_institution_transaction_id'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                    ]

                });
            }
            toastr.info(
                "Switch ON", 
                {timeOut: 1, extendedTimeOut: 1, closeButton: true, closeDuration: 1}
            );
            $('#filter').click(function(){
                var from_date = $('#start_date').val();
                var to_date = $('#end_date').val();
                var action = $(".action:checked").val();
                var switchStatus = false;
                var switchStatus=document.getElementById("switchValue").checked;
                console.log(switchStatus);
                if(from_date != '' &&  to_date != '' &&  action != ''){
                    $('#switch_table').DataTable().destroy();
                    switch_data(from_date, to_date, action, switchStatus);
                } else{
                    alert('Both item is required');
                }
            });
            $('#refresh').click(function(){
                $('#start_date').val('');
                $('#end_date').val('');
                $('.action:checked').prop('checked', false);
                $('#switch_table').DataTable().destroy();
                switch_data();
            });
            $('.paydrc').hide();
            $(".switch").show()
            $('#paydrc_table').DataTable().destroy();

        }
        else {
            $('#paydrc_table').DataTable().destroy();
            switchStatus = $(this).is(':checked');
            paydrc_data();
            function paydrc_data(start_date = '', end_date = '', action = ''){
                $('#paydrc_table').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: {
                        url:'{{  route('admin.paydrc.daterange') }}',
                        data:{start_date:start_date, end_date:end_date, action:action}
                    },

                    columns: [
                        {class : "text-center", data: 'id', name: 'id'},
                        {data: 'merchant_code', name: 'merchant_code'},
                        {data: 'customer_details', name: 'customer_details'},
                        {data: 'amount', name: 'amount'},
                        {data: 'currency', name: 'currency'},
                        {data: 'action', name: 'action'},
                        {data: 'method', name: 'method'},
                        {data: 'status', name: 'status'},
                        {data: 'thirdparty_reference', name: 'thirdparty_reference'},
                        {data: 'paydrc_reference', name: 'paydrc_reference'},
                        {data: 'switch_reference', name: 'switch_reference'},
                        {data: 'telco_reference', name: 'telco_reference'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'status_description', name: 'status_description'},
                    ]

                });
            }
            toastr.info(
                "PayDrc ON", 
                {timeOut: 1, extendedTimeOut: 1, closeButton: true, closeDuration: 1}
            );
            $('#filter').click(function(){
                var from_date = $('#start_date').val();
                var to_date = $('#end_date').val();
                var action = $(".action:checked").val();
                var switchStatus = false;
                var switchStatus=document.getElementById("switchValue").checked;
                console.log(switchStatus);
                if(from_date != '' &&  to_date != '' &&  action != ''){
                    $('#paydrc_table').DataTable().destroy();
                    paydrc_data(from_date, to_date, action, switchStatus);
                } else{
                    alert('Both item is required');
                }
            });
            $('#refresh').click(function(){
                $('#start_date').val('');
                $('#end_date').val('');
                $('.action:checked').prop('checked', false);
                $('#paydrc_table').DataTable().destroy();
                paydrc_data();
            });
            $('.paydrc').show();
            $(".switch").hide();
            $('#switch_table').DataTable().destroy();
        }
    });
</script>
<script>
    $(document).ready(function(){
        paydrc_data();
        $('#switch_table').DataTable().destroy();
            function paydrc_data(start_date = '', end_date = '', action = ''){
                $('#paydrc_table').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: {
                        url:'{{  route('admin.paydrc.daterange') }}',
                        data:{start_date:start_date, end_date:end_date, action:action}
                    },

                    dom:'lBfrtip',
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All'],
                    ],
                    "buttons": [
                        "csv", "excel", "pdf"
                    ],

                    columns: [
                        {class : "text-center", data: 'id', name: 'id'},
                        {data: 'merchant_code', name: 'merchant_code'},
                        {data: 'customer_details', name: 'customer_details'},
                        {data: 'amount', name: 'amount'},
                        {data: 'currency', name: 'currency'},
                        {data: 'action', name: 'action'},
                        {data: 'method', name: 'method'},
                        {data: 'status', name: 'status'},
                        {data: 'thirdparty_reference', name: 'thirdparty_reference'},
                        {data: 'paydrc_reference', name: 'paydrc_reference'},
                        {data: 'switch_reference', name: 'switch_reference'},
                        {data: 'telco_reference', name: 'telco_reference'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'status_description', name: 'status_description'},
                    ]

                });
            }
            $('#filter').click(function(){
                var from_date = $('#start_date').val();
                var to_date = $('#end_date').val();
                var action = $(".action:checked").val();
                var switchStatus = false;
                var switchStatus=document.getElementById("switchValue").checked;
                console.log(switchStatus);
                if(from_date != '' &&  to_date != '' &&  action != ''){
                    $('#paydrc_table').DataTable().destroy();
                    paydrc_data(from_date, to_date, action, switchStatus);
                } else{
                    alert('Both item is required');
                }
            });
            $('#refresh').click(function(){
                $('#start_date').val('');
                $('#end_date').val('');
                $('.action:checked').prop('checked', false);
                $('#paydrc_table').DataTable().destroy();
                paydrc_data();
            });
    });
</script>

<script>
    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });
</script>
@endsection
@endsection
