<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Title-->
        <title>@yield('title', 'Admin Dashboard')</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">

            <!-- Core css -->
        <link href="{{ asset('assets/css/app.min.css')}}" rel="stylesheet">

        {{-- style --}}
        @yield('style')

    </head>
    <body>
        <div class="app">
            <div class="layout">
                <!-- Header START -->
                @include('theme.partials.header')
                
                <!-- Header END -->
    
                <!-- Side Nav START -->
                @include('theme.partials.sidebar')
                <!-- Side Nav END -->
    
                <!-- Page Container START -->
                <div class="page-container">
                    
    
                    <!-- Content Wrapper START -->                    
                    @yield('content')
                    <!-- Content Wrapper END -->
    
                    <!-- Footer START -->
                    @include('theme.partials.footer')
                    <!-- Footer END -->
    
                </div>
                <!-- Page Container END -->
    
                <!-- Search Start-->
                @include('theme.partials.search')
                <!-- Search End-->
    
                <!-- Quick View START -->
                @include('theme.partials.quickview')
                <!-- Quick View END -->

                <!-- Modal Start -->
                {{-- <div class="modal fade" id="LogoutModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Logout</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to log out?
                            </div>
                            <div class="modal-footer">
                                <!-- Tombol untuk menutup modal -->
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <!-- Form logout -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf <!-- Atur csrf token -->
                                    <button type="submit" class="btn btn-primary">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Modal End -->
            </div>
        </div>

            <!-- Core Vendors JS -->
        <script src="{{ asset('assets/js/vendors.min.js') }}"></script>

        <!-- page js -->
        <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/dashboard-default.js') }}"></script>

        <!-- Core JS -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

        {{-- script --}}
        @yield('script')
    </body>
</html>
