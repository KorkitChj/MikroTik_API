// initialize validation messages variable
$.validation = {
    messages: {}
};

// add validation templates to show fancy icons with message text
$.extend($.validation.messages, {
    required: '<i class="fa fa-exclamation-circle"></i> required.',
    email: '<i class="fa fa-exclamation-circle"></i> Please enter a valid email.',
    signup_confirm_password: '<i class="fa fa-exclamation-circle"></i> Confirm password must match the password.'
});

// call our 'validateSignupForm' function when page is ready
$(document).ready(function () {
    validateSignupForm();
});

// bind jQuery validation event and form 'submit' event
var validateSignupForm = function () {
    var modal_signup = $('#modal_signup');
    var modal_form_signup = $('#modal_form_signup');
    var modal_signup_result = $('#modal_signup_result');

    // bind jQuery validation event
    modal_form_signup.validate({
        rules: {
            modal_signup_firstname: {
                required: true      // firstname field is required
            },
            modal_signup_lastname: {
                required: true      // lastname field is required
            },
            modal_signup_email: {
                required: true,     // email field is required
                email: true         // validate email address
            },
            modal_signup_password: {
                required: true      // password field is required
            },
            modal_signup_confirm_password: {
                required: true,     // confirm password field is required
                equalTo: '#modal_signup_password'
            }
        },
        messages: {
            modal_signup_firstname: {
                required: $.validation.messages.required
            },
            modal_signup_lastname: {
                required: $.validation.messages.required
            },
            modal_signup_email: {
                required: $.validation.messages.required,
                email: $.validation.messages.email
            },
            modal_signup_password: {
                required: $.validation.messages.required
            },
            modal_signup_confirm_password: {
                required: $.validation.messages.required,
                equalTo: $.validation.messages.signup_confirm_password
            }
        },
        errorPlacement: function (error, element) {
            // insert error message after invalid element
            error.insertAfter(element);

            // hide error message on window resize event
            $(window).resize(function () {
                error.remove();
            });
        },
        invalidHandler: function (event, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
            } else {
            }
        }
    });

    var modal_signup_firstname = $('#modal_signup_firstname');
    var modal_signup_lastname = $('#modal_signup_lastname');
    var modal_signup_email = $('#modal_signup_email');
    var modal_signup_password = $('#modal_signup_password');

    // bind form submit event
    modal_form_signup.on('submit', function (e) {
        // if form is valid then call AJAX script
        if (modal_form_signup.valid()) {
            var ajaxRequest = $.ajax({
                url: 'ajax/signup.php',
                type: "POST",
                data: {
                    firstname: modal_signup_firstname.val(),
                    lastname: modal_signup_lastname.val(),
                    email: modal_signup_email.val(),
                    password: modal_signup_password.val()
                },
                beforeSend: function () {
                }
            });

            ajaxRequest.fail(function (data, status, errorThrown) {
                // error
                var $message = data.responseText;
                modal_signup_result.html('<div class="alert alert-danger">' + $message + '</div>');
                modal_signup.modal('hide');
            });

            ajaxRequest.done(function (response) {
                // done
                var $response = $.parseJSON(response);
                modal_signup_result.html('<div class="alert alert-success">' + $response.message + '</div>');
                modal_signup.modal('hide');
            });
        }

        // stop default submit event of form
        e.preventDefault();
        e.stopPropagation();
    });

    modal_signup.on('hide.bs.modal', function (e) {
        // reset form fields and validation errors
        modal_form_signup.validate().resetForm();
        modal_form_signup.trigger('reset');
    });
}