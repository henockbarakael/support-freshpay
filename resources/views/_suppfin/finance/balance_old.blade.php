
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
                <form action="#" id="postForm">
                    @csrf
                    <!--begin::Card-->
                    <div class="card mb-7">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="col-md-8 me-md-2">
                                    <select id="merchant_code" name="merchant_code" class="form-select form-select-solid fw-bolder @error('merchant_code') is-invalid @enderror" data-kt-select2="true" data-placeholder="Select option">
                                        <option selected disabled>Select an institution...</option>
                                        @foreach ($result as $value)
                                            <option value="{{ $value["merchant_code"] }}">{{ $value["institution_name"] }}</option>
                                        @endforeach
                                    </select>
                                    @error('merchant_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-sm-4">
                                    <div class="nav-group nav-group-fluid mt-1">
                                        <label>
                                            <button type="submit" id="search" class="btn btn-primary me-5">Get balance</button>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
                                        <th class="ps-4 min-w-100px text-left">Vodacom USD</th>
                                        <th class="min-w-60px text-left">Vodacom CDF</th>
                                        <th class="min-w-60px text-left">Airtel USD</th>
                                        <th class="min-w-60px text-left">Airtel CDF</th>
                                        <th class="min-w-60px text-left">Orange USD</th>
                                        <th class="min-w-60px text-left">Orange CDF</th>
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

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $("#postForm").submit(function(e){
        e.preventDefault();
        var merchant_code = document.getElementById('merchant_code');
        var merchant = merchant_code[merchant_code.selectedIndex].value;
        $.ajax({
            url: 'merchant-balance',
                type: 'POST',
                data: {
                      _token: CSRF_TOKEN, 
                      merchant_code: merchant,
                  },
                dataType: 'json',
            success: function (responseOutput) {
                if (responseOutput['success']==true) {
                    var responseInfo = responseOutput.data;
                    var bodyData = '';
                  
                        bodyData+=
                        bodyData+='<tr>'+
                            '<td class="ps-4 text-left">'+responseInfo.vodacom_usd+'</td>'+
                        '<td class="text-left">'+responseInfo.vodacom_cdf+'</td>'+
                        '<td class="text-left">'+responseInfo.orange_usd+'</td>'+
                        '<td class="text-left">'+responseInfo.orange_cdf+'</td>'+
                        '<td class="text-left">'+responseInfo.airtel_usd+'</td>'+
                        '<td class="text-left">'+responseInfo.airtel_cdf+'</td>'+
                                  '</tr>';
                        
                     toastr.info('Balance found!', 'Success :)', {
                                timeOut: 600
                    });
                    $('tbody').html(bodyData);
                    // $("#postForm")[0].reset();
                }
                else{
                    // alert("Balance not found, please verify that you have chosen an institution."); 
                    toastr.error("Balance not found, please verify that you have chosen an institution.", "Error");
                    var bodyData = "<tr>" +
            "<td align='center' colspan='6'>No balance founded.</td>" +
          "</tr>";
 
          $("tbody").html(bodyData);
                    $("#postForm")[0].reset();
                }
              
                    
        
            }
        });
    });

 
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

@endsection
@endsection
