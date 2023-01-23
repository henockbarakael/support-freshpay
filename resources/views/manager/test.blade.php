<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../">
		<title>Test API | FreshPay Bakery</title>
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
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendor Stylesheets(used by this page)-->
		<link href="{{ asset('assets/plugins/custom/leaflet/leaflet.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendor Stylesheets-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
		<!--begin::Root-->
        {!! Toastr::message() !!}
        @include('sweetalert::alert')
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				@include('layouts.aside')
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Header-->
					@include('layouts.header')
					<!--end::Header-->
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Toolbar-->
						<div class="toolbar" id="kt_toolbar">
							<!--begin::Container-->
							<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
								@include('layouts.page-title')
							</div>
							<!--end::Container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl">
								<!--begin::Contact-->
								<div class="card">
									<!--begin::Body-->
									<div class="card-body p-lg-17">
										
										<div class="row mb-3">
											
											<div class="col-md-12 pe-lg-10">
												
												<form action="{{route('admin.api.post.request')}}" method="POST" class="form mb-15">
                                                    @csrf
													<h1 class="fw-bolder text-dark" style="margin-bottom: 12px">Payment Request</h1>
													
													<div class="row mb-7" style="margin-top: 55px">
                                                        <div class="col-md-12 mb-5 fv-row">
															<label class="fs-5 fw-bold mb-2">Operator</label>
															<select name="method" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option">
                                                                <option></option>
                                                                <option value="mpesa">Vodacom Cd.</option>
                                                                <option value="airtel">Airtel Cd.</option>
                                                                <option value="orange">Orange Cd.</option>
                                                            </select>
														</div>
														<div class="col-md-6 mb-5 fv-row">
															<label class="fs-5 fw-bold mb-2">Customer number</label>
															<input type="text" class="form-control form-control-solid" placeholder="Insert a customer number" name="customer_number" />
														</div>
                                                        <div class="col-md-6 mb-5 fv-row">
                                                            <label class="fs-5 fw-bold mb-2">Action</label>
                                                            <select name="action" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option">
                                                                <option></option>
                                                                <option value="credit">Credit</option>
                                                                <option value="debit">Debit</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 mb-5 fv-row">
															<label class="fs-5 fw-bold mb-2">Amount</label>
															<input type="text" class="form-control form-control-solid" placeholder="Insert transaction amount" name="amount" />
														</div>
                                                        <div class="col-md-6 mb-5 fv-row">   
                                                            <label class="fs-5 fw-bold mb-2">Currency</label>
                                                            <select name="currency" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option">
                                                                <option></option>
                                                                <option value="CDF">Franc congolais</option>
                                                                <option value="USD">Dollar américain</option>
                                                            </select>                                                
                                                        </div>
                                                    </div>

													<button type="submit" class="btn btn-primary" id="kt_contact_submit_button">
														<!--begin::Indicator-->
														<span class="indicator-label">Post Request</span>
														<span class="indicator-progress">Please wait...
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
														<!--end::Indicator-->
													</button>
													<!--end::Submit-->
												</form>
												<!--end::Form-->
											</div>
										</div>
									</div>
									<!--end::Body-->
								</div>
								<!--end::Contact-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					@include('layouts.footer')
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{ asset('assets/plugins/custom/leaflet/leaflet.bundle.js')}}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{ asset('assets/js/custom/pages/company/contact.js')}}"></script>
		<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
		<script src="{{ asset('assets/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{ asset('assets/js/custom/modals/create-app.js')}}"></script>
		<script src="{{ asset('assets/js/custom/modals/upgrade-plan.js')}}"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>