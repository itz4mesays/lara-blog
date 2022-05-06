<!DOCTYPE html>
<html lang="en">

<head>
    @include('inc._metatags')
    <title> {{ config('app.name') }} - @yield('title') </title>
    <script>
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelector('body').classList.add('loaded');
            }, 300);
        });
    </script>

    <link rel="icon" href="{{ asset('img/brand/favicon.png') }}" type="image/png"><!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quick-website.css') }} " id="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }} " id="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- Navbar -->
    @include('inc._navbar')

    @include('inc._alert')

    @yield('content') <!-- Main content -->

    {{-- @include('inc._footer') --}}

    <!-- Core JS  -->
    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ asset('libs/svg-injector/dist/svg-injector.min.js') }}"></script>
    <script src="{{ asset('libs/feather-icons/dist/feather.min.js') }}"></script>
    <!-- Quick JS -->
    <script src="{{ asset('js/quick-website.js') }}"></script>
    <script src="{{asset('js/custom.js')}}"></script>

    <!-- Feather Icons -->
    <script>
        feather.replace({
            'width': '1em',
            'height': '1em'
        })

    </script>
</body>

</html>
