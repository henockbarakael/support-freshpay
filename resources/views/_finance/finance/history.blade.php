
@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Wallet History</title>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
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
@section('page-title','Wallet Histoy')
@section('subtitle','History')
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
                            <h3>Filter</h3>
                        </div>

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-10">
                        <!--begin::Row-->
                        <div class="row mb-10 input-daterange">
                            <!--begin::Col-->
                            <div class="col-md-48pb-10 pb-lg-0">
                                <input type="text" readonly id="start_date" placeholder="Pick a date" class="form-control form-control-solid"/>
                            </div>

                            <div class="col-md-4 pb-10 pb-lg-0 mt-5">
                                <button type="button" name="filter" id="filter" class="btn btn-primary">Search</button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-secondary">Reset</button>
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
                                        <th class="ps-4 min-w-100px">Institution</th>
                                        <th class="min-w-40px">Wallet</th>
                                        <th class="min-w-100px">Channel</th>
                                        <th class="min-w-40px">Vendor</th>
                                        <th class="min-w-40px">Fund</th>
                                        {{-- <th class="min-w-40px">Total</th> --}}
                                        <th class="min-w-40px">Currency</th>
                                        <th class="min-w-50px">Updated_at</th>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
</script>
<!-- Momentjs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>

<script>
    $(document).ready(function(){
        paydrc_data();
   
            function paydrc_data(start_date = ''){
                $('#paydrc_table').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: {
                        url:'{{  route('finance.wallet.history') }}',
                        data:{start_date:start_date}
                    },

                    columns: [
                        {class : "text-left ps-4", data: 'institution_name', name: 'institution_name'},
                        {data: 'wallet_code', name: 'wallet_code'},
                        {data: 'CHANNEL', name: 'CHANNEL'},
                        {data: 'vendor', name: 'vendor'},
                        {data: 'fund', name: 'fund'},
                        // {data: 'amount', name: 'amount'},
                        {data: 'currency', name: 'currency'},
                        {data: 'updated_at', name: 'updated_at'},
                    ]

                });
            }
            $('#filter').click(function(){
                var from_date = $('#start_date').val();
                if(from_date != ''){
                    $('#paydrc_table').DataTable().destroy();
                    paydrc_data(from_date);
                } else{
                    alert('Item is required');
                }
            });
            $('#refresh').click(function(){
                $('#start_date').val('');
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
