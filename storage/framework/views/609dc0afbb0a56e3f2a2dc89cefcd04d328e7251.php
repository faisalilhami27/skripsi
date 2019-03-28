<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Choose Level Page</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta property="og:url" content="http://demo.madebytilde.com/elephant">
    <meta property="og:type" content="website">
    <meta property="og:title" content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">
    <meta property="og:description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta property="og:image" content="http://demo.madebytilde.com/elephant.jpg">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@madebytilde">
    <meta name="twitter:creator" content="@madebytilde">
    <meta name="twitter:title" content="The fastest way to build Modern Admin APPS for any platform, browser, or device.">
    <meta name="twitter:description" content="Elephant is an admin template that helps you build modern Admin Applications, professionally fast! Built on top of Bootstrap, it includes a large collection of HTML, CSS and JS components that are simple to use and easy to customize.">
    <meta name="twitter:image" content="http://demo.madebytilde.com/elephant.jpg">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo2.png')); ?>" sizes="32x32">
    <meta name="theme-color" content="#1d2a39">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="<?php echo e(asset('css/vendor.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/elephant.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/errors.min.css')); ?>">
</head>
<body>
<div class="error">
    <div class="error-body">
        <h1 class="error-heading"><b><?php echo e($title); ?></b></h1>
        <h4 class="error-subheading">Untuk masuk ke dalam Aplikasi</h4>
        <p>
            <small>Silahkan pilih level yang anda miliki dibawah ini : </small>
        </p>
        <?php $__currentLoopData = $chooseRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $r->roleMany; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><a class="btn btn-primary btn-pill btn-thick" id="<?php echo e($r->id_user_level); ?>" href=""><?php echo e($cr->nama_level); ?></a></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="error-footer">
        <p>
            <small>© <?php echo e(date('Y')); ?> Failda Waterpark</small>
        </p>
    </div>
</div>
<a href="<?php echo e(URL('logout')); ?>" class="btn btn-danger pull-right" style="margin-right: 20px"><span class="icon icon-sign-out"></span> Logout</a>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo e(asset('js/vendor.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/elephant.min.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $('.btn-thick').click(function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                },
                url: "<?php echo e(url('link')); ?>",
                type: "GET",
                data: "id=" + id,
                dataType: "JSON",
                success: function (data) {
                    if (data.status == 200){
                        $(location).attr('href', "<?php echo e(url('dashboard')); ?>");
                    }
                },
            });
        });
    });
</script>
</body>
</html>
