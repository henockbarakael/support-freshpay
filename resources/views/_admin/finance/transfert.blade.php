
@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Transfer </title>
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
@section('page-title','Transfer')
@section('subtitle','Initiate Transfer')
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
                                                Merchant
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="merchant_code" name="merchant_code" class="form-select form-select-solid fw-bolder @error('merchant_code') is-invalid @enderror" data-kt-select2="true" data-placeholder="Select option">
                                            <option selected disabled>Select an institution...</option>
                                            <?php
                                                foreach($result as $key => $value){
                                                    $nums = explode(',', $value["merchant_code"]);
                                                    $nombre = count($nums);
                                                    // echo $nombre;
                                                    if ($nombre < 1) {
                                                        echo  '<option value="{{ $value["merchant_code"] }}">'.$value["institution_name"].'</option>';
                                                    }
                                                    else {
                                                        echo  '<option value="{{ $value["merchant_code"] }}">'.$value["institution_name"]. " [". $value["merchant_code"]." ]" .'</option>';
                                                    }
                                                }  
                                            ?>
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
                                        <option selected disabled>Select a channel...</option>
                                        <option value="Wallet To Wallet">Wallet To Wallet</option>
                                        <option value="Wallet To Bank">Wallet To Bank</option>
                                        <option value="Bank To Wallet">Bank To Wallet</option>
                                    </select>
                                    @error('channel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="default">
                                <div class="d-flex align-items-center">
                                    <div class="col-sm-4 me-1">
                                        <div class="nav-group nav-group-fluid mt-1">
                                            <label class="form-control fw-bolder">
                                                Vendor
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="vendor" name="vendor" class="form-select form-select-solid fw-bolder @error('vendor') is-invalid @enderror" data-kt-select2="true" data-placeholder="Select option">
                                            <option selected disabled>Select a vendor...</option>
                                            <option value="airtel">Airtel</option>
                                            <option value="orange">Orange</option>
                                            <option value="vodacom">Vodacom</option>
                                        </select>
                                        @error('vendor')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="change" style="display: none;">
                                <div class="d-flex align-items-center">
                                    <div class="col-sm-4 me-1">
                                        <div class="nav-group nav-group-fluid mt-1">
                                            <label class="form-control fw-bolder">
                                                Vendor From
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="vendor_from" name="vendor_from" class="form-select form-select-solid fw-bolder @error('vendor_from') is-invalid @enderror" data-kt-select2="true" data-placeholder="Select option">
                                            <option selected disabled>Select a vendor...</option>
                                            <option value="airtel">Airtel</option>
                                            <option value="orange">Orange</option>
                                            <option value="vodacom">Vodacom</option>
                                        </select>
                                        @error('vendor_from')
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
                                                Vendor To
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="vendor_to" name="vendor_to" class="form-select form-select-solid fw-bolder @error('vendor_to') is-invalid @enderror" data-kt-select2="true" data-placeholder="Select option">
                                            <option selected disabled>Select a vendor...</option>
                                            <option value="airtel">Airtel</option>
                                            <option value="orange">Orange</option>
                                            <option value="vodacom">Vodacom</option>
                                        </select>
                                        @error('vendor_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="col-sm-4 me-1">
                                    <div class="nav-group nav-group-fluid mt-1">
                                        <label class="form-control fw-bolder">
                                            Currency
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <select id="currency" name="currency" class="form-select form-select-solid fw-bolder @error('currency') is-invalid @enderror" data-kt-select2="true" data-placeholder="Select option">
                                        <option selected disabled>Select a currency...</option>
                                        <option value="CDF">CDF</option>
                                        <option value="USD">USD</option>
                                    </select>
                                    @error('currency')
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
                                            Amount
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input class="form-control form-control-solid" type="text" placeholder="" id="amount" name="amount" />
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <div class="col-md-4 pb-10 pb-lg-0">
                                    <button type="button" name="top-up" id="top-up" class="btn btn-primary me-5">Make Transfer</button>
                                    <button type="button" name="refresh" id="refresh" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <!--begin::Table-->
                                <table class="table table-dark table-striped align-middle gs-0 gy-4" id='empTable' >
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th class="ps-4 min-w-100px text-left">Institution</th>
                                            <th class="min-w-100px text-left">wallet_code</th>
                                            <th class="min-w-60px text-left">Vendor</th>
                                            <th class="min-w-60px text-left">Added</th>
                                            <th class="min-w-60px text-left">Total</th>
                                            <th class="min-w-60px text-left">Currency</th>
                                            <th class="min-w-100px text-left">Updated At</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table_content">
                                        {{-- @foreach ($result as $key => $value)
                                        <tr>
                                            <td class="text-left ps-4">
                                                <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["institution_name"]. " [". $value["merchant_code"]." ]"}}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["wallet_code"]}}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["vendor"]}}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["amount"]}}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["currency"]}}</span>
                                            </td>
                                        </tr>
                                        @endforeach --}}
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
<script type='text/javascript'>
   
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        // initTable();
       // Fetch all records
       $('#refresh').click(function(){
            $("#currency").val('').trigger('change');
            $("#vendor_from").val('').trigger('change');
            $("#vendor_to").val('').trigger('change');
            $("#merchant_code").val('').trigger('change');
            $("#channel").val('').trigger('change');
            $('#amount').val('');
            $('#empTable').DataTable().destroy();
            var tr_str = "<tr>" +
            "<td align='center' colspan='7'>No record found.</td>" +
          "</tr>";
 
          $("#empTable tbody").append(tr_str);
        });
       $('#but_fetchall').click(function(){
 
          // AJAX GET request
          $.ajax({
            url: "initiate-transfer",
            type: 'get',
            dataType: 'json',
            success: function(response){
 
               createRows(response);
 
            }
          });
       });
  
       // Search by date
       $('#top-up').click(function(){
            var amount=document.getElementById('amount').value;
            var operator = document.getElementById('vendor');
                var vendor = operator[operator.selectedIndex].value;
                var operator2 = document.getElementById('vendor_to');
                var vendorTo = operator2[operator2.selectedIndex].value;
                var operator3 = document.getElementById('vendor_from');
                var vendorFrom = operator3[operator3.selectedIndex].value;
                var institution = document.getElementById('merchant_code');
                var merchant_code = institution[institution.selectedIndex].value;
                var devise = document.getElementById('currency');
                var currency = devise[devise.selectedIndex].value;
                var source = document.getElementById('channel');
                var channel = source[source.selectedIndex].value;
         
            $.ajax({
                url: 'initiate-transfer',
                type: 'POST',
                data: {
                      _token: CSRF_TOKEN, 
                      merchant_code: merchant_code,
                      channel: channel,
                      vendorFrom: vendorFrom,
                      vendorTo: vendorTo,
                      vendor: vendor,
                      amount: amount,
                      currency: currency,
                  },
                dataType: 'json',
                success: function(response){
                    if(response.success == false) {
                        // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: response.message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                    else if(response.success == true) {
                        // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: response.message,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        })
                    }
 
                   createRows(response);
 
                }
           });
       });
 
    });
 
    
    // Create table rows
    
    function createRows(response){
        
       var len = 0;
       var url = "top-up-wallet";
       
       $('#empTable tbody').empty(); // Empty <tbody>
        
       if(response['data'] != null){
          len = response['data'].length;
       }
       
       if(len > 0){
        
         for(var i=0; i<len; i++){

            var institution_name = response['data'][i].institution_name;
            var wallet_code = response['data'][i].wallet_code;
            var vendor = response['data'][i].vendor;
            var amount = response['data'][i].amount;
            var currency = response['data'][i].currency;
            var fund = response['data'][i].fund;
            var updated_at = response['data'][i].updated_at;
 
            var tr_str = "<tr>" +
              '<td class="ps-4 text-left">'+institution_name+'</td>'+
              '<td class="text-left">'+wallet_code+'</td>'+
              '<td class="ps-4 text-left">'+vendor+'</td>'+
              '<td class="ps-4 text-left">'+fund+'</td>'+
              '<td class="text-left">'+amount+'</td>'+
              '<td class="text-left">'+currency+'</td>'+
              '<td class="text-left">'+updated_at+'</td>'+
            "</tr>";
            
            $("#empTable tbody").append(tr_str);
         }
       }else{
          var tr_str = "<tr>" +
            "<td align='center' colspan='6'>No record found.</td>" +
          "</tr>";
 
          $("#empTable tbody").append(tr_str);
       }

    } 

</script>
<script>
    $(function() {
    $('#change').hide(); 
    $('#channel').change(function(){
        if($('#channel').val() == 'Wallet To Wallet') {
            $('#change').show(); 
            $('#default').hide(); 
        } else {
            $('#change').hide(); 
            $('#default').show(); 
        } 
    });
});
    $(document).ready(function(){
        $('#empTable').dataTable({
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
