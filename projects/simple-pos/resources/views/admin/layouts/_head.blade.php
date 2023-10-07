<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="base-url" content="{{ url('/') }}">
<title>{{ $setting?->application_name ?? 'SimplePos' }}</title>

<link rel="icon" href="{{ $setting->favicon }}" type="image/x-icon" />
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('') }}dist/css/adminlte.min.css">
<link rel="stylesheet" href="{{ asset('') }}plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
<style>
    .product-title {
        white-space: nowrap;
        overflow: hidden;
    }

    .navbar-nav>.user-menu>.dropdown-menu {
        width: 200px;
    }

    .loader-wrapper {
        align-items: center;
        background: #f9fafb;
        display: flex;
        height: 100vh;
        justify-content: center;
        left: 0;
        position: fixed;
        top: 0;
        width: 100vw;
        z-index: 9999
    }

    .loaded .loader-wrapper {
        opacity: 0;
        transition: all .8s ease-out;
        visibility: hidden
    }

    .loader-wrapper .loader {
        -webkit-animation: loading 1.4s linear infinite;
        animation: loading 1.4s linear infinite;
        background: #007bff;
        background: linear-gradient(90deg, #007bff 10%, transparent 42%);
        border-radius: 50%;
        font-size: 10px;
        height: 50px;
        margin: 50px auto;
        text-indent: -9999em;
        transform: translateZ(0);
        width: 50px
    }

    .loader-wrapper .loader:before {
        background: #007bff;
        border-radius: 100% 0 0 0;
        content: "";
        height: 50%;
        left: 0;
        position: absolute;
        top: 0;
        width: 50%
    }

    .loader-wrapper .loader:after {
        background: #f9fafb;
        border-radius: 50%;
        bottom: 0;
        content: "";
        height: 75%;
        left: 0;
        margin: auto;
        position: absolute;
        right: 0;
        top: 0;
        width: 75%
    }

    @-webkit-keyframes loading {
        0% {
            transform: rotate(0deg)
        }

        to {
            transform: rotate(1turn)
        }
    }

    @keyframes loading {
        0% {
            transform: rotate(0deg)
        }

        to {
            transform: rotate(1turn)
        }
    }
</style>
