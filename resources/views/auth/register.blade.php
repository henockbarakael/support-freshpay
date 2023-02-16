@extends('layouts.auth')
@section('title', 'FreshPay Congo - Connexion')
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
        <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
            <!--begin::Image-->
            <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('assets/media/auth/FreshPay logo_revised (1).56b46bd8.png')}}" alt="">
            <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('assets/media/auth/agency-dark.png')}}" alt="">
            <!--end::Image-->
            <!--begin::Title-->
            <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Best Online Payment Solution</h1>
            <!--end::Title-->
            <!--begin::Text-->
            <div class="text-gray-600 fs-base text-center fw-semibold">In this kind of post, 
            <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they’ve interviewed 
            <br>and provides some background information about 
            <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their 
            <br>work following this is a transcript of the interview.</div>
            <!--end::Text-->
        </div>
        <!--end::Content-->
    </div>
    <!--begin::Aside-->
    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
        <!--begin::Wrapper-->
        <div class="bg-body d-flex flex-center rounded-4 w-md-600px p-10">
            <!--begin::Content-->
            <div class="w-md-400px">
                <!--begin::Form-->
                <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" data-kt-redirect-url="login" action="#">
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">REGISTER</h1>
                        <!--end::Title-->
                        <!--begin::Subtitle-->
						<div class="text-gray-500 fw-semibold fs-6">FreshPay Support Dashboard</div>
						<!--end::Subtitle=-->
                    </div>
                    <!--begin::Separator-->
						<div class="separator separator-content my-14">
							<span class="w-125px text-gray-500 fw-semibold fs-7">Welcome!</span>
						</div>
					<!--end::Separator-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Firstname-->
                        <input type="text" placeholder="Firstname" id="firstname" name="firstname" autocomplete="off" class="form-control bg-transparent myshadow">
                        <!--end::Firstname-->
                    </div>
                    <!--begin::Input group-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Lastname-->
                        <input type="text" placeholder="Lastname" id="lastname" name="lastname" autocomplete="off" class="form-control bg-transparent myshadow">
                        <!--end::Lastname-->
                    </div>
                    <div class="fv-row mb-8">
                        <!--begin::Lastname-->
                        <input type="email" placeholder="E-mail" id="email" name="email" autocomplete="off" class="form-control bg-transparent myshadow">
                        <!--end::Lastname-->
                    </div>
                    <!--begin::Input group-->
                    <div class="fv-row mb-8" data-kt-password-meter="true">
                        <!--begin::Wrapper-->
                        <div class="mb-1">
                            <!--begin::Input wrapper-->
                            <div class="position-relative mb-3 myshadow">
                                <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" autocomplete="off">
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i class="bi bi-eye-slash fs-2"></i>
                                    <i class="bi bi-eye fs-2 d-none"></i>
                                </span>
                            </div>
                            <!--end::Input wrapper-->
                            <!--begin::Meter-->
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                            <!--end::Meter-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Hint-->
                        <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Input group=-->
                    <!--end::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Repeat Password-->
                        <input placeholder="Repeat Password" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-transparent myshadow">
                        <!--end::Repeat Password-->
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-8">
                        <select name="role_name" id="role_name" class="form-select myshadow form-select-solid bg-transparent" autocomplete="off">
                            <option selected disabled>Assigner un rôle</option>
                            <option value="SuperAdmin">SuperAdmin</option>
                            <option value="Admin">Admin</option>
                            <option value="Manager">Manager</option>
                            <option value="Finance">Finance</option>
                            <option value="Support_1">Support_1</option>
                            <option value="Support_2">Support_2</option>
                            {{-- <option value="Support_3">Support_3</option> --}}
                        </select>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Submit button-->
                    <div class="d-grid mb-10 myshadow">
                        <button type="submit" id="kt_sign_up_submit" class="btn btn-primary myshadow">
                            <!--begin::Indicator label-->
                            <span class="indicator-label ">SIGN UP</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Please wait... 
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                    <!--end::Submit button-->
                    <!--begin::Sign up-->
                    <div class="text-gray-500 text-center fw-semibold fs-6 ">Already have an Account? 
                    <a href="{{route('login')}}" class="link-primary fw-semibold">LOGIN</a></div>
                    <!--end::Sign up-->
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
"use strict";

// Class definition
var KTSignupGeneral = function() {
    // Elements
    var form;
    var submitButton;
    var validator;
    var passwordMeter;

    // Handle form
    var handleForm  = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
			form,
			{
				fields: {
					'firstname': {
						validators: {
							notEmpty: {
								message: 'First Name is required'
							}
						}
                    },
                    'lastname': {
						validators: {
							notEmpty: {
								message: 'Last Name is required'
							}
						}
					},
                    'role_name': {
						validators: {
							notEmpty: {
								message: 'Role Name is required'
							}
						}
					},
					'email': {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: 'The value is not a valid email address',
                            },
							notEmpty: {
								message: 'Email address is required'
							}
						}
					},
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            },
                            callback: {
                                message: 'Please enter valid password',
                                callback: function(input) {
                                    if (input.value.length > 0) {
                                        return validatePassword();
                                    }
                                }
                            }
                        }
                    },
                    'confirm-password': {
                        validators: {
                            notEmpty: {
                                message: 'The password confirmation is required'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    }
                    // 'toc': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'You must accept the terms and conditions'
                    //         }
                    //     }
                    // }
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: false
                        }  
                    }),
					bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
				}
			}
		);

        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            validator.revalidateField('password');

            validator.validate().then(function(status) {
		        if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click 
                    submitButton.disabled = true;

                    // Simulate ajax request
                    setTimeout(function() {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;
                        var url = "registration";
                        var password = $("input[name=password]").val();
                        var password_confirmation = $("input[name=password_confirmation]").val();
                        var firstname = $("input[name=firstname]").val();
                        var lastname = $("input[name=lastname]").val();
                        var email = $("input[name=email]").val();
                        var selector = document.getElementById('role_name');
                        var role_name = selector[selector.selectedIndex].value;
                            $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                            });
                            $.ajax({
                                url: url,
                                type:"POST",
                                data:{
                                firstname:firstname,
                                lastname:lastname,
                                role_name:role_name,
                                password:password,
                                email:email,
                                password_confirmation:password_confirmation,
                                },
                                success:function(response){
                                    if(response.status == false) {
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
                                    else if(response.status == true) {
                                        // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                        Swal.fire({
                                            text: response.message,
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) { 
                                                form.reset();  // reset form                    
                                                passwordMeter.reset();  // reset password meter
                                                //form.submit();

                                                //form.submit(); // submit form
                                                var redirectUrl = form.getAttribute('data-kt-redirect-url');
                                                if (redirectUrl) {
                                                    location.href = redirectUrl;
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                    }, 2000);  						
		        }
                else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
		    });
        });
            // Handle password input
            form.querySelector('input[name="password"]').addEventListener('input', function() {
                if (this.value.length > 0) {
                    validator.updateFieldStatus('password', 'NotValidated');
                }
            });
    }

    // Password input validation
    var validatePassword = function() {
        return (passwordMeter.getScore() === 100);
    }

    // Public functions
    return {
        // Initialization
        init: function() {
                // Elements
                form = document.querySelector('#kt_sign_up_form');
                submitButton = document.querySelector('#kt_sign_up_submit');
                passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

                handleForm ();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTSignupGeneral.init();
});

</script>
<!--end::Custom Javascript-->
@endsection
@endsection
