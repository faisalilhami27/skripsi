<div class="layout-footer">
    <div class="layout-footer-body">
        <small class="version"> Version {{ versionApp() }}</small>
        <small class="copyright"><?= date('Y') ?> &copy; Failda Waterpark <a href="https://laravel.com" target="_blank">Powered By Laravel 5.7</a></small>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/elephant.min.js') }}"></script>
<script src="{{ asset('js/application.min.js') }}"></script>
<script src="{{ asset('js/demo.min.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jquery.autocomplete.min.js') }}"></script>
<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
<script src="{{ asset('js/jquery.idle.min.js') }}"></script>
<script>
    $(document).ready(function () {
        load_unseen_notification();
    });

    var pusher = new Pusher('ca529096e60dc5ab5a37', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel1');
    channel.bind('my-event1', function (data) {
        load_unseen_notification();
    });

    function load_unseen_notification() {
        var id = "{{ Session::get('id_user_level') }}";
        if (id == 1) {
            $.ajax({
                url: "{{ URL('dashboard/notif') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var hasil = '';
                    for (var i = 0; i < data.notification.length; i++) {
                        var obj = $.parseJSON(JSON.stringify(data.notification));
                        hasil += '<a class="list-group-item" href="{{ URL('konfirmasi') }}">\n' +
                            '                                        <div class="notification">\n' +
                            '                                            <div class="notification-media">\n' +
                            '\t\t\t\t\t\t\t\t\t\t\t\t<span><img src="'+ obj[i].pemesanan_tiket.customer.images + '" class="circle sq-40" alt=""></span>\n' +
                            '                                            </div>\n' +
                            '                                            <div class="notification-content">\n' +
                            '                                                <small class="notification-timestamp">' + obj[i].pemesanan_tiket.tgl_pemesanan + '</small>\n' +
                            '                                                <h5 class="notification-hea ding">' + obj[i].pemesanan_tiket.customer.nama + '</h5>\n' +
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
                    } else if (data.unseen_notification == 0) {
                        $('.badge-notif, .notif').html("");
                    }
                    // setTimeout(load_unseen_notification, 5000);
                }
            });
        }
    }

    $(document).idle({
        onIdle: function () {
            window.location = "{{ URL('logout') }}";
        },
        idle: 600000
    });
</script>
@stack('scripts')
@show
</body>
</html>
