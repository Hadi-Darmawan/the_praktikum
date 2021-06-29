<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="{{ asset('the_praktikum.ico') }}">
        <title>@yield('title')</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        
        @stack('css')

        <style>
            html, body {
                font-family: 'Nunito', sans-serif;
                font-weight: 300;
            }
            .swal-footer {
                text-align: center;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
        <div class="wrapper">
            {{-- Navbar Start --}}
                @include('layouts/navbar-layout')
            {{-- Navbar End --}}

            {{-- Sidebar Container Start --}}
                @include('layouts/sidebar-layout')
            {{-- Sidebar Container End --}}

            {{-- Content Start --}}
                @include('layouts/content-layout')
            {{-- Content End --}}

            {{-- Footer Start --}}
                @include('layouts/footer-layout')
            {{-- Footer End --}}
        </div>

        <!-- jQuery -->
        <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('template/dist/js/adminlte.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        
        <script>
        function alertSuccess(msg){
            Swal.fire({
                title: "Sukses",
                text: msg,
                icon: "success",
                button: "Ok",
            });
        }

        function alertError(msg){
            Swal.fire({
                title: "Eror",
                text: msg,
                icon: "warning",
                button: "Ok",
            });
        }

        function alertDanger(msg){
            Swal.fire({
                title: "Peringatan",
                text: msg,
                icon: "error",
                button: "Ok",
            });
        }

        // JS bawaan dari Bootstrap 5 untuk melakukan realtime validation ketika form required
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        </script>

        @stack('js')
    </body>
</html>
