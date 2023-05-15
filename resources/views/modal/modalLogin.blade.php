<div class="modal fade" id="post-apply-modal" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="companyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header flex-column bg-primary">
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="moodal-header__left align-self-center">
                    <h3 class="modal-title  text-white text-center text-uppercase"
                        id="companyModalLabel">{{__('frontPage.login')}}</h3>
                    <p class="font-16 text-center text-white ">{{__('frontPage.desForAccessAcc')}}</p>
                </div>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('handlerLogin')}}" class="mb-3 mx-auto w-75" id="login-form">
                    <ul class="auth-error ">
                    </ul>
                    @csrf
                    <input type="hidden" name="urlReddit" value="{{url()->current()}}">
                    <div class="form-group">
                        <label for="email">{{__('frontPage.emailAddress')}}</label>
                        <input class="form-control" type="email" name="email" id="email"
                               placeholder="Enter your email">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group">
                        <a href="#" class="text-muted float-right d-none"><small>Forgot your
                                password?</small></a>
                        <label for="password">{{__('frontPage.password')}}</label>
                        <input class="form-control" type="password" name="password" id="password"
                               placeholder="Enter your password">
                        <span class="form-message"></span>
                    </div>
                    <div class="form-group mb-0 text-center">
                        <button class="btn btn-primary btn-block" type="submit"><i
                                class="mdi mdi-login"></i> {{__('frontPage.login')}}
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <p class="text-muted mb-0">Don't have an account?
                    <a href="{{route('register')}}" class="text-success ml-1">
                        <b>Register</b>
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script type="module">
        import Validator from "{{asset('js/validation.js')}}";
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
@endpush
