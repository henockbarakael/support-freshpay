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
                                <span>{{$debit_mpesa_success + $debit_airtel_success + $debit_orange_success}} Successful</span>
                                {{-- <span>{{$percent_success}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_mpesa_failed + $debit_airtel_failed + $debit_orange_failed}} Failed</span>
                                {{-- <span>{{$percent_failed}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_mpesa_pending + $debit_airtel_pending + $debit_orange_pending}} Pending</span>
                                {{-- <span>{{$percent_pending}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_mpesa_submitted + $debit_airtel_submitted + $debit_orange_submitted}} Submitted</span>
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
                                <span>{{$credit_mpesa_success + $credit_airtel_success + $credit_orange_success}} Successful</span>
                                {{-- <span>{{$percent_success}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_mpesa_failed + $credit_airtel_failed + $credit_orange_failed}} Failed</span>
                                {{-- <span>{{$percent_failed}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_mpesa_pending + $credit_airtel_pending + $credit_orange_pending}} Pending</span>
                                {{-- <span>{{$percent_pending}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_mpesa_submitted + $credit_airtel_submitted + $credit_orange_submitted}} Submitted</span>
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
            <!--begin::Col-->
            <div class="col-lg-6 col-xxl-4">
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
                                {{-- <span>{{$p_adebit_success}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_airtel_failed}} Failed</span>
                                {{-- <span>{{$p_adebit_failed}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_airtel_pending}} Pending</span>
                                {{-- <span>{{$p_adebit_pending}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_airtel_submitted}} Submitted</span>
                                {{-- <span>{{$p_adebit_submitted}}%</span> --}}
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
                                {{-- <span>{{$p_acredit_success}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_airtel_failed}} Failed</span>
                                {{-- <span>{{$p_acredit_failed}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_airtel_pending}} Pending</span>
                                {{-- <span>{{$p_acredit_pending}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_airtel_submitted}} Submitted</span>
                                {{-- <span>{{$p_acredit_submitted}}%</span> --}}
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
                                <span>{{$debit_mpesa_success}} Successful</span>
                                {{-- <span>{{$p_vdebit_success}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_mpesa_failed}} Failed</span>
                                {{-- <span>{{$p_vdebit_failed}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_mpesa_pending}} Pending</span>
                                {{-- <span>{{$p_vdebit_pending}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_mpesa_submitted}} Submitted</span>
                                {{-- <span>{{$p_vdebit_submitted}}%</span> --}}
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
                                <span>{{$credit_mpesa_success}} Successful</span>
                                {{-- <span>{{$p_vcredit_success}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_mpesa_failed}} Failed</span>
                                {{-- <span>{{$p_vcredit_failed}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_mpesa_pending}} Pending</span>
                                {{-- <span>{{$p_vcredit_pending}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_mpesa_submitted}} Submitted</span>
                                {{-- <span>{{$p_vcredit_submitted}}%</span> --}}
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
                                {{-- <span>{{$p_odebit_success}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_orange_failed}} Failed</span>
                                {{-- <span>{{$p_odebit_failed}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_orange_pending}} Pending</span>
                                {{-- <span>{{$p_odebit_pending}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$debit_orange_submitted}} Submitted</span>
                                {{-- <span>{{$p_odebit_submitted}}%</span> --}}
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
                                {{-- <span>{{$p_ocredit_success}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_orange_failed}} Failed</span>
                                {{-- <span>{{$p_ocredit_failed}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_orange_pending}} Pending</span>
                                {{-- <span>{{$p_ocredit_pending}}%</span> --}}
                            </div>
                            
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-2 mb-2">
                                <span>{{$credit_orange_submitted}} Submitted</span>
                                {{-- <span>{{$p_ocredit_submitted}}%</span> --}}
                            </div>
                            
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>
        </div>

        {{-- <div class="row g-5 g-xl-8">
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
            <div class="col-xl-6">
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
            </div>
        </div> --}}

 
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

@endsection
@endsection