$('document').ready(function () {
    $("#login_form").validate({
        errorClass: 'error_message',
        rules: {
            password: {
                required: true,
                minlength: 4
            },
            username: {
                required: true,
            },
        },
        messages: {
            password: {
                required: "Enter Password"
            },
            username: "Enter Username",
        },
        submitHandler: submitForm
    });

    function submitForm() {
        var username = $('#username').val();
        var password = $('#password').val();

        if ($.trim(username).length > 0 && $.trim(password).length > 0) {
            $.ajax({
                url: "operations/user_authentication.php",
                method: "POST",
                data: {
                    username: username,
                    password: password,
                },
                cache: false,
                success: function (response) {
                    if (response == 1) {
                        $("#alert").fadeIn(3000, function () {
                            $("#alert").html('<div class="alert alert-danger"> <i class="fa fa-info-circle"></i> <label class="text-danger">Invalid <strong>Password</stong></label> </div><br>');
                        });
                    } else if (response == 2) {
                        $("#alert").fadeIn(3000, function () {
                            $("#alert").html('<div class="alert alert-danger"> <i class="fa fa-info-circle"></i> <label class="text-danger">Access denied, Contact Administrater</label> </div><br>');
                        });
                    } else if (response == 3) {
                        $("#alert").fadeIn(3000, function () {
                            $("#alert").html('<div class="alert alert-danger"> <i class="fa fa-info-circle"></i>   <label class="text-danger"><strong>Username </strong>  not found </label></div><br>');
                        });
                    } else {
                        window.location.href = response;
                    }
                }
            });
        }
        return false;
    }
});