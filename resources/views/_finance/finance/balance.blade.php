
@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Merchant Account Statement </title>
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
@section('page-title','Merchant Account')
@section('subtitle','Account Statement')
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
                            <div class="d-flex align-items-center">
                                <div class="col-sm-4 me-1">
                                    <div class="nav-group nav-group-fluid mt-1">
                                        <label class="form-control fw-bolder">
                                            Institution
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <select id="merchant_code" name="merchant_code" class="form-select form-select-solid fw-bolder @error('merchant_code') is-invalid @enderror" data-kt-select2="true" data-placeholder="Select option">
                                        <option selected disabled>Select an institution...</option>
                                        @foreach ($result as $value)
                                            <option value="{{ $value["merchant_code"] }}">{{ $value["institution_name"]. " [". $value["merchant_code"]." ]" }}</option>
                                        @endforeach
                                    </select>
                                    @error('merchant_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="col-sm-4 me-1">
                                    <div class="nav-group nav-group-fluid mt-1">
                                        <label class="form-control fw-bolder">
                                            Channel
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <select id="channel" name="channel" class="form-select form-select-solid fw-bolder @error('channel') is-invalid @enderror" data-kt-select2="true" data-placeholder="Select option">
                                        <option selected disabled>Select a channel</option>
                                        <option value="airtel">Airtel</option>
                                        <option value="orange">Orange</option>
                                        <option value="mpesa">Vodacom</option>
                                        {{-- <option value="africell">Africell</option> --}}
                                    </select>
                                    @error('channel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="col-sm-4 me-1">
                                    <div class="nav-group nav-group-fluid mt-1">
                                        <label class="form-control fw-bolder">
                                            Date
                                        </label>
                                    </div>
                                </div>
                                <!--begin::Col-->
                                <div class="col-md-8">
                                    <input type="text" readonly id="start_date" placeholder="Pick a date" class="form-control form-control-solid"/>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                {{-- <div class="col-md-4">
                                    <input type="text" readonly id="end_date" placeholder="To Date" class="form-control form-control-solid"/>
                                </div> --}}
    
                                
                            </div>
                            {{-- <div class="d-flex align-items-center">
                                <div class="col-sm-4 me-1">
                                    <div class="nav-group nav-group-fluid mt-1">
                                        <label class="form-control fw-bolder">
                                            Debit/Credit
                                        </label>
                                    </div>
                                </div>
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
                            </div> --}}
                            <div class="d-flex align-items-center">
                                <div class="col-sm-4 me-1">
                                    <div class="nav-group nav-group-fluid mt-1">
                                        <label class="form-control fw-bolder">
                                            Currency
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex my-3 ms-2">
                                    <label class="form-check form-check-custom form-check-solid me-5">
                                        CDF
                                    </label>
                                    <input class="form-check-input me-5 currency" type="radio" value="CDF" name="currency" />
                                    <label class="form-check form-check-custom form-check-solid me-5">
                                        USD
                                    </label>
                                    <input class="form-check-input currency" type="radio" value="USD" name="currency" />
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <div class="col-md-4 pb-10 pb-lg-0">
                                    <button type="button" name="filter" id="filter" class="btn btn-primary me-5">Search</button>
                                    <button type="button" name="refresh" id="refresh" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <!--begin::Table-->
                                <table class="table table-dark table-striped align-middle gs-0 gy-4" id='empTable' >
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th class="ps-4  min-w-60px text-left">Channel</th>
                                            <th class="min-w-100px text-left">Balance</th>
                                            <th class="min-w-60px text-left">Currency</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody class="table_content">
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                    </div>
                {{-- </form> --}}
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

</div>
<!--end::Container-->
</div>
@section('script')
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

<!-- Momentjs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<!-- Datatables -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<!-- Datepicker -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
</script>
<script>
    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });
</script>

<script>
    $(document).ready(function(){
        load_data();
            function load_data(merchant_code = '', channel = '',start_date = '', currency = ''){
                $('#empTable').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: {
                        url:'{{  route('finance.merchant.balance.create') }}',
                        data:{merchant_code:merchant_code, channel:channel, currency:currency, start_date:start_date}
                    },

                    columns: [
                        // {class : "text-center", data: 'id', name: 'id'},
                        {class : "text-left ps-4",data: 'channel', name: 'channel'},
                        {data: 'balance', name: 'balance'},
                        {data: 'currency', name: 'currency'},
                        
                    ]

                });
            }
            $('#filter').click(function(){

                var from_date = $('#start_date').val();
                var currency = $(".currency:checked").val();
                var operator = document.getElementById('channel');
                var channel = operator[operator.selectedIndex].value;
                var institution = document.getElementById('merchant_code');
                var merchant_code = institution[institution.selectedIndex].value;
                // var action = $(".action:checked").val();

                if(from_date != '' && merchant_code != '' &&  currency != '' && channel != ''){
                    $('#empTable').DataTable().destroy();
                    load_data(merchant_code, channel,  from_date,currency);
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
@endsection
@endsection
