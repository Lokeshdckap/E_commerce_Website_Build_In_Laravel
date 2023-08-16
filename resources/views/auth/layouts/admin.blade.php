<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="{{ asset('admin/css/material-dashboard.css?v=3.1.0') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
          @include('auth.layouts.inc.sidebar')

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            @include('auth.layouts.inc.adminnav')

        <div class="container-fluid py-4">
        @yield('container-fluid py-4')
       </div>

            @include('auth.layouts.inc.adminfooter')
        </main>
    </div>
    {{-- Script --}}
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/chartjs.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
    <script>
     swal("{{session('status')}}");
    </script>
    @endif
    @yield('scripts')
</body>

</html>
