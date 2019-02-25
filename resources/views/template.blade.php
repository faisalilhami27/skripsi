@include('layouts.header')
@include('layouts.sidebar')
@yield('content')
<div class="layout-footer">
    <div class="layout-footer-body">
        <small class="version"> Version {{ versionApp() }}</small>
        <small class="copyright"><?= date('Y') ?> &copy; Failda Waterpark <a href="https://laravel.com" target="_blank">Powered By Laravel 5.7</a></small>
    </div>
</div>
</div>
@include('layouts.footer')

