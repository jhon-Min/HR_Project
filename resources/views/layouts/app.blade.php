<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body>
    <div class="header-menu shadow py-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="d-flex justify-content-between">
                        <a href=""></a>
                        <h4 class="font-weight-bold">Ninja HR</h4>
                        <a href=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4">
        @yield('content')
    </div>

    <div class="bottom-menu position-absolute shadow py-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col col-md-8">
                    <div class="d-flex justify-content-between">
                        <a href="http://" class="text-dark">
                            <i class="fas fa-home"></i>
                            <br>
                            <span>Home</span>
                        </a>

                        <a href="http://" class="text-dark">
                            <i class="fas fa-home"></i>
                            <br>
                            <span>Home</span>
                        </a>

                        <a href="http://" class="text-dark">
                            <i class="fas fa-home"></i>
                            <br>
                            <span>Home</span>
                        </a>

                        <a href="http://" class="text-dark">
                            <i class="fas fa-home"></i>
                            <br>
                            <span>Home</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @yield('script')
</body>
</html>
