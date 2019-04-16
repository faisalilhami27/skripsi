<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/elephant.min.js') }}"></script>
<script src="{{ asset('js/application.min.js') }}"></script>
<script src="{{ asset('js/demo.min.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jquery.autocomplete.min.js') }}"></script>
<script src="//js.pusher.com/4.4/pusher.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
<script src="{{ asset('js/jquery.idle.min.js') }}"></script>
<script>
    $(document).ready(function () {
        load_unseen_notification();
    });

    var appKey = '{{ env('PUSHER_APP_KEY') }}';
    var pusher = new Pusher(appKey, {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel1');
    channel.bind('my-event1', function (data) {
        load_unseen_notification();
    });

    $('#level').change(function (e) {
        e.preventDefault();
        var id = $(this).val();
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
                        var images = "";
                        if (obj[i].pemesanan_tiket.customer.images == null) {
                            images = "{{ asset('storage/img/avatar.png') }}";
                        } else {
                            images = obj[i].pemesanan_tiket.customer.images;
                        }
                        hasil += '<a class="list-group-item" href="{{ URL('konfirmasi') }}">\n' +
                            '                                        <div class="notification">\n' +
                            '                                            <div class="notification-media">\n' +
                            '\t\t\t\t\t\t\t\t\t\t\t\t<span><img src="'+ images + '" class="circle sq-40" alt=""></span>\n' +
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
