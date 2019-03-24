<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description"
          content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta property="og:url" content="http://demo.madebytilde.com/elephant">
    <meta property="og:type" content="website">
    <meta property="og:title"
          content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">
    <meta property="og:description"
          content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta property="og:image" content="http://demo.madebytilde.com/elephant.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@madebytilde">
    <meta name="twitter:creator" content="@madebytilde">
    <meta name="twitter:title"
          content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">
    <meta name="twitter:description"
          content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta name="twitter:image" content="http://demo.madebytilde.com/elephant.jpg">
    <link rel="icon" type="image/png" href="{{ asset('storage/img/logo2.png') }}" sizes="32x32">
    <meta name="theme-color" content="#1d2a39">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elephant.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/errors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login-1.min.css') }}">
</head>
<body>
<div class="login">
    <div class="login-body">
        <a class="login-brand" href="">
            <img class="img-responsive" src="{{ asset('storage/img/0nfUOsQ23lmBMjOSEJRwkY5YYWf6GmWDJgtr9ckn.png') }}"
                 alt="Elephant">
        </a>
        <h3 class="login-heading">Reset Your Password</h3>
        @if(Session::has('error'))
            <div class="center-block">
                <div class="alert alert-danger alert-dismissible fade in" style="width: 100%" id="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('error') }}
                </div>
            </div>
        @endif
        <div class="login-form">
            <form method="post">
                @if ($username == "")
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" disabled class="form-control" placeholder="Masukan password"
                               style="background: #233345" maxlength="12" type="password" name="password"
                               spellcheck="false" autocomplete="off" autofocus
                               data-msg-required="Please enter your password." required>
                        <span class="text-danger">
                        <strong id="password-error"></strong>
                    </span>
                    </div>
                    <div class="form-group">
                        <label for="konpas">Konfirmasi Password</label>
                        <input id="konpas" disabled class="form-control" placeholder="Masukan password kembali"
                               style="background: #233345" maxlength="12" type="password" name="konpass"
                               spellcheck="false" autocomplete="off"
                               data-msg-required="Please enter your password again." required>
                        <span class="text-danger">
                        <strong id="konpas-error"></strong>
                    </span>
                    </div>
                @else
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" class="form-control" maxlength="12" type="password" name="password"
                               spellcheck="false" autocomplete="off" autofocus placeholder="Masukan password" required>
                        <span class="text-danger">
                        <strong id="password-error"></strong>
                    </span>
                    </div>
                    <div class="form-group">
                        <label for="konpas">Konfirmasi Password</label>
                        <input id="konpas" class="form-control" placeholder="Masukan password kembali" maxlength="12"
                               type="password" name="konpass"
                               spellcheck="false" autocomplete="off"
                               data-msg-required="Please enter your password again." required>
                        <span class="text-danger">
                        <strong id="konpas-error"></strong>
                    </span>
                    </div>
                @endif
                <div class="form-group">
                    <button class="btn btn-primary btn-block btn-reset" type="submit">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
<script src="{{ asset('js/vendor.min.js') }} "></script>
<script src="{{ asset('js/elephant.min.js') }} "></script>
<script>
    $(document).ready(function () {
        $(".btn-reset").click(function (event) {
            event.preventDefault();

            var password = $("#password").val();
            var konpass = $("#konpas").val();
            var username = "{{ $username }}";
            var sendData = "password=" + password + "&username=" + username;

            if (password != konpass) {
                $("#konpas-error").html("Password is not the same");
                $("#konpas-error").fadeIn(1000);
                $("#konpas-error").fadeOut(5000);
            } else if (password == "" && konpass == "") {
                $("#konpas-error").html("The confirmation password field is required");
                $("#password-error").html("The password field is required");
                $("#konpas-error, #password-error").fadeIn(1000);
                $("#konpas-error, #password-error").fadeOut(5000);
            } else {
                if (password.length < 8 || konpass.length < 8) {
                    $("#konpas-error").html("The confirmation password minimum 8 characters");
                    $("#password-error").html("The password minimum 8 characters");
                    $("#konpas-error, #password-error").fadeIn(1000);
                    $("#konpas-error, #password-error").fadeOut(5000);
                } else {
                    $(".btn-reset").removeAttr("disabled");
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ URL('api/changePassword') }}",
                        data: sendData,
                        success: function (data) {
                            notification(data.status, data.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 1000)
                        },
                        error: function (xhr, status, error) {
                            alert(status + " : " + error);
                        }
                    });
                }
            }
        });
    });

    function notification(status, msg) {
        if (status == 200) {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.success(msg);
        } else {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr.error(msg);
        }
    }
</script>
</body>
</html>
