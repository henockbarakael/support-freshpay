
@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Merchant Wallet </title>
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
@section('page-title','Merchant Wallet')
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
                                    <select id="vendor" name="vendor" class="form-select form-select-solid fw-bolder @error('vendor') is-invalid @enderror" data-kt-select2="true" data-placeholder="Select option">
                                        <option selected disabled>Select a vendor</option>
                                        <option value="airtel">Airtel</option>
                                        <option value="orange">Orange</option>
                                        <option value="mpesa">Vodacom</option>
                                    </select>
                                    @error('vendor')
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
                            </div>
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
                                            <th class="ps-4  min-w-180px text-left">Institution</th>
                                            <th class="min-w-60px text-left">Wallet</th>
                                            <th class="min-w-60px text-left">Amount</th>
                                            <th class="min-w-60px text-left">Currency</th>
                                            <th class="min-w-60px text-left">Method</th>
                                            <th class="min-w-60px text-left">Vendor</th>
                                            <th class="min-w-60px text-left">Action</th>
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

<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder">Update amount</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" class="form" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <label class="required fw-bold fs-6 mb-2">Amount</label>
                            <input type="text" id="e_amount" name="e_amount" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="" value="" />
                            <input type="hidden" name="e_currency" id="e_currency" value="">
                            <input type="hidden" name="e_wallet_code" id="e_wallet_code" value="">
                            <input type="hidden" name="e_wallet_type" id="e_wallet_type" value="">
                            <input type="hidden" name="e_vendor" id="e_vendor" value="">
                            <input type="hidden" name="e_action" id="e_action" value="">
                            <input type="hidden" name="e_institution_name" id="e_institution_name" value="">
                        </div>
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add task-->
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>
<script src="{{ asset('assets/js/custom/modals/create-app.js')}}"></script>
<script src="{{ asset('assets/js/custom/modals/upgrade-plan.js')}}"></script>
<script src="{{ asset('assets/js/custom/apps/wallet/update/table.js')}}"></script>
{{-- <script src="{{ asset('assets/js/custom/apps/wallet/update/export-users.js')}}"></script> --}}
<script src="{{ asset('assets/js/custom/apps/wallet/update/add.js')}}"></script>
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
            function load_data(merchant_code = '', vendor = '', action = '', currency = ''){
                $('#empTable').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: {
                        url:'{{  route('admin.merchant.wallet') }}',
                        data:{merchant_code:merchant_code, vendor:vendor, action:action, currency:currency}
                    },

                    columns: [
                        {class:"institution_name text-left ps-4", data: 'institution_name', name: 'institution_name'},
                        {class:"wallet_code", data: 'wallet_code', name: 'wallet_code'},
                        {class:"amount", data: 'amount', name: 'amount'},
                        {class:"currency", data: 'currency', name: 'currency'},
                        {class:"wallet_type", data: 'wallet_type', name: 'wallet_type'},
                        {class:"vendor", data: 'vendor', name: 'vendor'},
                        {class:"action", data: 'action', name: 'action', orderable: false, searchable: false},
                    ]

                });
            }

            // Update record
            $('#empTable').on('click','.updateAmount',function(){
                    var _this = $(this).parents('tr');
                    $('#e_amount').val(_this.find('.amount').text());
                    $('#e_wallet_code').val(_this.find('.wallet_code').text());
                    $('#e_institution_name').val(_this.find('.institution_name').text());
                    $('#e_currency').val(_this.find('.currency').text());
                    $('#e_wallet_type').val(_this.find('.wallet_type').text());
                    $('#e_vendor').val(_this.find('.vendor').text());
                    $('#e_action').val(_this.find('.action').text());
            });
            


            $('#filter').click(function(){

                var currency = $(".currency:checked").val();
                var operator = document.getElementById('vendor');
                var vendor = operator[operator.selectedIndex].value;
                var institution = document.getElementById('merchant_code');
                var merchant_code = institution[institution.selectedIndex].value;
                var action = $(".action:checked").val();

                if(merchant_code != '' &&  currency != '' && vendor != '' && action != ''){
                    $('#empTable').DataTable().destroy();
                    load_data(merchant_code, vendor, action, currency);
                } else{
                    alert('Both item is required');
                }
            });

            $('#refresh').click(function(){
                $("#vendor").val('').trigger('change');
                $("#merchant_code").val('').trigger('change');
                $('.action:checked').prop('checked', false);
                $('.currency:checked').prop('checked', false);
                $('#empTable').DataTable().destroy();
                load_data();
            });
    });
</script>
@endsection
@endsection
