<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{ asset('css/application.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <style>
        /* scroller browser */
        ::-webkit-scrollbar {
            width: 7px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #a6a5a5;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
        }

        ::-webkit-scrollbar-thumb:window-inactive {
            background: rgba(0, 0, 0, 0.4);
        }
    </style>
</head>
<body class="layout layout-header-fixed layout-sidebar-fixed">
<div class="layout-header">
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <a class="navbar-brand navbar-brand-center">
                <span style="color: #fff; font-family: Water">Failda Waterpark</span>
            </a>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse"
                    data-target="#sidenav">
                <span class="sr-only">Toggle navigation</span>
                <span class="bars">
              <span class="bar-line bar-line-1 out"></span>
              <span class="bar-line bar-line-2 out"></span>
              <span class="bar-line bar-line-3 out"></span>
            </span>
                <span class="bars bars-x">
              <span class="bar-line bar-line-4"></span>
              <span class="bar-line bar-line-5"></span>
            </span>
            </button>
            <button class="navbar-toggler visible-xs-block collapsed" type="button" data-toggle="collapse"
                    data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="arrow-up"></span>
                <span class="ellipsis ellipsis-vertical">
              <img class="ellipsis-object" width="32" height="32"
                   src="{{ asset('storage/img/' . Session::get('images')) }}"
                   alt="Teddy Wilson">
            </span>
            </button>
        </div>
        <div class="navbar-toggleable">
            <nav id="navbar" class="navbar-collapse collapse">
                <button class="sidenav-toggler hidden-xs" title="Collapse sidenav ( [ )" aria-expanded="true"
                        type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="bars">
                <span class="bar-line bar-line-1 out"></span>
                <span class="bar-line bar-line-2 out"></span>
                <span class="bar-line bar-line-3 out"></span>
                <span class="bar-line bar-line-4 in"></span>
                <span class="bar-line bar-line-5 in"></span>
                <span class="bar-line bar-line-6 in"></span>
              </span>
                </button>
                <ul class="nav navbar-nav navbar-right">
                    <li class="visible-xs-block">
                        <h4 class="navbar-text text-center">Hi, Teddy Wilson</h4>
                    </li>
                    <li class="dropdown oces">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true">
                          <span class="icon-with-child hidden-xs">
                            <span class="icon icon-bell-o icon-lg"></span>
                            <span class="badge badge-primary badge-above right notif"></span>
                          </span>
                            <span class="visible-xs-block">
                            <span class="icon icon-bell icon-lg icon-fw"></span>
                            <span class="badge badge-primary pull-right badge-notif"></span>
                            Notifications
                          </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                            <div class="dropdown-header">
                                <h5 class="dropdown-heading">Notifikasi masuk</h5>
                            </div>
                            <div class="dropdown-body">
                                <div class="list-group list-group-divided custom-scrollbar">

                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown hidden-xs">
                        <button class="navbar-account-btn" data-toggle="dropdown" aria-haspopup="true">
                            <img class="circle" width="36" height="36"
                                 src="{{ asset('storage/img/'. Session::get('images'))}}"
                                 alt="test"> {{ Session::get('nama_lengkap') }}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="navbar-upgrade-version"> Version {{ versionApp() }}</li>
                            <li class="divider"></li>
                            <li><a href="{{ URL('profile') }}">Profile</a></li>
                            <li><a href="{{ URL('logout') }}">Sign out</a></li>
                        </ul>
                    </li>
                    <li class="visible-xs-block">
                        <a href="{{ URL('profile') }}">
                            <span class="icon icon-user icon-lg icon-fw"></span>
                            Profile
                        </a>
                    </li>
                    <li class="visible-xs-block">
                        <a href="{{ URL('logout') }}">
                            <span class="icon icon-power-off icon-lg icon-fw"></span>
                            Sign out
                        </a>
                    </li>
                    <li class="visible-xs-block">
                        <a href="contacts.html">
                            <span class="icon icon-level-up icon-lg icon-fw"></span>
                            Version
                        </a>
                    </li>
                </ul>
                <div class="title-bar">
                    <h1 class="title-bar-title">
                        <span class="d-ib">{{ $title }}</span>
                        <span class="d-ib">
                </span>
                    </h1>
                    <p class="title-bar-description">
                        <small>{{ $deskripsi }}</small>
                    </p>
                </div>
            </nav>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        load_unseen_notification();
        $(".dropdown-toggle").click(function (e) {
            e.preventDefault();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                url: "{{ URL('dashboard/update') }}",
                type: "PUT",
                dataType: 'json',
                success: function () {
                    $('.badge-notif, .notif').html('');
                },
                error: function (xhr, status, error) {
                    alert(status + " : " + error);
                }
            });
        });
    });

    function load_unseen_notification() {
        $.ajax({
            url: "{{ URL('dashboard/notif') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                var hasil = '';
                for (var i = 0; i < data.notification.length; i++) {
                    var obj = $.parseJSON(JSON.stringify(data.notification));
                    hasil += '<a class="list-group-item" href="#">\n' +
                        '                                        <div class="notification">\n' +
                        '                                            <div class="notification-media">\n' +
                        '\t\t\t\t\t\t\t\t\t\t\t\t<span><img src="{{ config('constants.URL') }}' + "/assets/img/" + obj[i].customer.images + '" class="circle sq-40" alt=""></span>\n' +
                        '                                            </div>\n' +
                        '                                            <div class="notification-content">\n' +
                        '                                                <small class="notification-timestamp">' + obj[i].tgl_pemesanan + '</small>\n' +
                        '                                                <h5 class="notification-hea ding">' + obj[i].customer.nama + '</h5>\n' +
                        '                                                <p class="notification-text">\n' +
                        '                                                    <small class="truncate">Dengan kode transaksi ' + obj[i].kode_pemesanan + ' \n' +
                        '                                                        melalui aplikasi mobile \n' +
                        '                                                    </small>\n' +
                        '                                                </p>\n' +
                        '                                            </div>\n' +
                        '                                        </div>\n' +
                        '                                    </a>';
                }
                $('.list-group').html(hasil);
                if (data.unseen_notification > 0) {
                    $('.badge-notif, .notif').html(data.unseen_notification);
                }
                setTimeout(load_unseen_notification, 10000);
            }
        });
    }
</script>

