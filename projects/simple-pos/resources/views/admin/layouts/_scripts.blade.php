<!-- jQuery -->
<script src="{{ asset('') }}plugins/jquery/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="{{ asset('') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('') }}dist/js/adminlte.min.js"></script>
<script src="{{ asset('') }}dist/js/app.js?v={{ microtime() }}"></script>
<script>
    $(document).ready(function () {
        $(".preload").hide()
    })
</script>