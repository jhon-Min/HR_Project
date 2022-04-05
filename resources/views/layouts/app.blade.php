<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

    {{-- Date Range Picker --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    {{-- Seletct 2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head')
</head>

<body class="bg-light">

    <div class="header-menu shadow py-3 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="d-flex justify-content-between">
                        <a href="">

                        </a>
                        <h4 class="font-weight-bold">@yield('banner', 'Ninja HR')</h4>
                        <a href=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4">
        @yield('content')
    </div>

    <div class="bottom-menu position-fixed bg-white border-top py-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col col-md-8">
                    <div class="d-flex justify-content-between">
                        <x-bottom-item link="{{ route('home') }}" icon="fa-solid fa-house">Home</x-bottom-item>

                        <x-bottom-item link="{{ route('attendance-scan') }}" icon="fa-solid fa-clipboard-list">Your
                            Attendance</x-bottom-item>

                        <a href="http://" class="text-dark">
                            <i class="fa-solid fa-briefcase"></i>
                            <br>
                            <span>Your Projects</span>
                        </a>

                        <x-bottom-item link="{{ route('user-profile.profile') }}" icon="fa-solid fa-user">Profile
                        </x-bottom-item>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.sidebar')

    <!-- JQuery -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js">
    </script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

    <!-- Datatable JavaScript -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>

    <!-- Datarange Picker JavaScript -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {{-- Select 2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('vendor/larapass/js/larapass.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/dtable.js') }}"></script>
    @yield('script')
    <script>
        $('.select-custom-multiple').select2({
            placeholder: '-- Please Choose --',
        });
    </script>

    @auth
        @include('layouts.toast')

        @include('layouts.create-alert')
    @endauth
</body>

</html>
