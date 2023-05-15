<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Log In | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <!-- App favicon -->
{{--    <link rel="shortcut icon" href="assets/images/favicon.ico">--}}

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
                <h4 class="mt-0">Sign In</h4>
                <p class="text-muted mb-0">Enter your email address and password to access account.</p>
            </div>
            <div class="card-body">

                <!-- form -->
                    <form method="post" action="{{route('handlerLogin')}}" id="login-form">
                        @csrf
                        <ul class="auth-error ">
                        </ul>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input class="form-control" type="email" name="email" id="email"
                                   placeholder="Enter your email">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <a href="pages-recoverpw-2.html" class="text-muted float-right d-none"><small>Forgot your
                                    password?</small></a>
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password"
                                   placeholder="Enter your password">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group mb-3 d-none">
                            <div class="custom-control custom-checkbox">
                                <input disabled type="checkbox" class="custom-control-input" id="checkbox-signin">
                                <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-login"></i> Log In
                            </button>
                        </div>
                    </form>
                <!-- end form-->
            </div>
            <div class="card-footer text-center">
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
                <span class="font-weight-semibold">Or </span> <br>
                <p class="text-muted mb-0">Don't have an account?
                    <a href="{{'register'}}" class="text-muted ml-1">
                        <b>Register</b>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- end auth-fluid-->

<!-- bundle -->
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script type="module">
    import Validator from "{{asset('js/validator.js')}}";
      document.addEventListener('DOMContentLoaded', function () {
            // config js
            Validator({
                form: '#login-form',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#email'),
                    Validator.isEmail('#email'),
                    Validator.isRequired('#password'),
                    Validator.minLength('#password', 8),
                ],
                onSubmit: function (data) {
                    let option = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    };
                    fetch("{{route('handlerLogin')}}", option)
                        .then((response) => response.json())
                        .then((response) => {
                            if (response.success) {
                                window.location.href = response.data;
                            } else {
                                authError(response.message, `${this.form} .auth-error`);
                            }
                        })
                }
            })

            function authError(message, rs) {
                let errorElement = document.querySelector(rs);
                errorElement.innerHTML = `<li>${message}</li>`;
                errorElement.classList.add('invalid');
            }
        });
</script>
</body>
</html>
