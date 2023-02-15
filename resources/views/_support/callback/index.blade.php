<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head><base href="../../">
		<title>Callback | FreshPay Congo</title>
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
												
												<form action="{{route('support.callback.process')}}" method="POST" class="form mb-15">
                                                    @csrf
													<h1 class="fw-bolder text-dark" style="margin-bottom: 12px">Send callback to Merchant</h1>
													
													<div class="row mb-7" style="margin-top: 55px">

														<div class="col-md-6 mb-5 fv-row">
															<label class="fs-5 fw-bold mb-2">Paydrc Reference</label>
															<input type="text" autocomplete="off" class="form-control form-control-solid" placeholder="" name="paydrc_reference" />
														</div>
                                                        <div class="col-md-6 mb-5 fv-row">
															<label class="fs-5 fw-bold mb-2">Switch Reference</label>
															<input type="text" autocomplete="off" class="form-control form-control-solid" placeholder="" name="switch_reference" />
														</div>
                                                        <div class="col-md-6 mb-5 fv-row">
															<label class="fs-5 fw-bold mb-2">Telco Reference</label>
															<input type="text" autocomplete="off" class="form-control form-control-solid" placeholder="" name="telco_reference" />
														</div>
                                                        <div class="col-md-6 mb-5 fv-row">
															<label class="fs-5 fw-bold mb-2">Telco Status Description</label>
															<input type="text" autocomplete="off" class="form-control form-control-solid" placeholder="" name="telco_status_description" />
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
                                                            <label class="fs-5 fw-bold mb-2">Status</label>
                                                            <select name="status" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option">
                                                                <option></option>
                                                                <option value="Failed">Failed</option>
                                                                <option value="Successful">Successful</option>
                                                            </select>
                                                        </div>
                                                    </div>

													<button type="submit" class="btn btn-primary">
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
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{ asset('assets/js/custom/pages/company/contact.js')}}"></script>
		<script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>