<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Register | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css">

</head>

<body class="authentication-bg pb-0">


<div class="wrapper">
    <div class="auth-form d-flex justify-content-center align-items-center">
        <div class="card w-50">
            <div class="card-header">
                <!-- title-->
                <h4 class="mt-0">Free Sign Up</h4>
                <p class="text-muted mb-0">Don't have an account? Create your account, it takes less than a minute</p>

            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- form -->
                <form action="{{ route('registering') }}" method="post" id="register-form">
                    @csrf
                    @auth
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input id="fullname" name="name" class="form-control" type="text"
                                   value="{{ auth()->user()->name }}">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input id="email" class="form-control" name="email" type="email"
                                   value="{{ auth()->user()->email }}">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label>Avatar</label>
                            <img src="{{ auth()->user()->avatar }}" class="rounded-circle" width="32">
                        </div>
                    @endauth
                    @guest
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input class="form-control" type="text" id="fullname" placeholder="Enter your name"
                                   name="name">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input class="form-control" type="email" id="email" placeholder="Enter your email"
                                   name="email">
                            <span class="form-message"></span>
                        </div>
                    @endguest
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" id="password" placeholder="Enter your password"
                               name="password">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Password</label>
                        <input class="form-control" type="password" id="password_confirmation"
                               placeholder="Enter your password" name="password_confirmation">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        @foreach($roles as $role => $val)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="{{ $role }}"
                                       name="role"
                                       class="custom-control-input"
                                       value="{{ $val }}"
                                >
                                <label class="custom-control-label" for="{{ $role }}">
                                    {{ __('frontPage.' . $role) }}
                                </label>
                            </div>
                        @endforeach
                        <span class="form-message d-block"></span>
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-account-circle"></i>
                            Sign Up
                        </button>
                    </div>
                </form>
                <!-- end form-->
            </div>
            <div class="card-footer text-center">
                <p class="text-muted mb-0">Already have account? <a href="{{'login'}}" class="text-muted ml-1"><b>Log
                            In</b></a></p>
                <span class="font-weight-semibold">Or </span> <br>
                <p class="text-muted font-16">Log in with</p>
                <ul class="social-list list-inline mt-1">
                    <li class="list-inline-item">
                        <a href="{{ route('auth.redirect', 'github') }}" class="social-list-item border-info text-info"><i
                                class="mdi mdi-github-circle"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('auth.redirect', 'gitlab') }}" class="social-list-item border-info text-info"><i
                                class="mdi mdi-gitlab"></i></a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>


<!-- end auth-fluid-->

<!-- bundle -->
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{asset('js/validator.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // config js
        Validator({
            form: '#register-form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ của bạn'),
                Validator.isRequired('#email'),
                Validator.isRequired('#password'),
                Validator.isRequired('#password_confirmation'),
                Validator.isPassWord('#password'),
                Validator.isRequired('input[name="role"]'),
                Validator.isEmail('#email'),
                Validator.minLength('#password', 8),
                Validator.isConfirmed('#password_confirmation', function () {
                    return document.querySelector('#register-form #password').value;
                }, 'Mật khẩu nhập lại không chính xác')
            ],
        });
    });
</script>

</body>

</html>
