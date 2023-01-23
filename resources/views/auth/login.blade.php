<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
		<title>FreshPay Bakery - Connexion</title>
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
        <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<!--end::Global Stylesheets Bundle-->
		<!--Begin::Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');</script>
		<!--End::Google Tag Manager -->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
		<!--begin::Theme mode setup on page load-->
		<script>
            var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }
        </script>
		<!--end::Theme mode setup on page load-->
		<!--Begin::Google Tag Manager (noscript) -->
		<noscript>
			<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<!--End::Google Tag Manager (noscript) -->
		<!--begin::Main-->
		<!--begin::Root-->
        {!! Toastr::message() !!}
		<div class="d-flex flex-column flex-root">
			<!--begin::Page bg image-->
			<style>
                body { background-image: url('assets/media/auth/bg6.jpg'); } [data-theme="dark"] body { background-image: url('assets/media/auth/bg6-dark.jpg'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Signup Welcome Message -->
			<div class="d-flex flex-column flex-center flex-column-fluid">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-center text-center p-10">
					<!--begin::Wrapper-->
					<div class="card card-flush w-lg-650px py-5">
						<div class="card-body py-15 py-lg-20">
							<!--begin::Logo-->
							<div class="mb-2">
								<a href="#" class="">
									<img alt="Logo" src="{{ asset('assets/media/auth/FreshPay logo_revised (1).56b46bd8.png')}}" class="h-40px">
								</a>
							</div>

                            <form class="fs-6" method="POST" action="{{route('login.post')}}" autocomplete="off">
                                @csrf
                                <!--begin::Separator-->
                                    <div class="separator separator-content my-9">
                                        <span class="w-125px text-gray-500 fw-semibold fs-7">Welcome!</span>
                                    </div>
                                <div class="fv-row mb-8">
                                    <!--begin::Email-->
                                    <input  type="email" placeholder="email@domain.com" id="email" name="email" autocomplete="off" class="form-control bg-transparent myshadow @error('email') is-invalid @enderror" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--end::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Password-->
                                    <input  type="password" placeholder="Password" id="password" name="password" autocomplete="off" class="form-control bg-transparent myshadow @error('password') is-invalid @enderror" required>
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
						</div>
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Authentication - Signup Welcome Message-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "/assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>