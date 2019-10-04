$.validation = {
    messages: {}
};

$.extend($.validation.messages, {
    required: 'required.'
});

$(document).ready(function () {
    validateSignupForm();
});

var validateSignupForm = function () {
    var login = $('#login');

    login.validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            username: {
                required: $.validation.messages.required
            },
            password: {
                required: $.validation.messages.required
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);

            $(window).resize(function () {
                error.remove();
            });
        },
        invalidHandler: function (event, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) { } else { }
        }
    });

    login.on('submit', function (e) {
        if (login.valid()) {
            var form = $(this);
            $.ajax({
                url: 'rlogin.php',
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        if (response.messages == "admin") {
                            window.location.href = 'admin/dashboard.php';
                        } else if (response.messages == "employee") {
                            window.location.href = 'employee/employee.php';
                        } else if (response.messages == "service") {
                            window.location.href = 'siteadmin/connectstatus.php';
                        } else {
                            swal("รอการยืนยัน", response.messages, "warning");
                        }
                    } else {
                        swal("ผิดพลาด", response.messages, "error");
                    }
                },
                beforeSend: function () { }
            });
        }
        e.preventDefault();
        e.stopPropagation();
    });
}