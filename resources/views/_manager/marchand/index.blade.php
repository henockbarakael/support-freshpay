@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Liste des Marchands</title>
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
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
    <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <!--Begin::Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');</script>
		<!--End::Google Tag Manager -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style type="text/css">
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
            top: 40%;
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
@section('page-title','Marchands')
@section('subtitle','Liste des marchands')
{!! Toastr::message() !!}
@include('sweetalert::alert')
<div class="post d-flex flex-column-fluid ici" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Card-->
        <section id="loading">
            <div id="loading-content"></div>
        </section>
            <div class="card mb-7">
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search for merchant">
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--begin::Add user-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_merchant">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Add Merchant</button>
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
                            <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                        <!--begin::Modal - Add task-->
                        <div class="modal fade" id="kt_modal_add_merchant" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header" id="kt_modal_add_merchant_header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bold">New Merchant</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                            <span class="svg-icon svg-icon-1">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
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
                                        <form id="kt_modal_add_merchant_form" class="form" action="#">
                                            <!--begin::Scroll-->
                                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_merchant_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_merchant_header" data-kt-scroll-wrappers="#kt_modal_add_merchant_scroll" data-kt-scroll-offset="300px">
                                                <div class="fv-row mb-7">
                                                    <select name="institution" id="institution" class="form-select  form-select-solid">
                                                        <option selected="" disabled="" value="">Select an institution...</option>
                                                        @foreach ($result_2 as $value)
                                                            <option value="{{ $value["institution_code"] }}">{{ $value["institution_name"] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Vodacom number</label>
                                                    <input type="tel" name="vodacom_number" class="form-control form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Airtel number</label>
                                                    <input type="tel" name="airtel_number" class="form-control form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Orange number</label>
                                                    <input type="tel" name="orange_number" class="form-control form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                                </div>
                                                {{-- Commission --}}
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Vodacom debit comission(%)</label>
                                                    <input type="number" name="vodacom_debit_comission" class="form-control form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Vodacom credit comission(%)</label>
                                                    <input type="number" name="vodacom_credit_comission" class="form-control form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Airtel debit comission(%)</label>
                                                    <input type="number" name="airtel_debit_comission" class="form-control form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Airtel credit comission(%)</label>
                                                    <input type="number" name="airtel_credit_comission" class="form-control form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Orange debit comission(%)</label>
                                                    <input type="number" name="orange_debit_comission" class="form-control form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">Orange credit comission(%)</label>
                                                    <input type="number" name="orange_credit_comission" class="form-control form-control-solid mb-3 mb-lg-0" autocomplete="off">
                                                </div>
                                            </div>
                                            <!--end::Scroll-->
                                            <!--begin::Actions-->
                                            <div class="text-center pt-15">
                                                <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                                                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait... 
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                            </div>
                            <!--end::Modal dialog-->
                        </div>
                        <!--end::Modal - Add task-->
                    </div>
                    <!--end::Card toolbar-->
                </div>

                <div class="card-body py-4">
                    <table class="table table-dark table-striped align-middle fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="fw-bolder text-muted fs-7 text-uppercase gs-0">
                                <th class="min-w-50px text-center">#</th>
                                <th class="min-w-180px">Institution Name</th>
                                <th class="min-w-180px">Institution Code</th>
                                <th class="min-w-180px">Merchant Code</th>
                                <th class="min-w-180px">Merchant ID</th>
                                <th class="min-w-100px">Created At</th>
                                {{-- <th class="min-w-100px">Created At</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $key => $value)
                            <tr>
                                <td class="text-center">
                                    <span class="text-dark fw-semibold text-muted d-block fs-7">{{++$key}}</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["institution_name"]}}</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["institution_code"]}}</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["merchant_code"]}}</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["merchant_id"]}}</span>
                                </td>
                                <td>
                                    <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["created_at"]}}</span>
                                </td>
                                {{-- <td>
                                    <span class="text-dark fw-semibold text-muted d-block fs-7">{{$value["created_at"]}}</span>
                                </td> --}}
    
                            </tr>
                            @endforeach
                        </tbody>
    
                    </table>
                    <!--end::Table-->
                </div>
            </div>
    </div>
    <!--end::Container-->
</div>
@section('script')
<script>var hostUrl = "assets/";</script>
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('assets/js/custom/apps/marchand/list/table.js')}}"></script>
{{-- <script src="{{ asset('assets/js/custom/apps/marchand/list/export-users.js')}}"></script> --}}
<script src="{{ asset('assets/js/custom/apps/marchand/list/add.js')}}"></script>
<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js')}}"></script>
{{-- <script src="{{ asset('assets/js/custom/modals/create-app.js')}}"></script>
<script src="{{ asset('assets/js/custom/modals/upgrade-plan.js')}}"></script> --}}
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
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