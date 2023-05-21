<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Register Online Recruitment | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css">

</head>
<style>
    .authentication-bg .logo {
        position: relative;
        height: max-content;
        width: max-content;
        margin: auto;
    }

    .authentication-bg .logo {
        display: flex;
        align-items: center;
    }

    .authentication-bg .logo .logo-svg {
        width: 60px;
    }

    .authentication-bg .logo .logo-svg svg path {
        fill: #19199B;
    }

    .authentication-bg .logo .logo-text {
        color: #121212;
        text-align: left;
        font-size: 30px;
        margin-left: 5px;
    }

    .text-intro {
        color: #121212;
        font-size: 31px;
        margin: 10px;
    }

    .authentication-bg .form-control {
        border-color: transparent;
        background: #f7f7f7;
        color: #121212 !important;
        font-weight: 500;
        border-radius: 10px;
        height: 40px;
    }

    .authentication-bg .btn.btn-submit {
        border-radius: 20px;
        border-color: transparent;
        background-color: #000000;
        color: #ffffff;
        text-align: center;
        height: 40px;
    }

    .authentication-bg .text-separation {
        font-size: 16px;
        color: #121212;
        position: relative;
        font-weight: 500;
        margin: 0 10px;
    }

    .separation-block {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
    }

    .separation-block .separation-item {
        flex: 2;
        width: 100%;
        height: 2px;
        display: block;
        border-radius: 20px;
        background-color: #ebebeb;
    }

    .o-auth.social-item {
        padding: 10px 20px;
        background: #f7f7f7;
        border-radius: 20px;
        width: 180px;
        height: 40px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        color: #121212;
    }

    .o-auth.social-item i {
        font-size: 20px;
        margin-right: 5px;
    }
    .form-wrap {
        margin: 20px 0;
    }
    .auth-title {
        position: relative;
        padding-left: 10px;
        margin: 20px 0;
        color: #121212;
    }
    .auth-title::before {
        content: '';
        position: absolute;
        height: 100%;
        width: 3px;
        background-color: #19199B;
        left: 0;
        border-radius: 10px;
    }
</style>
<body class="authentication-bg pb-0">

<div class="wrapper">
    <div class="auth-form d-flex justify-content-center align-items-center">
        <div class="card w-50 my-4 px-4">
            <div class="card-header border-bottom-0 text-center">
                <!-- title-->
                <div class="logo">
                    <div class="logo-svg">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.496 9.026c-2.183-.93-5.116-1.53-8.25-1.695-.5-.03-.987-.04-1.45-.04 2.318-2.83 4.802-4.73 6.437-4.79.322-.013.595.055.813.196.706.458.905 1.768.545 3.59-.04.25.12.493.36.54.25.05.49-.11.54-.36.45-2.28.12-3.846-.94-4.538-.38-.248-.84-.365-1.35-.346-2.05.077-4.94 2.3-7.59 5.72-1.154.035-2.24.13-3.232.287-.646-2.897-.39-4.977.594-5.477.138-.073.285-.11.457-.124.697-.054 1.66.395 2.71 1.27.194.16.486.14.646-.06a.458.458 0 0 0-.06-.645C9.466 1.51 8.304 1 7.354 1.07a2.244 2.244 0 0 0-.803.22c-1.19.607-1.67 2.327-1.37 4.838.07.52.16 1.062.29 1.62C2.19 8.404.1 9.718.01 11.372c-.06 1.17.865 2.284 2.68 3.222a.46.46 0 1 0 .42-.816C1.66 13.032.88 12.19.927 11.42c.05-1.08 1.772-2.19 4.76-2.78.27.994.62 2.032 1.05 3.09-1.018 1.888-1.756 3.747-2.137 5.4-.56 2.465-.26 4.22.86 4.948.36.234.78.35 1.247.35.935 0 2.067-.46 3.347-1.372a.458.458 0 1 0-.53-.746c-1.544 1.103-2.844 1.472-3.562 1.003-.76-.495-.926-1.943-.46-3.976.32-1.386.907-2.93 1.708-4.52.2.438.41.876.63 1.313 1.425 2.796 3.17 5.227 4.91 6.845 1.386 1.29 2.674 1.963 3.735 1.963.35 0 .68-.075.976-.223 1.145-.585 1.64-2.21 1.398-4.575-.224-2.213-1.06-4.91-2.354-7.6a.46.46 0 0 0-.83.396c2.69 5.602 2.88 10.19 1.37 10.96-1.59.813-5.424-2.355-8.39-8.18-.34-.655-.637-1.3-.9-1.93.34-.608.7-1.22 1.095-1.83.395-.604.806-1.188 1.224-1.745h.394c.54 0 1.126.01 1.734.048 6.53.343 10.975 2.56 10.884 4.334-.04.765-.924 1.538-2.425 2.12a.464.464 0 0 0-.26.596.455.455 0 0 0 .593.262c1.905-.74 2.95-1.756 3.01-2.93.07-1.33-1.17-2.61-3.5-3.6v-.01zM8.08 9.45c-.27.415-.52.827-.764 1.244a23.66 23.66 0 0 1-.723-2.215c.713-.11 1.485-.19 2.31-.24-.28.39-.554.794-.82 1.21v-.01zm3.925 1.175a1.375 1.375 0 1 0 0 2.75 1.375 1.375 0 1 0 0-2.75z"
                                fill="#5013D7" class="fill-000000"></path>
                        </svg>
                    </div>
                    <h1 class="logo-text d-none">IT<br>Recruitment</h1>
                </div>
                <h4 class="text-intro mb-2">{{__('auth.authWelcome')}}</h4>
                <p class="text-muted mx-1 mb-0 font-18">{{__('auth.freeSignUp')}}</p>
                <p class="text-muted mb-0">{{__('auth.dontHaveAccountText')}}</p>
            </div>
            <div class="card-body pt-0">
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
                    <div class="form-wrap bock-account">
                        <h4 class="auth-title">Tài khoản</h4>
                        <div class="form-group">
                            <label for="email">{{__('frontPage.emailAddress')}} (*)</label>
                            <input class="form-control" type="email" id="email" placeholder="{{__('auth.enterEmail')}}"
                                   name="email" value="{{old('email')}}">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">{{__('frontPage.password')}} (*)</label>
                            <input class="form-control" type="password" id="password" placeholder="{{__('auth.enterPassword')}}"
                                   name="password" value="{{old('password')}}">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{__('frontPage.passwordConfirmation')}} (*)</label>
                            <input class="form-control" type="password" id="password_confirmation"
                                   name="password_confirmation" placeholder="{{__('auth.enterPassword')}}"
                                   value="{{old('password_confirmation')}}">
                            <span class="form-message"></span>
                        </div>
                    </div>
                    <div class="form-wrap bock-user-info">
                        <h4 class="auth-title">Thông tin nhà tuyển dụng</h4>
                        <div class="form-row justify-content-between">
                            <div class="form-group col-md-6 col-sm-12 ">
                                <label for="fullname">{{__('frontPage.formFullName')}} (*)</label>
                                <input class="form-control" type="text" id="fullname" placeholder="{{__('auth.enterName')}}"
                                       name="name" value="{{old('name')}}">
                                <span class="form-message"></span>
                            </div>
                            <div class="col-offset-3 col-empty"></div>
                            <div class="form-group col-md-3 col-sm-12 align-self-center">
                                <label class="d-block" >{{__('auth.gender')}} (*)</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="gender-male"
                                           name="gender"
                                           class="custom-control-input"
                                           value="0"
                                    >
                                    <label class="custom-control-label" for="gender-male">
                                        {{ __('frontPage.male') }}
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="gender-female"
                                           name="gender"
                                           class="custom-control-input"
                                           value="0"
                                    >
                                    <label class="custom-control-label" for="gender-female">
                                        {{ __('frontPage.female') }}
                                    </label>
                                </div>
                                <span class="form-message d-block"></span>
                            </div>
                        </div>
                            <input type="hidden" name="role" value="{{$role}}">
                        <div class="form-group">
                            <label for="phone">{{__('auth.hrPhone')}} (*)</label>
                            <input class="form-control" type="text" id="phone" placeholder="{{__('auth.hrPhone')}}"
                                   name="phone" value="{{old('phone')}}">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="company-name">{{__('auth.labelFirmName')}} (*)</label>
                            <input class="form-control" type="text" id="company-name" placeholder="{{__('auth.firmName')}}"
                                   name="company_name" value="{{old('company_name')}}">
                            <span class="form-message"></span>
                        </div>
                       <div class="form-row">
                           <div class="form-group col-md-6 col-sm-12">
                               <label for="select-provinces">{{__('auth.workLocation')}} (*)</label>
                               <select class="form-control select2" id="select-provinces"
                                       name="city" data-toggle="select2"></select>
                               <span class="form-message"></span>
                           </div>
                           <div class="form-group col-md-6 col-sm-12">
                               <label for="select-district">{{__('auth.district')}} (*)</label>
                               <select class="form-control select2" id="select-district"
                                       name="district" data-toggle="select2"></select>
                               <span class="form-message"></span>
                           </div>
                       </div>
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block btn-submit mt-3" type="submit">
                            {{__('auth.signUp')}}
                        </button>
                    </div>
                </form>
                <!-- end form-->
            </div>
            <div class="card-footer border-0 text-center">
                <p class="text-muted mb-0">{{__('auth.alreadyAccountText')}} <a href="{{'login'}}" class="text-muted ml-1">
                        <b>{{__('auth.login')}}</b></a>
                </p>
            </div>
        </div>
    </div>
</div>


<!-- end auth-fluid-->
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('js/helper.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    handleLocation.start();

</script>
<script type="module">
    import Validator from "{{asset('js/validator.js')}}";
    document.addEventListener('DOMContentLoaded', function () {
        // config js
        Validator({
            form: '#register-form',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#fullname', 'Vui lòng nhập tên đầy đủ của bạn'),
                Validator.isRequired('#email'),
                Validator.isRequired('#phone'),
                Validator.isPhoneNumber('#phone'),
                Validator.isRequired('#company-name'),
                Validator.isRequired('#password'),
                Validator.isRequired('#password_confirmation'),
                Validator.isPassWord('#password'),
                Validator.isRequired('input[name="gender"]'),
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
