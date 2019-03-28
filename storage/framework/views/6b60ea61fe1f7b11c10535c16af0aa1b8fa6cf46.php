<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e($title); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('img/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo2.png')); ?>" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo2.png')); ?>" sizes="16x16">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="<?php echo e(asset('css/vendor.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/elephant.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/login-2.min.css')); ?>">
</head>
<body>
<div class="login">
    <div class="login-body">
        <a class="login-brand">
            <img class="img-responsive" src="<?php echo e(asset('img/logo2.png')); ?>" alt="Elephant">
        </a>
        <div class="login-form">
            <form method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-with-icon">
                        <input id="username" class="form-control" type="text" name="username" maxlength="20" autocomplete="off" autofocus required>
                        <span class="icon icon-user input-icon"></span>
                        <span class="text-danger">
                            <strong id="username-error"></strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <input id="password" class="form-control" type="password" maxlength="12" name="password" required>
                        <span class="icon icon-lock input-icon"></span>
                        <span class="text-danger">
                            <strong id="password-error"></strong>
                        </span>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" id="btn-login" type="submit"><span class="icon icon-sign-in"></span> Sign in</button>
            </form>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
<script src="<?php echo e(asset('js/vendor.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/elephant.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/script.js')); ?>"></script>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-83990101-1', 'auto');
    ga('send', 'pageview');
</script>
<script>
    $(document).ready(function () {
        $("#btn-login").click(function (e) {
            e.preventDefault();
            var username = $("#username").val(),
                password = $("#password").val(),
                sendData = "username=" + username + "&password=" + password;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                },
                url: "<?php echo e(url('auth/checklogin')); ?>",
                type: "POST",
                dataType: "JSON",
                data: sendData,
                success: function (data) {
                    if (data.status == 200) {
                        notification(data.status, data.msg);
                        if (data.count == 1) {
                            setTimeout(function () {
                                $(location).attr('href', "<?php echo e(url('dashboard')); ?>");
                            }, 1000);
                        } else {
                            setTimeout(function () {
                                $(location).attr('href', "<?php echo e(url('role')); ?>");
                            }, 1000);
                        }
                    } else {
                        notification(data.status, data.msg);
                    }
                },
                error: function (resp) {
                    if (_.has(resp.responseJSON, 'errors')) {
                        _.map(resp.responseJSON.errors, function (val, key) {
                            $('#' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(5000);
                        })
                    }
                    alert(resp.responseJSON.message)
                }
            });
        });
    });
</script>
</body>
</html>