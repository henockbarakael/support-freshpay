@extends('layouts.auth')
@section('title', 'FreshPay Bakery - Connexion')
@section('content')
{!! Toastr::message() !!}
<!--begin::Page bg image-->
<style>body { background-image: url('assets/media/auth/bg10.jpeg'); } [data-theme="dark"] body { background-image: url('assets/media/auth/bg10-dark.jpeg'); }</style>
<!--end::Page bg image-->
<!--begin::Authentication - Sign-in -->
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Aside-->
    <div class="d-flex flex-lg-row-fluid">
        <!--begin::Content-->
        <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100 ">
            <!--begin::Image-->
            <img class="theme-light-show  mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('assets/media/auth/FreshPay logo_revised (1).56b46bd8.png')}}" alt="">
            <img class="theme-dark-show  mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('assets/media/auth/agency-dark.png')}}" alt="">
            <!--end::Image-->
            <!--begin::Title-->
            <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Best Online Payment Solution</h1>
            <!--end::Title-->
            <!--begin::Text-->
            <div class="text-gray-600 fs-base text-center fw-semibold">
                "Teamwork is the ability to work together toward a common vision. The ability to direct individual accomplishments toward organizational objectives. 
            <br>It is the fuel that allows common people to attain uncommon results."</div>
            <!--end::Text-->
        </div>
        <!--end::Content-->
    </div>
    <!--begin::Aside-->
    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
        <!--begin::Wrapper-->
        <div class="bg-body d-flex flex-center rounded-4 w-md-600px p-10 myshadow">
            <!--begin::Content-->
            <div class="w-md-400px">
                <!--begin::Form-->
                <form class="form w-100 " method="POST" action="{{route('login.post')}}" autocomplete="off">
                {{-- <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#"> --}}
					@csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">LOGIN</h1>
                        <!--end::Title-->
                        <!--begin::Subtitle-->
						<div class="text-gray-500 fw-semibold fs-6">FreshPay Support Dashboard</div>
						<!--end::Subtitle=-->
                    </div>
                    <!--begin::Separator-->
						<div class="separator separator-content my-14">
							<span class="w-125px text-gray-500 fw-semibold fs-7">Welcome!</span>
						</div>
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input autocomplete="off" type="email" placeholder="email@domain.com" id="email" name="email" autocomplete="off" class="form-control bg-transparent myshadow @error('email') is-invalid @enderror" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!--end::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Password-->
                        <input autocomplete="off" type="password" placeholder="Password" id="password" name="password" autocomplete="off" class="form-control bg-transparent myshadow @error('password') is-invalid @enderror" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-grid mb-10 myshadow">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary myshadow">
                            <!--begin::Indicator label-->
                            <span class="indicator-label"><i class="fa fa-sign-in" style="font-size:26px"></i>LOGIN</span>
                            <span class="indicator-progress">Please wait... 
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Body-->
</div>
<!--end::Authentication - Sign-in-->
@section('script')
<!--begin::Custom Javascript(used for this page only)-->
<script type="text/javascript">
    $( document ).ready(function() {
        $('input').attr('autocomplete','off');
    });
</script>
<!--end::Custom Javascript-->
@endsection
@endsection
