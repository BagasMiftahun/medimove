<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Title-->
        <title>503 Maintenance</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">

            <!-- Core css -->
        <link href="{{ asset('assets/css/app.min.css')}}" rel="stylesheet">

    </head>
    <body>
        <div class="app">
            <div class="container-fluid">
                <div class="d-flex full-height p-v-20 flex-column justify-content-between">
                    <div class="d-none d-md-flex p-h-40">
                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="">
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-8 m-h-auto">
                                <div class="text-center m-b-50">
                                    <img class="img-fluid w-90" src="{{ asset('assets/images/others/error-2.png') }}" alt="">
                                    <h2 class="font-weight-light font-size-30 m-t-60 m-b-20">Sorry, we're down for maintenance...</h2>
                                    <p class="w-70 lh-1-8 m-h-auto font-size-17">Unfortunately the site is down for abit of maintenance right now. But we're doing our best to get things back.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-flex  p-h-40 justify-content-between">
                        <span class="">© 2019 ThemeNate</span>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a class="text-dark text-link" href="">Legal</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-dark text-link" href="">Privacy</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

            <!-- Core Vendors JS -->
        <script src="{{ asset('assets/js/vendors.min.js') }}"></script>

        <!-- Core JS -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
    </body>
</html>