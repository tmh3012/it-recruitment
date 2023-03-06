@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h3">Create new company</span>
                </div>
                <div class="card-body">
                    <form class="creat-company" action="{{ route('admin.companies.store') }}" method="post"
                        id="fmCreate-Company" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control border-primary">
                            <span class="form-message"></span>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label class="form-label">Provinces/City (*)</label>
                                <select type="text" id="select-provinces" name="city" class="form-control select2"
                                    data-toggle="select2"></select>
                            </div>
                            <div class="form-group col-6">
                                <label class="form-label">District</label>
                                <select type="text" name="district" id="select-district" class="form-control select2"
                                    data-toggle="select2"></select>
                                <span class="form-message"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="address" autocomplete="off">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">Address2</label>
                                <input type="text" name="address2" class="form-control" autocomplete="off">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group col-4">
                                <label>Website</label>
                                <input type="text" name="link" class="form-control"
                                    placeholder="Link website of your company" autocomplete="off">
                                <span class="form-message"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    placeholder="Phone number your company" autocomplete="off">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group col-4">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Email address your company" autocomplete="off">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group col-4">
                                <label>Number of employees</label>
                                <input type="text" name="number_of_employees" class="form-control" autocomplete="off">
                                <span class="form-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <lable>Overview</lable>
                            <textarea name="over_view" class="form-control ckeditor" id="over_view"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <lable>Mission</lable>
                            <textarea name="mission" class="form-control ckeditor"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <lable>Introduction</lable>
                            <textarea name="introduction" class="form-control ckeditor"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Logo</label>
                                <div class="d-flex">
                                    <input type="file" name="logo" id="" class="form-control w-50 mr-1"
                                        oninput="pic_logo.src=window.URL.createObjectURL(this.files[0])">
                                    <img height="100px" id="pic_logo" />
                                </div>
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group col-6">
                                <label>Cover</label>
                                <div class="d-flex">
                                    <input type="file" name="cover" id="" class="form-control w-50 mr-1"
                                        oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                    <img height="100px" id="pic" />
                                </div>
                                <span class="form-message"></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        handleLocation.start();

        // form validator
        document.addEventListener('DOMContentLoaded', function() {
            // config js
            Validator({
                form: '#fmCreate-Company',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#name', 'Vui lòng nhập tên công ty của bạn'),
                    Validator.isRequired('#phone'),
                    Validator.isPhoneNumber('#phone'),
                    Validator.isRequired('#email', 'Vui lòng nhập địa chỉ email'),
                    Validator.isEmail('#email'),
                    Validator.isRequired('#address',),
                    Validator.isRequired('#over_view'),
                ],
                onSubmit: function() {
                    submitForm(this.form)
                }
            });
        });


        function submitForm(type) {
            const form = $(type);
            let formData = new FormData(form[0]);
            $.ajax({
                // url: form.attr('action'),
                url: '{{ route('admin.companies.store') }}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                enctype: 'multipart/form-data',
                success: function(response) {
                    if (response.success) {
                        notifySuccess();
                        window.location.href = '{{ route('admin.companies.index') }}'
                    } else {
                        console.log(response)
                        notifyError();
                    }
                },
                error: function(response) {
                    console.log(response);
                    let errors = response.responseJSON.errors;
                    showError(errors);
                    console.log(response.responseJSON)
                    notifyError();
                }
            });
        }
    </script>
@endpush
