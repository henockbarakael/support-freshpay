@extends('layouts.app')
@push('style')
<head><base href="">
    <title>Bienvenue | HemaStoc</title>
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
            <div class="col-lg-12 col-xxl-12">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #2196f3;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">USD {{number_format($success_usd,2)}}</span>
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">CDF {{number_format($success_cdf,2)}}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white  w-100 mt-auto mb-2">
                                <span style="font-size: 18px"> &#x2211; Daily Successful Transaction </span>
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>

            <div class="col-lg-12 col-xxl-12">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #2196f3;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">USD {{number_format($freshpay_airtel_usd + $freshpay_vodacom_usd + $freshpay_orange_usd,2)}}</span>
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">CDF {{number_format($freshpay_airtel_cdf + $freshpay_vodacom_cdf + $freshpay_orange_cdf,2)}}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span style="font-size: 18px">Total Freshpay Income </span>
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>

            <div class="col-lg-12 col-xxl-12">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #DB1430;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">USD {{number_format($telco_airtel_usd + $telco_vodacom_usd + $telco_orange_usd,2)}}</span>
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 20px">CDF {{number_format($telco_airtel_cdf + $telco_vodacom_cdf + $telco_orange_cdf,2)}}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span style="font-size: 18px">Total Telco Income </span>
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>


            <div class="col-lg-4 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #DB1430;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <span class="fw-bold text-white me-2 mb-2 lh-1" style="font-size: 16px">FRESHPAY CDF</span>
                            <span class="fw-bold text-white mb-2 me-2 lh-1" style="font-size: 16px">{{number_format($freshpay_airtel_cdf,2)}}</span>
                            <span class="fw-bold text-white me-2 mt-3 mb-2 lh-1" style="font-size: 16px">TELCO CDF</span>
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 16px">{{number_format($telco_airtel_cdf,2)}}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span> AIRTEL </span>
                                {{-- <span>{{$p_adebit_success}}%</span> --}}
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>

            <div class="col-lg-4 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #119e3e;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <span class="fw-bold text-white me-2 mb-2 lh-1" style="font-size: 16px">FRESHPAY CDF</span>
                            <span class="fw-bold text-white mb-2 me-2 lh-1" style="font-size: 16px">{{number_format($freshpay_vodacom_cdf,2)}}</span>
                            <span class="fw-bold text-white me-2 mt-3 mb-2 lh-1" style="font-size: 16px">TELCO CDF</span>
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 16px">{{number_format($telco_vodacom_cdf,2)}}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span> VODACOM</span>
                                {{-- <span>{{$p_vdebit_success}}%</span> --}}
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>

            <div class="col-lg-4 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: rgb(255, 133, 27);background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <span class="fw-bold text-white me-2 mb-2 lh-1" style="font-size: 16px">FRESHPAY CDF</span>
                            <span class="fw-bold text-white me-2 mb-2 lh-1" style="font-size: 16px">{{number_format($freshpay_orange_cdf,2)}}</span>
                            <span class="fw-bold text-white me-2 mt-3 mb-2 lh-1" style="font-size: 16px">TELCO CDF</span>
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 16px">{{number_format($telco_orange_cdf,2)}}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>ORANGE</span>
                                {{-- <span>{{$p_odebit_success}}%</span> --}}
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>


           
            <div class="col-lg-4 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #DB1430;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <span class="fw-bold text-white me-2 mb-2 lh-1" style="font-size: 16px">FRESHPAY USD</span>
                            <span class="fw-bold text-white mb-2 me-2 lh-1" style="font-size: 16px">{{number_format($freshpay_airtel_usd,2)}}</span>
                            <span class="fw-bold text-white me-2 mt-3 mb-2 lh-1" style="font-size: 16px">TELCO usd</span>
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 16px">{{number_format($telco_airtel_usd,2)}}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span> AIRTEL </span>
                                {{-- <span>{{$p_adebit_success}}%</span> --}}
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>

            <div class="col-lg-4 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: #119e3e;background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <span class="fw-bold text-white me-2 mb-2 lh-1" style="font-size: 16px">FRESHPAY USD</span>
                            <span class="fw-bold text-white mb-2 me-2 lh-1" style="font-size: 16px">{{number_format($freshpay_vodacom_usd,2)}}</span>
                            <span class="fw-bold text-white me-2 mt-3 mb-2 lh-1" style="font-size: 16px">TELCO usd</span>
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 16px">{{number_format($telco_vodacom_usd,2)}}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span> VODACOM</span>
                                {{-- <span>{{$p_vdebit_success}}%</span> --}}
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card widget 20-->
            </div>

            <div class="col-lg-4 col-xxl-4">
                <!--begin::Card widget 20-->
                <div class="card card-flush myshadow" style="background-color: rgb(255, 133, 27);background-image:url('{{ asset('assets/media/patterns/vector-1.png')}}')">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <div class="card-title d-flex flex-column">
                            <span class="fw-bold text-white me-2 mb-2 lh-1" style="font-size: 16px">FRESHPAY USD</span>
                            <span class="fw-bold text-white me-2 mb-2 lh-1" style="font-size: 16px">{{number_format($freshpay_orange_usd,2)}}</span>
                            <span class="fw-bold text-white me-2 mt-3 mb-2 lh-1" style="font-size: 16px">TELCO usd</span>
                            <span class="fw-bold text-white me-2 lh-1" style="font-size: 16px">{{number_format($telco_orange_usd,2)}}</span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end pt-0">
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                            <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                <span>ORANGE</span>
                                {{-- <span>{{$p_odebit_success}}%</span> --}}
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