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
                        id="companyModalLabel">{{__('frontPage.jobApplications')}}</h3>
                    <p class="font-16 text-center text-white ">{{$title}}</p>
                </div>
            </div>
            <div class="modal-body">
                <form class="creat-company" action="{{route('api.handlerSubmitCv')}}"
                      method="post" id="fmSubmitCV" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}">

                    @if(auth()->check())
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <div class="form-group">
                            <label for="name" class="form-label">{{__('frontPage.formFullName')}} *</label>
                            <input type="text" value="{{auth()->user()->name}}" name="name" class="form-control"
                                   id="name">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email *</label>
                            <input type="text" value="{{auth()->user()->email}}" name="email" class="form-control"
                                   id="email">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="phone-number" class="form-label">{{__('frontPage.formPhoneNumber')}} *</label>
                            <input type="text" value="{{auth()->user()->phone}}" name="phone" class="form-control"
                                   id="phone-number">
                            <span class="form-message"></span>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="name" class="form-label">{{__('frontPage.formFullName')}} *</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email *</label>
                            <input type="text" name="email" class="form-control" id="email">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="phone-number" class="form-label">{{__('frontPage.formPhoneNumber')}} *</label>
                            <input type="text" name="phone" class="form-control" id="phone-number">
                            <span class="form-message"></span>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="cover-letter" class="form-label">{{__('frontPage.formCoverLetter')}}</label>
                        <textarea name="cover_letter" rows="5" class="form-control" id="cover-letter"></textarea>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="cv">CV</label>
                            <input type="file" name="cv" id="cv" class="form-control">
                            <span class="form-message"></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{__('frontPage.btnSubmitForm')}}
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@push('js')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            // config js
            Validator({
                form: '#fmSubmitCV',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#name'),
                    Validator.isRequired('#phone-number'),
                    Validator.isPhoneNumber('#phone-number'),
                    Validator.isRequired('#email'),
                    Validator.isEmail('#email'),
                    Validator.isRequired('#cover-letter'),
                    Validator.isRequired('#cv'),
                ],
                onSubmit: function (data) {
                    submitForm(this.form)
                }
            })

        });


        function submitForm(type) {
            const form = $(type);
            let formData = new FormData(form[0]);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                enctype: 'multipart/form-data',
                success: function (response) {
                    form.trigger("reset");
                    notifySuccess('Submit successful !');
                    $('#post-apply-modal').modal('hide');
                },
                error: function (response) {
                    let data = response.responseJSON;
                    renderError(data.errors, type)
                    notifyError(`${data.message} <br/> Try again !`);
                }
            });
        }

        function renderError(errors, formSelector, formGroupSelector = '.form-group', errorSelector = '.form-message') {
            Object.keys(errors).forEach(key => {
                const formElement = document.querySelector(formSelector);
                let errorMessage = errors[key];
                let errorElement = formElement.querySelector(`[name="${key}"] ~ ${errorSelector}`);
                getParentElement(errorElement, formGroupSelector).classList.add('invalid');
                errorElement.innerHTML = errorMessage;
            })
        }
        function getParentElement(element, selector) {
            while (element.parentElement) {
                if (element.parentElement.matches(selector)) {
                    return element.parentElement;
                }
                element = element.parentElement;
            }
        }
    </script>
@endpush
