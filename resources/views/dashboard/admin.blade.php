@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Bienvenue | FreshPay Bakery</title>
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
    <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head> 
@endpush
@section('content')
@section('page','Dashboard')
{!! Toastr::message() !!}
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                        <!--begin::Col-->
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #2196f3;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">All Charge</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6"><a href=""  class="text-white">Details<i class="fa fa-info-circle" style="color: white; margin-left: 5px"></i></a></span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>{{$charge_success}} Successful</span>
                                {{-- <span>{{$percent_success}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$charge_failed}} Failed</span>
                                {{-- <span>{{$percent_failed}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$charge_pending}} Pending</span>
                                {{-- <span>{{$percent_pending}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$charge_submitted}} Submitted</span>
                                {{-- <span>{{$percent_submitted}}%</span> --}}
                            </div>
                            
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>
            <!--begin::Col-->
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #2196f3;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">All Payout</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6"><a href=""  class="text-white">Details<i class="fa fa-info-circle" style="color: white; margin-left: 5px"></i></a></span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>{{$payout_success}} Successful</span>
                                {{-- <span>{{$percent_success_payout}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$payout_failed}} Failed</span>
                                {{-- <span>{{$percent_failed_payout}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$payout_pending}} Pending</span>
                                {{-- <span>{{$percent_pending_payout}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$payout_submitted}} Submitted</span>
                                {{-- <span>{{$percent_submitted_payout}}%</span> --}}
                            </div>
                            
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>
            <!--begin::Col-->
            <!--begin::Col-->



            {{-- <div class="col-lg-6 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #DB1430;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">Airtel Charge</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6"><a href=""  class="text-white">Details<i class="fa fa-info-circle" style="color: white; margin-left: 5px"></i></a></span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>{{$debit_airtel_success}} Successful</span>
                                <span>{{$p_adebit_success}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_airtel_failed}} Failed</span>
                                <span>{{$p_adebit_failed}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_airtel_pending}} Pending</span>
                                <span>{{$p_adebit_pending}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_airtel_submitted}} Submitted</span>
                                <span>{{$p_adebit_submitted}}%</span>
                            </div>
                            
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>
            <!--begin::Col-->
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #DB1430;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">Airtel Payout</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6"><a href=""  class="text-white">Details<i class="fa fa-info-circle" style="color: white; margin-left: 5px"></i></a></span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>{{$credit_airtel_success}} Successful</span>
                                <span>{{$p_acredit_success}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_airtel_failed}} Failed</span>
                                <span>{{$p_acredit_failed}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_airtel_pending}} Pending</span>
                                <span>{{$p_acredit_pending}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_airtel_submitted}} Submitted</span>
                                <span>{{$p_acredit_submitted}}%</span>
                            </div>
                            
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>
            <!--begin::Col-->
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #119e3e;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">Vodacom Charge</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6"><a href=""  class="text-white">Details<i class="fa fa-info-circle" style="color: white; margin-left: 5px"></i></a></span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>{{$debit_vodacom_success}} Successful</span>
                                <span>{{$p_vdebit_success}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_vodacom_failed}} Failed</span>
                                <span>{{$p_vdebit_failed}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_vodacom_pending}} Pending</span>
                                <span>{{$p_vdebit_pending}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_vodacom_submitted}} Submitted</span>
                                <span>{{$p_vdebit_submitted}}%</span>
                            </div>
                            
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>
            <!--begin::Col-->
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #119e3e;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">Vodacom Payout</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6"><a href=""  class="text-white">Details<i class="fa fa-info-circle" style="color: white; margin-left: 5px"></i></a></span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>{{$credit_vodacom_success}} Successful</span>
                                <span>{{$p_vcredit_success}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_vodacom_failed}} Failed</span>
                                <span>{{$p_vcredit_failed}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_vodacom_pending}} Pending</span>
                                <span>{{$p_vcredit_pending}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_vodacom_submitted}} Submitted</span>
                                <span>{{$p_vcredit_submitted}}%</span>
                            </div>
                            
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: rgb(255, 133, 27);background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">Orange Charge</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6"><a href=""  class="text-white">Details<i class="fa fa-info-circle" style="color: white; margin-left: 5px"></i></a></span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>{{$debit_orange_success}} Successful</span>
                                <span>{{$p_odebit_success}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_orange_failed}} Failed</span>
                                <span>{{$p_odebit_failed}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_orange_pending}} Pending</span>
                                <span>{{$p_odebit_pending}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_orange_submitted}} Submitted</span>
                                <span>{{$p_odebit_submitted}}%</span>
                            </div>
                            
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>
            <!--begin::Col-->
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: rgb(255, 133, 27);background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <!--begin::Amount-->
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">Orange Payout</span>
                            <!--end::Amount-->
                            <!--begin::Subtitle-->
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6"><a href=""  class="text-white">Details<i class="fa fa-info-circle" style="color: white; margin-left: 5px"></i></a></span>
                            <!--end::Subtitle-->
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>{{$credit_orange_success}} Successful</span>
                                <span>{{$p_ocredit_success}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_orange_failed}} Failed</span>
                                <span>{{$p_ocredit_failed}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_orange_pending}} Pending</span>
                                <span>{{$p_ocredit_pending}}%</span>
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_airtel_submitted}} Submitted</span>
                                <span>{{$p_ocredit_submitted}}%</span>
                            </div>
                            
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div> --}}
        </div>

        <div class="row g-5 g-xl-8">
            <div class="col-xl-6">
                <!--begin::Charts Widget 1-->
                <div class="card card-xl-stretch mb-xl-8 myshadow">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Debit Transaction</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="kt_charts_widget_1_chart" style="height: 350px"></div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Charts Widget 1-->
            </div>
            {{-- <div class="col-xl-6">
                <!--begin::Charts Widget 1-->
                <div class="card card-xl-stretch mb-xl-8 myshadow">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Credit Transaction</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="kt_charts_widget_2_chart" style="height: 350px"></div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Charts Widget 1-->
            </div> --}}
        </div>

 
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
@section('script')
<script>var hostUrl = "assets/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
{{-- <script type="text/javascript">
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "../demo1/src/js/custom/widgets.js":
/*!*****************************************!*\
  !*** ../demo1/src/js/custom/widgets.js ***!
  \*****************************************/
/***/ ((module) => {



// Class definition
var KTWidgets = function () {
    // Statistics widgets
    var initStatisticsWidget3 = function() {
        var charts = document.querySelectorAll('.statistics-widget-3-chart');

        [].slice.call(charts).map(function(element) {
            var height = parseInt(KTUtil.css(element, 'height'));

            if ( !element ) {
                return;
            }

            var color = element.getAttribute('data-kt-chart-color');

            var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
            var baseColor = KTUtil.getCssVariableValue('--bs-' + color);
            var lightColor = KTUtil.getCssVariableValue('--bs-light-' + color );

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [30, 45, 32, 70, 40]
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 0.3
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [baseColor]
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: '#E4E6EF',
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 80,
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function(val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: [baseColor],
                markers: {
                    colors: [baseColor],
                    strokeColor: [lightColor],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });        
    }

    var initStatisticsWidget4 = function() {
        var charts = document.querySelectorAll('.statistics-widget-4-chart');

        [].slice.call(charts).map(function(element) {
            var height = parseInt(KTUtil.css(element, 'height'));

            if ( !element ) {
                return;
            }

            var color = element.getAttribute('data-kt-chart-color');

            var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
            var baseColor = KTUtil.getCssVariableValue('--bs-' + color);
            var lightColor = KTUtil.getCssVariableValue('--bs-light-' + color );

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [40, 40, 30, 30, 35, 35, 50]
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 0.3
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [baseColor]
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: '#E4E6EF',
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 60,
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function(val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: [baseColor],
                markers: {
                    colors: [baseColor],
                    strokeColor: [lightColor],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });        
    }

    // Charts widgets
    var initChartsWidget1 = function() {
        var element = document.getElementById("kt_charts_widget_1_chart");

        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var successColor = '#28a745'
        var failedColor = '#dc3545';
        var pendingColor = '#ffc107';
        var submittedColor = '#2196f3';

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Successful',
                data: [{!! $debit_orange_success !!},{!! $debit_airtel_success !!},{!! $debit_vodacom_success !!}]
            }, {
                name: 'Failed',
                data: [{!! $debit_orange_failed !!},{!! $debit_airtel_failed !!},{!! $debit_vodacom_failed !!}]
            }, {
                name: 'Pending',
                data: [{!! $debit_orange_pending !!},{!! $debit_airtel_pending !!},{!! $debit_vodacom_pending !!}]
            }
            , {
                name: 'Submitted',
                data: [{!! $debit_orange_submitted !!},{!! $debit_airtel_submitted !!},{!! $debit_vodacom_submitted !!}]
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'bar',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['30%'],
                    borderRadius: 4
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Orange','Airtel','Vodacom'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return val 
                    }
                }
            },
            colors: [successColor, failedColor, pendingColor, submittedColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();      
    }

    var initChartsWidget2 = function() {
        var element = document.getElementById("kt_charts_widget_2_chart");

        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var successColor = '#28a745'
        var failedColor = '#dc3545';
        var pendingColor = '#ffc107';
        var submittedColor = '#2196f3';

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Successful',
                data: [{!! $credit_orange_success !!},{!! $credit_airtel_success !!},{!! $credit_vodacom_success !!}]
            }, {
                name: 'Failed',
                data: [{!! $credit_orange_failed !!},{!! $credit_airtel_failed !!},{!! $credit_vodacom_failed !!}]
            }, {
                name: 'Pending',
                data: [{!! $credit_orange_pending !!},{!! $credit_airtel_pending !!},{!! $credit_vodacom_pending !!}]
            }
            , {
                name: 'Submitted',
                data: [{!! $credit_orange_submitted !!},{!! $credit_airtel_submitted !!},{!! $credit_vodacom_submitted !!}]
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'bar',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['30%'],
                    borderRadius: 4
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Orange','Airtel','Vodacom'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return val 
                    }
                }
            },
            colors: [successColor, failedColor, pendingColor, submittedColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();      
    }

    var initChartsWidget3 = function() {
        var element = document.getElementById("kt_charts_widget_3_chart");

        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var baseColor = KTUtil.getCssVariableValue('--bs-info');
        var lightColor = KTUtil.getCssVariableValue('--bs-light-info');

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Net Profit',
                data: [30, 40, 40, 90, 90, 70, 70]
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {

            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [baseColor]
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    position: 'front',
                    stroke: {
                        color: baseColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [lightColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                strokeColor: baseColor,
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();   
    }

    var initChartsWidget4 = function() {
        var element = document.getElementById("kt_charts_widget_4_chart");

        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');

        var baseColor = KTUtil.getCssVariableValue('--bs-success');
        var baseLightColor = KTUtil.getCssVariableValue('--bs-light-success');
        var secondaryColor = KTUtil.getCssVariableValue('--bs-warning');
        var secondaryLightColor = KTUtil.getCssVariableValue('--bs-light-warning');

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Net Profit',
                data: [60, 50, 80, 40, 100, 60]
            }, {
                name: 'Revenue',
                data: [70, 60, 110, 40, 50, 70]
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    position: 'front',
                    stroke: {
                        color: labelColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [baseColor, secondaryColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                colors: [baseLightColor, secondaryLightColor],
                strokeColor: [baseLightColor, secondaryLightColor],
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();   
    }

    var initChartsWidget5 = function() {
        var element = document.getElementById("kt_charts_widget_5_chart");

        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');

        var baseColor = KTUtil.getCssVariableValue('--bs-primary');
        var secondaryColor = KTUtil.getCssVariableValue('--bs-info');

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Net Profit',
                data: [40, 50, 65, 70, 50, 30]
            }, {
                name: 'Revenue',
                data: [-30, -40, -55, -60, -40, -20]
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'bar',
                stacked: true,
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['12%'],
                    borderRadius: 4
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                min: -80,
                max: 80,
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [baseColor, secondaryColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();   
    }

    var initChartsWidget6 = function() {
        var element = document.getElementById("kt_charts_widget_6_chart");

        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');

        var baseColor = KTUtil.getCssVariableValue('--bs-primary');
        var baseLightColor = KTUtil.getCssVariableValue('--bs-light-primary');
        var secondaryColor = KTUtil.getCssVariableValue('--bs-info');        

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Net Profit',
                type: 'bar',
                stacked: true,
                data: [40, 50, 65, 70, 50, 30]
            }, {
                name: 'Revenue',
                type: 'bar',
                stacked: true,
                data: [20, 20, 25, 30, 30, 20]
            }, {
                name: 'Expenses',
                type: 'area',
                data: [50, 80, 60, 90, 50, 70]
            }],
            chart: {
                fontFamily: 'inherit',
                stacked: true,
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    stacked: true,
                    horizontal: false,
                    borderRadius: 4,
                    columnWidth: ['12%']
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                max: 120,
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [baseColor, secondaryColor, baseLightColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();   
    }

    var initChartsWidget7 = function() {
        var element = document.getElementById("kt_charts_widget_7_chart");

        var height = parseInt(KTUtil.css(element, 'height'));

        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var strokeColor = KTUtil.getCssVariableValue('--bs-gray-300');

        var color1 = KTUtil.getCssVariableValue('--bs-warning');
        var color1Light = KTUtil.getCssVariableValue('--bs-light-warning');

        var color2 = KTUtil.getCssVariableValue('--bs-success');
        var color2Light = KTUtil.getCssVariableValue('--bs-light-success');

        var color3 = KTUtil.getCssVariableValue('--bs-primary');  
        var color3Light = KTUtil.getCssVariableValue('--bs-light-primary');  

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Net Profit',
                data: [30, 30, 50, 50, 35, 35]
            }, {
                name: 'Revenue',
                data: [55, 20, 20, 20, 70, 70]
            }, {
                name: 'Expenses',
                data: [60, 60, 40, 40, 30, 30]
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                sparkline: {
                    enabled: true
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 2,
                colors: [color1, 'transparent', 'transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false,
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    show: false,
                    position: 'front',
                    stroke: {
                        color: strokeColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false,
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [color1, color2, color3],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                colors: [color1Light, color2Light, color3Light],
                strokeColor: [color1, color2, color3],
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();   
    }

    var initChartsWidget8 = function() {
        var element = document.getElementById("kt_charts_widget_8_chart");

        var height = parseInt(KTUtil.css(element, 'height'));

        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var strokeColor = KTUtil.getCssVariableValue('--bs-gray-300');

        var color1 = KTUtil.getCssVariableValue('--bs-warning');
        var color1Light = KTUtil.getCssVariableValue('--bs-light-warning');

        var color2 = KTUtil.getCssVariableValue('--bs-success');
        var color2Light = KTUtil.getCssVariableValue('--bs-light-success');

        var color3 = KTUtil.getCssVariableValue('--bs-primary');  
        var color3Light = KTUtil.getCssVariableValue('--bs-light-primary');  

        if (!element) {
            return;
        }

        var options = {
            series: [{
                name: 'Net Profit',
                data: [30, 30, 50, 50, 35, 35]
            }, {
                name: 'Revenue',
                data: [55, 20, 20, 20, 70, 70]
            }, {
                name: 'Expenses',
                data: [60, 60, 40, 40, 30, 30]
            },],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                sparkline: {
                    enabled: true
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 2,
                colors: [color1, color2, color3]
            },
            xaxis: {
                x: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                },
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: false,
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    show: false,
                    position: 'front',
                    stroke: {
                        color: strokeColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: {
                    left: 0,
                    right: 0
                },
                labels: {
                    show: false,
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return "$" + val + " thousands"
                    }
                }
            },
            colors: [color1Light, color2Light, color3Light],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                padding: {
                    top: 0,
                    bottom: 0,
                    left: 0,
                    right: 0
                }
            },
            markers: {
                colors: [color1, color2, color3],
                strokeColor: [color1, color2, color3],
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();   
    }

    // Mixed widgets
    var initMixedWidget2 = function() {
        var charts = document.querySelectorAll('.mixed-widget-2-chart');

        var color;
        var strokeColor;
        var height;
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var options;
        var chart;

        [].slice.call(charts).map(function(element) {
            height = parseInt(KTUtil.css(element, 'height'));
            color = KTUtil.getCssVariableValue('--bs-' + element.getAttribute("data-kt-color"));
            strokeColor = KTUtil.colorDarken(color, 15);

            options = {
                series: [{
                    name: 'Net Profit',
                    data: [30, 45, 32, 70, 40, 40, 40]
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    },
                    dropShadow: {
                        enabled: true,
                        enabledOnSeries: undefined,
                        top: 5,
                        left: 0,
                        blur: 3,
                        color: strokeColor,
                        opacity: 0.5
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 0
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [strokeColor]
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: borderColor,
                            width: 1,
                            dashArray: 3
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 80,
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px',
                    },
                    y: {
                        formatter: function (val) {
                            return "$" + val + " thousands"
                        }
                    },
                    marker: {
                        show: false
                    }
                },
                colors: ['transparent'],
                markers: {
                    colors: [color],
                    strokeColor: [strokeColor],
                    strokeWidth: 3
                }
            };

            chart = new ApexCharts(element, options);
            chart.render();  
        });        
    }

    var initMixedWidget3 = function() {
        var charts = document.querySelectorAll('.mixed-widget-3-chart');

        [].slice.call(charts).map(function(element) {
            var height = parseInt(KTUtil.css(element, 'height'));

            if ( !element ) {
                return;
            }

            var color = element.getAttribute('data-kt-chart-color');

            var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
            var strokeColor = KTUtil.getCssVariableValue('--bs-' + 'gray-300');
            var baseColor = KTUtil.getCssVariableValue('--bs-' + color);
            var lightColor = KTUtil.getCssVariableValue('--bs-light-' + color );

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [30, 25, 45, 30, 55, 55]
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [baseColor]
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: strokeColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 60,
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: [lightColor],
                markers: {
                    colors: [lightColor],
                    strokeColor: [baseColor],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });        
    }

    var initMixedWidget4 = function() {
        var charts = document.querySelectorAll('.mixed-widget-4-chart');

        [].slice.call(charts).map(function(element) {
            var height = parseInt(KTUtil.css(element, 'height'));

            if ( !element ) {
                return;
            }

            var color = element.getAttribute('data-kt-chart-color');

            var baseColor = KTUtil.getCssVariableValue('--bs-' + color);
            var lightColor = KTUtil.getCssVariableValue('--bs-light-' + color );
            var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-700');

            var options = {
                series: [74],
                chart: {
                    fontFamily: 'inherit',
                    height: height,
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 0,
                            size: "65%"
                        },
                        dataLabels: {
                            showOn: "always",
                            name: {
                                show: false,
                                fontWeight: '700'
                            },
                            value: {
                                color: labelColor,
                                fontSize: "30px",
                                fontWeight: '700',
                                offsetY: 12,
                                show: true,
                                formatter: function (val) {
                                    return val + '%';
                                }
                            }
                        },
                        track: {
                            background: lightColor,
                            strokeWidth: '100%'
                        }
                    }
                },
                colors: [baseColor],
                stroke: {
                    lineCap: "round",
                },
                labels: ["Progress"]
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });        
    }

    var initMixedWidget5 = function() {
        var charts = document.querySelectorAll('.mixed-widget-5-chart');

        [].slice.call(charts).map(function(element) {
            var height = parseInt(KTUtil.css(element, 'height'));

            if ( !element ) {
                return;
            }

            var color = element.getAttribute('data-kt-chart-color');

            var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
            var strokeColor = KTUtil.getCssVariableValue('--bs-' + 'gray-300');
            var baseColor = KTUtil.getCssVariableValue('--bs-' + color);
            var lightColor = KTUtil.getCssVariableValue('--bs-light-' + color );

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [30, 30, 60, 25, 25, 40]
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                fill1: {
                    type: 'gradient',
                    opacity: 1,
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 0.5,
                        gradientToColors: undefined,
                        inverseColors: true,
                        opacityFrom: 1,
                        opacityTo: 0.375,
                        stops: [25, 50, 100],
                        colorStops: []
                    }
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [baseColor]
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: strokeColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 65,
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: [lightColor],
                markers: {
                    colors: [lightColor],
                    strokeColor: [baseColor],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });        
    }

    var initMixedWidget6 = function() {
        var charts = document.querySelectorAll('.mixed-widget-6-chart');

        [].slice.call(charts).map(function(element) {
            var height = parseInt(KTUtil.css(element, 'height'));

            if ( !element ) {
                return;
            }

            var color = element.getAttribute('data-kt-chart-color');

            var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
            var strokeColor = KTUtil.getCssVariableValue('--bs-' + 'gray-300');
            var baseColor = KTUtil.getCssVariableValue('--bs-' + color);
            var lightColor = KTUtil.getCssVariableValue('--bs-light-' + color );

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [30, 25, 45, 30, 55, 55]
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [baseColor]
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: strokeColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 60,
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: [lightColor],
                markers: {
                    colors: [lightColor],
                    strokeColor: [baseColor],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });        
    }

    var initMixedWidget7 = function() {
        var charts = document.querySelectorAll('.mixed-widget-7-chart');

        [].slice.call(charts).map(function(element) {
            var height = parseInt(KTUtil.css(element, 'height'));

            if ( !element ) {
                return;
            }

            var color = element.getAttribute('data-kt-chart-color');

            var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
            var strokeColor = KTUtil.getCssVariableValue('--bs-' + 'gray-300');
            var baseColor = KTUtil.getCssVariableValue('--bs-' + color);
            var lightColor = KTUtil.getCssVariableValue('--bs-light-' + color);

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [15, 25, 15, 40, 20, 50]
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [baseColor]
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: strokeColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 60,
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: [lightColor],
                markers: {
                    colors: [lightColor],
                    strokeColor: [baseColor],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });        
    }

    var initMixedWidget10 = function() {
        var charts = document.querySelectorAll('.mixed-widget-10-chart');

        var color;
        var height;
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var baseLightColor;
        var secondaryColor = KTUtil.getCssVariableValue('--bs-gray-300');
        var baseColor;
        var options;
        var chart;

        [].slice.call(charts).map(function(element) {
            color = element.getAttribute("data-kt-color");
            height = parseInt(KTUtil.css(element, 'height'));
            baseColor = KTUtil.getCssVariableValue('--bs-' + color);

            options = {
                series: [{
                    name: 'Net Profit',
                    data: [50, 60, 70, 80, 60, 50, 70, 60]
                }, {
                    name: 'Revenue',
                    data: [50, 60, 70, 80, 60, 50, 70, 60]
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: ['50%'],
                        borderRadius: 4
                    },
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    y: 0,
                    offsetX: 0,
                    offsetY: 0,
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    type: 'solid'
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "$" + val + " revenue"
                        }
                    }
                },
                colors: [baseColor, secondaryColor],
                grid: {
                    padding: {
                        top: 10
                    },
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                }
            };

            chart = new ApexCharts(element, options);
            chart.render();      
        });        
    }

    var initMixedWidget12 = function() {
        var charts = document.querySelectorAll('.mixed-widget-12-chart');

        var color;
        var strokeColor;
        var height;
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
        var options;
        var chart;

        [].slice.call(charts).map(function(element) {            
            height = parseInt(KTUtil.css(element, 'height'));

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [35, 65, 75, 55, 45, 60, 55]
                }, {
                    name: 'Revenue',
                    data: [40, 70, 80, 60, 50, 65, 60]
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: ['30%'],
                        borderRadius: 2
                    }
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 1,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 100,
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    type: ['solid', 'solid'],
                    opacity: [0.25, 1]
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "$" + val + " thousands"
                        }
                    },
                    marker: {
                        show: false
                    }
                },
                colors: ['#ffffff', '#ffffff'],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    },
                    padding: {
                        left: 20,
                        right: 20
                    }
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render()
        });        
    } 

    var initMixedWidget13 = function() {
        var height;
        var charts = document.querySelectorAll('.mixed-widget-13-chart');

        [].slice.call(charts).map(function(element) {
            height = parseInt(KTUtil.css(element, 'height'));

            if ( !element ) {
                return;
            }
                   
            var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');
            var strokeColor = KTUtil.getCssVariableValue('--bs-' + 'gray-300');

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [15, 25, 15, 40, 20, 50]
                }],
                grid: {
                    show: false,
                    padding: {
                        top: 0,
                        bottom: 0,
                        left: 0,
                        right: 0
                    }
                },
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'gradient',
                    gradient: {                        
                        opacityFrom: 0.4,
                        opacityTo: 0,
                        stops: [20, 120, 120, 120]
                    }
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: ['#FFFFFF']
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: strokeColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 60,
                    labels: {
                        show: false,
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return "$" + val + " thousands"
                        }
                    }
                },
                colors: ['#ffffff'],
                markers: {
                    colors: [labelColor],
                    strokeColor: [strokeColor],
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });        
    }

    var initMixedWidget14 = function() {   		
		var charts = document.querySelectorAll('.mixed-widget-14-chart');  
        var options;
        var chart;
        var height;

        [].slice.call(charts).map(function(element) {
            height = parseInt(KTUtil.css(element, 'height'));      
            var labelColor = KTUtil.getCssVariableValue('--bs-' + 'gray-800');      

            options = {
                series: [{
                    name: 'Inflation',
                    data: [1, 2.1, 1, 2.1, 4.1, 6.1, 4.1, 4.1, 2.1, 4.1, 2.1, 3.1, 1, 1, 2.1]
                }],
                chart: {
                    fontFamily: 'inherit',
                    height: height,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }                             
                },
                grid: {
                    show: false,
                    padding: {
                        top: 0,
                        bottom: 0,
                        left: 0,
                        right: 0
                    }
                },                
                colors: ['#ffffff'],         
                plotOptions: {
                    bar: {                    
                        borderRadius: 2.5,
                        dataLabels: {
                            position: 'top', // top, center, bottom
                        },
                        columnWidth: '20%'                             
                    }
                },            
                dataLabels: {
                    enabled: false,
                    formatter: function(val) {
                        return val + "%";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },          
                xaxis: {
                    labels: {
                        show: false,
                    },
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Jan", "Feb", "Mar"],
                    position: 'top',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    crosshairs: {
                        show: false
                    },
                    tooltip: {
                        enabled: false
                    }
                },
                yaxis: {
                    show: false,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                        background: labelColor
                    },
                    labels: {
                        show: false,
                        formatter: function(val) {
                            return val + "%";
                        }
                    }                
                }		
            };

            chart = new ApexCharts(element, options);
            chart.render(); 
        }); 
	}
    
    var initMixedWidget16 = function() {
        var element = document.getElementById("kt_charts_mixed_widget_16_chart");
        var height = parseInt(KTUtil.css(element, 'height'));

        if (!element) {
            return;
        }

        var options = {
            labels: ["Total Members"],
            series: [74],
            chart: {
                fontFamily: 'inherit',
                height: height,
                type: 'radialBar',
                offsetY: 0
            },
            plotOptions: {
                radialBar: {
                    startAngle: -90,
                    endAngle: 90,

                    hollow: {
                        margin: 0,
                        size: "70%"
                    },
                    dataLabels: {
                        showOn: "always",
                        name: {
                            show: true,
                            fontSize: "13px",
                            fontWeight: "700",
                            offsetY: -5,
                            color: KTUtil.getCssVariableValue('--bs-gray-500')
                        },
                        value: {
                            color: KTUtil.getCssVariableValue('--bs-gray-700'),
                            fontSize: "30px",
                            fontWeight: "700",
                            offsetY: -40,
                            show: true
                        }
                    },
                    track: {
                        background: KTUtil.getCssVariableValue('--bs-light-primary'),
                        strokeWidth: '100%'
                    }
                }
            },
            colors: [KTUtil.getCssVariableValue('--bs-primary')],
            stroke: {
                lineCap: "round",
            }            
        };

        var chart = new ApexCharts(element, options);
        chart.render();
    }

    // Feeds Widgets
    var initFeedWidget1 = function() {
        var formEl = document.querySelector("#kt_forms_widget_1_form");
        var editorId = 'kt_forms_widget_1_editor';

        if ( !formEl ) {
            return;
        }

        // init editor
        var options = {
            modules: {
                toolbar: {
                    container: "#kt_forms_widget_1_editor_toolbar"
                }
            },
            placeholder: 'What is on your mind ?',
            theme: 'snow'
        };

        if (!formEl) {
            return;
        }

        // Init editor
        var editorObj = new Quill('#' + editorId, options);
    }

    var initFeedsWidget4 = function() {
        var btn = document.querySelector('#kt_widget_5_load_more_btn');
        var widget5 = document.querySelector('#kt_widget_5');        

        if (btn) {
            btn.addEventListener('click', function(e){
                e.preventDefault();
                btn.setAttribute('data-kt-indicator', 'on');

                setTimeout(function() {
                    btn.removeAttribute('data-kt-indicator');
                    widget5.classList.remove('d-none');         
                    btn.classList.add('d-none');         
                    
                    KTUtil.scrollTo(widget5, 200);
                }, 2000);                
            });
        }                 
    }  

    // Follow button
    var initUserFollowButton = function() {
        var follow = document.querySelector('#kt_user_follow_button');

        if (follow) {
            follow.addEventListener('click', function(e){
                // Prevent default action 
                e.preventDefault();
                
                // Show indicator
                follow.setAttribute('data-kt-indicator', 'on');
                
                // Disable button to avoid multiple click 
				follow.disabled = true;

                // Check button state
                if (follow.classList.contains("btn-success")) {
                     setTimeout(function() {
                        follow.removeAttribute('data-kt-indicator');
                        follow.classList.remove("btn-success");
                        follow.classList.add("btn-light");
                        follow.querySelector(".svg-icon").classList.add("d-none");
                        follow.querySelector(".indicator-label").innerHTML = 'Follow';
				        follow.disabled = false;
                    }, 1500);   
                } else {
                     setTimeout(function() {
                        follow.removeAttribute('data-kt-indicator');
                        follow.classList.add("btn-success");
                        follow.classList.remove("btn-light");
                        follow.querySelector(".svg-icon").classList.remove("d-none");
                        follow.querySelector(".indicator-label").innerHTML = 'Following';
                        follow.disabled = false;
                    }, 1000);   
                }        
            });
        }                 
    }

    // Calendar
    var initCalendarWidget1 = function() {
        if (typeof FullCalendar === 'undefined' || !document.querySelector('#kt_calendar_widget_1')) {
            return;
        }

        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        var calendarEl = document.getElementById('kt_calendar_widget_1');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },

            height: 800,
            contentHeight: 780,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,
            now: TODAY + 'T09:25:00', // just for demo

            views: {
                dayGridMonth: { buttonText: 'month' },
                timeGridWeek: { buttonText: 'week' },
                timeGridDay: { buttonText: 'day' }
            },

            initialView: 'dayGridMonth',
            initialDate: TODAY,

            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            navLinks: true,
            events: [
                {
                    title: 'All Day Event',
                    start: YM + '-01',
                    description: 'Toto lorem ipsum dolor sit incid idunt ut',
                    className: "fc-event-danger fc-event-solid-warning"
                },
                {
                    title: 'Reporting',
                    start: YM + '-14T13:30:00',
                    description: 'Lorem ipsum dolor incid idunt ut labore',
                    end: YM + '-14',
                    className: "fc-event-success"
                },
                {
                    title: 'Company Trip',
                    start: YM + '-02',
                    description: 'Lorem ipsum dolor sit tempor incid',
                    end: YM + '-03',
                    className: "fc-event-primary"
                },
                {
                    title: 'ICT Expo 2017 - Product Release',
                    start: YM + '-03',
                    description: 'Lorem ipsum dolor sit tempor inci',
                    end: YM + '-05',
                    className: "fc-event-light fc-event-solid-primary"
                },
                {
                    title: 'Dinner',
                    start: YM + '-12',
                    description: 'Lorem ipsum dolor sit amet, conse ctetur',
                    end: YM + '-10'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: YM + '-09T16:00:00',
                    description: 'Lorem ipsum dolor sit ncididunt ut labore',
                    className: "fc-event-danger"
                },
                {
                    id: 1000,
                    title: 'Repeating Event',
                    description: 'Lorem ipsum dolor sit amet, labore',
                    start: YM + '-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: YESTERDAY,
                    end: TOMORROW,
                    description: 'Lorem ipsum dolor eius mod tempor labore',
                    className: "fc-event-primary"
                },
                {
                    title: 'Meeting',
                    start: TODAY + 'T10:30:00',
                    end: TODAY + 'T12:30:00',
                    description: 'Lorem ipsum dolor eiu idunt ut labore'
                },
                {
                    title: 'Lunch',
                    start: TODAY + 'T12:00:00',
                    className: "fc-event-info",
                    description: 'Lorem ipsum dolor sit amet, ut labore'
                },
                {
                    title: 'Meeting',
                    start: TODAY + 'T14:30:00',
                    className: "fc-event-warning",
                    description: 'Lorem ipsum conse ctetur adipi scing'
                },
                {
                    title: 'Happy Hour',
                    start: TODAY + 'T17:30:00',
                    className: "fc-event-info",
                    description: 'Lorem ipsum dolor sit amet, conse ctetur'
                },
                {
                    title: 'Dinner',
                    start: TOMORROW + 'T05:00:00',
                    className: "fc-event-solid-danger fc-event-light",
                    description: 'Lorem ipsum dolor sit ctetur adipi scing'
                },
                {
                    title: 'Birthday Party',
                    start: TOMORROW + 'T07:00:00',
                    className: "fc-event-primary",
                    description: 'Lorem ipsum dolor sit amet, scing'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: YM + '-28',
                    className: "fc-event-solid-info fc-event-light",
                    description: 'Lorem ipsum dolor sit amet, labore'
                }
            ]
        });

        calendar.render();
    }

    // Daterangepicker
    var initDaterangepicker = function () {
        if (!document.querySelector('#kt_dashboard_daterangepicker')) {
            return;
        }

        var picker = $('#kt_dashboard_daterangepicker');
        var start = moment();
        var end = moment();

        function cb(start, end, label) {
            var title = '';
            var range = '';

            if ((end - start) < 100 || label == 'Today') {
                title = 'Today:';
                range = start.format('MMM D');
            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('MMM D');
            } else {
                range = start.format('MMM D') + ' - ' + end.format('MMM D');
            }

            $('#kt_dashboard_daterangepicker_date').html(range);
            $('#kt_dashboard_daterangepicker_title').html(title);
        }

        picker.daterangepicker({
            direction: KTUtil.isRTL(),
            startDate: start,
            endDate: end,
            opens: 'left',
            applyClass: 'btn-primary',
            cancelClass: 'btn-light-primary',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
    }    

    // Dark mode toggler
    var initDarkModeToggle = function() {
        var toggle = document.querySelector('#kt_user_menu_dark_mode_toggle');
        
        if (toggle) {
            toggle.addEventListener('click', function() {
                window.location.href = this.getAttribute('data-kt-url');
            });
        }
    }

    // Public methods
    return {
        init: function () {
            // Daterangepicker
            initDaterangepicker();
            
            // Dark Mode
            initDarkModeToggle();

            // Statistics widgets
            initStatisticsWidget3();
            initStatisticsWidget4();            

            // Charts widgets
            initChartsWidget1();
            initChartsWidget2();
            initChartsWidget3();
            initChartsWidget4();
            initChartsWidget5();
            initChartsWidget6();
            initChartsWidget7();
            initChartsWidget8();

            // Mixed widgets
            initMixedWidget2();
            initMixedWidget3();
            initMixedWidget4();
            initMixedWidget5();
            initMixedWidget6();
            initMixedWidget7();
            initMixedWidget10();            
            initMixedWidget12();
            initMixedWidget13(); 
            initMixedWidget14();
            initMixedWidget16();

            // Feeds
            initFeedWidget1();
            initFeedsWidget4();

            // Follow button
            initUserFollowButton();

            // Calendar
            initCalendarWidget1();           
        }   
    }
}();

// Webpack support
if (true) {
    module.exports = KTWidgets;
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTWidgets.init();
});


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("../demo1/src/js/custom/widgets.js");
/******/ 	
/******/ })()
;
//# sourceMappingURL=widgets.js.map
</script> --}}
@endsection
@endsection