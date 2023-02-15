
@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Business Report | Pending Payout</title>
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
    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> 
    {{-- <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> --}}
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
@section('page-title','Business Report')
@section('subtitle','Pending Payout')
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
                {{-- <form action="#" id="postForm">
                    @csrf --}}
                    <!--begin::Card-->
                    <div class="card mb-7">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Compact form-->
                            <div class="d-flex align-items-center">
                                {{-- <div class="row g-8"> --}}
                                    {{-- <div class="col-sm-8 me-5"> --}}
                                        <div class="col-md-4 me-md-2">
                                            <input  id="start_date" placeholder="Pick a date" class="form-control form-control-solid"/>
                                        </div>
                                
                                        <div class="col-md-4 me-md-2">
                                            <input  id="end_date" placeholder="Pick a date" class="form-control form-control-solid"/>
                                        </div>
                                    {{-- </div> --}}
                                    <div class="col-sm-4">
                                        <!--begin::Radio group-->
                                        <div class="nav-group nav-group-fluid mt-1">
                                            <!--begin::Option-->
                                            <label>
                                                <button type="submit" id="but_search" class="btn btn-primary me-5">Get payout</button>
                                            </label>
                                        </div>
                                        <!--end::Radio group-->
                                    </div>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                {{-- </form> --}}
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1" style="font-size: 12px">Pendings payouts</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-dark table-striped align-middle gs-0 gy-4" id='empTable' >
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        {{-- <th class="ps-4 min-w-40px">#</th> --}}
                                        <th class="ps-4 min-w-100px text-left">Created at</th>
                                        <th class="min-w-60px text-left">Paydrc Reference</th>
                                        <th class="ps-4 min-w-100px text-left">Thirdparty</th>
                                        <th class="min-w-30px text-left">Amount</th>
                                        <th class="min-w-30px text-left">Currency</th>
                                        {{-- <th class="min-w-30px text-left">Customer</th> --}}
                                        {{-- <th class="min-w-60px text-left">Paydrc Reference</th> --}}
                                        <th class="ps-4 min-w-80px text-left">Status</th>
                                        <th class="ps-4 min-w-80px text-left">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table_content">
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
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>


<script type='text/javascript'>

    $(function() {
        $("#start_date").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"),12)
            }
        );
        $("#end_date").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"),12)
            }
        );
    });

   
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){

        load_data();
            function load_data(dateStart = '', dateEnd = ''){
                $('#empTable').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: {
                        url:'pending-payout',
                        data:{dateStart:dateStart, dateEnd:dateEnd}
                    },

                    columns: [
                        // {class : "text-center", data: 'id', name: 'id'},
                        {class : "text-left ps-4",data: 'created_at', name: 'created_at'},
                        {data: 'paydrc_reference', name: 'paydrc_reference'},
                        {data: 'merchant_reference', name: 'merchant_reference'},
                        {data: 'amount', name: 'amount'},
                        {data: 'currency', name: 'currency'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                        // {class : "text-left ps-4",data: 'created_at', name: 'created_at'},

                        
                    ]

                });
            }
            $('#but_search').click(function(){

                var dateStart=document.getElementById('start_date').value;
                var dateEnd=document.getElementById('end_date').value;

                if(dateStart != '' && dateEnd != ''){
                    $('#empTable').DataTable().destroy();
                    load_data(dateStart, dateEnd);
                } else{
                    alert('Both item is required');
                }
            });

            $('#refresh').click(function(){
                $('#start_date').val('');
                $("#channel").val('').trigger('change');
                $("#merchant_code").val('').trigger('change');
                // $('.action:checked').prop('checked', false);
                $('.currency:checked').prop('checked', false);
                $('#empTable').DataTable().destroy();
                load_data();
            });

 
    });


</script>

{{-- <script type="text/javascript">
    $(document).ajaxStart(function() {
        $('#loading').addClass('loading');
        $('#loading-content').addClass('loading-content');
    });
    $(document).ajaxStop(function() {
        $('#loading').removeClass('loading');
        $('#loading-content').removeClass('loading-content');
    });
</script> --}}

@endsection
@endsection
