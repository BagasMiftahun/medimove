<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Title-->
        <title>Login | Admin Dashboard</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}">

            <!-- Core css -->
        <link href="{{ asset('assets/css/app.min.css')}}" rel="stylesheet">

    </head>
    <body>
        <div class="app">
            <div class="container-fluid">
                <div class="d-flex full-height p-v-15 flex-column justify-content-between">
                    <div class="d-none d-md-flex p-h-40">
                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="">
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="m-t-20">Sign In</h2>
                                        <p class="m-b-30">Enter your credential to get access</p>
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show">
                                                @foreach ($errors->all() as $error)                                                
                                                    <p>{{ $error }}</p>
                                                @endforeach 
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="userName">Username:</label>
                                                <div class="input-affix">
                                                    <i class="prefix-icon anticon anticon-user"></i>
                                                    <input type="text" class="form-control" name="name" id="userName" placeholder="Username" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="password">Password:</label>
                                                <div class="input-affix">
                                                    <i class="prefix-icon anticon anticon-lock"></i>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <button class="btn btn-primary">Sign In</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="offset-md-1 col-md-6 d-none d-md-block">
                                <img class="img-fluid" src="{{ asset('assets/images/others/login-2.png') }}" alt="">
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
