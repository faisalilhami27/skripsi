<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/elephant.min.js') }}"></script>
<script src="{{ asset('js/application.min.js') }}"></script>
<script src="{{ asset('js/demo.min.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jquery.autocomplete.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
<script src="{{ asset('js/jquery.idle.min.js') }}"></script>
<script>
    $(document).idle({
        onIdle: function () {
            window.location = "{{ URL('logout') }}";
        },
        idle: 600000
    });
</script>
</body>
</html>
