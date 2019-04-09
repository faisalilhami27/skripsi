<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Choose Level Page</title>
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
    <link rel="icon" type="image/png" href="{{ asset('img/logo2.png') }}" sizes="32x32">
    <meta name="theme-color" content="#1d2a39">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/elephant.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/errors.min.css') }}">
</head>
<body>
<div class="error">
    <div class="error-body">
        <h1 class="error-heading"><b>{{ $title }}</b></h1>
        <h4 class="error-subheading">Untuk masuk ke dalam Aplikasi</h4>
        <p>
            <small>Silahkan pilih level yang anda miliki dibawah ini :</small>
        </p>
    </div>
    <div class="row" style="position: relative; top: -20px">
        @foreach($chooseRole as $r)
            @foreach($r->roleMany as $cr)
                <a class="btn btn-primary btn-pill btn-thick" id="{{ $r->id_user_level }}" href="">{{ $cr->nama_level }}</a>
            @endforeach
        @endforeach
    </div>
    <div class="error-footer">
        <p>
            <small>© {{ date('Y') }} Failda Waterpark</small>
        </p>
    </div>
</div>
<a href="{{ URL('logout') }}" class="btn btn-danger pull-right" style="margin-right: 20px"><span
        class="icon icon-sign-out"></span> Logout</a>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/elephant.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.btn-thick').click(function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                url: "{{ url('link') }}",
                type: "GET",
                data: "id=" + id,
                dataType: "JSON",
                success: function (data) {
                    if (data.status == 200) {
                        $(location).attr('href', "{{ url('dashboard') }}");
                    }
                },
            });
        });
    });
</script>
</body>
</html>
