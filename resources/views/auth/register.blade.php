<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset("sb-admin-assets/vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset("sb-admin-assets/css/sb-admin-2.min.css")}}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-primary">

<div style="height: 100vh;" class="container d-flex flex-column justify-content-center">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
                <div class="col-lg-5 d-flex w-100 justify-content-center align-items-center">
                    <img src="{{asset("./assets/img/budget-buddha-logo.png")}}" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="p-2">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror form-control-user" id="exampleFirstName"
                                           placeholder="{{ __('Name') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="email" type="email" class="@error('email') is-invalid @enderror form-control form-control-user" id="exampleInputEmail"
                                       placeholder="Email Address">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input name="password" type="password" class="@error('password') is-invalid @enderror form-control form-control-user"
                                           id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <input name="password_confirmation" type="password" class="form-control form-control-user"
                                           id="exampleRepeatPassword" placeholder="{{ __('Confirm Password') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="per_month_salary" type="number" class="@error('per_month_salary') is-invalid @enderror form-control form-control-user" id="exampleInputEmail"
                                       placeholder="Per month Salary">
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{asset("sb-admin-assets/vendor/jquery/jquery.min.js")}}"></script>
<script src="{{asset("sb-admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset("sb-admin-assets/vendor/jquery-easing/jquery.easing.min.js")}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset("sb-admin-assets/js/sb-admin-2.min.js")}}"></script>

</body>

</html>
