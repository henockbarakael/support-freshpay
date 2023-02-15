"use strict";

// Class definition
var KTUsersAddUser = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_merchant');
    const form = element.querySelector('#kt_modal_add_merchant_form');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    var initAddUser = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'institution': {
                        validators: {
                            notEmpty: {
                                message: 'Institution is required'
                            }
                        }
                    },
                    'vodacom_number': {
                        validators: {
                            notEmpty: {
                                message: 'Vodacom number is required'
                            }
                        }
                    },
                    'airtel_number': {
                        validators: {
                            notEmpty: {
                                message: 'Airtel number is required'
                            }
                        }
                    },
                    'orange_number': {
                        validators: {
                            notEmpty: {
                                message: 'Orange number is required'
                            }
                        }
                    },
                    'vodacom_debit_comission': {
                        validators: {
                            notEmpty: {
                                message: 'Vodacom debit comission is required'
                            }
                        }
                    },
                    'airtel_debit_comission': {
                        validators: {
                            notEmpty: {
                                message: 'Airtel debit comission is required'
                            }
                        }
                    },
                    'orange_debit_comission': {
                        validators: {
                            notEmpty: {
                                message: 'Orange debit comission is required'
                            }
                        }
                    },
                    'vodacom_credit_comission': {
                        validators: {
                            notEmpty: {
                                message: 'Vodacom credit comission is required'
                            }
                        }
                    },
                    'airtel_credit_comission': {
                        validators: {
                            notEmpty: {
                                message: 'Airtel credit comission is required'
                            }
                        }
                    },
                    'orange_credit_comission': {
                        validators: {
                            notEmpty: {
                                message: 'Orange credit comission is required'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click 
                        submitButton.disabled = true;

                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function () {
                            // Remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');
                            // Enable button
                            submitButton.disabled = false;
                            var url = "merchant";
                            var institution = document.getElementById('institution');
                            var institution_code = institution[institution.selectedIndex].value;
                            var vodacom_number = $("input[name=vodacom_number]").val();
                            var airtel_number = $("input[name=airtel_number]").val();
                            var orange_number = $("input[name=orange_number]").val();
                            var vodacom_debit_comission = $("input[name=vodacom_debit_comission]").val();
                            var orange_debit_comission = $("input[name=orange_debit_comission]").val();
                            var airtel_debit_comission = $("input[name=airtel_debit_comission]").val();
                            var vodacom_credit_comission = $("input[name=vodacom_credit_comission]").val();
                            var orange_credit_comission = $("input[name=orange_credit_comission]").val();
                            var airtel_credit_comission = $("input[name=airtel_credit_comission]").val();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: url,
                                type:"POST",
                                data:{
                                institution_code:institution_code,
                                vodacom_number:vodacom_number,
                                airtel_number:airtel_number,
                                orange_number:orange_number,
                                vodacom_debit_comission:vodacom_debit_comission,
                                airtel_debit_comission:airtel_debit_comission,
                                orange_debit_comission:orange_debit_comission,
                                vodacom_credit_comission:vodacom_credit_comission,
                                airtel_credit_comission:airtel_credit_comission,
                                orange_credit_comission:orange_credit_comission,
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
                                            text: response.message + ". Merchant Secrete: " + response.data,
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) { 
                                                modal.hide();
                                            }
                                        });
                                    }
                                }
                            });
                            //form.submit(); // Submit form
                        }, 2000);
                    } else {
                        // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
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
            }
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
        cancelButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form			
                    modal.hide();	
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form			
                    modal.hide();	
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }

    return {
        // Public functions
        init: function () {
            initAddUser();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersAddUser.init();
});