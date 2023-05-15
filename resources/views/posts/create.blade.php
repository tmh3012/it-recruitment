@extends('layout.master')
{{--@push('css')--}}
{{--    <link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" type="text/css"/>--}}
{{--@endpush--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Form Post -->
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('api.posts.store') }}" class="form-horizontal"
                          id="fmCreate-Post"
                          enctype="multipart/form-data" redirect="true">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Company</label>
                            <select class="form-control select2" id="select-company" name="company"
                                    data-toggle="select2"></select>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Language</label>
                            <select class="select2 form-control select2-multiple" id="select-language"
                                    name="languages[]"
                                    data-toggle="select2" multiple="multiple" data-placeholder="Choose ..."></select>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label class="form-label">Provinces/City (*)</label>
                                        <select class="form-control select2" id="select-provinces" name="city"
                                                data-toggle="select2"></select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="form-label">District</label>
                                        <select class="form-control select2" id="select-district" name="district"
                                                data-toggle="select2">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label class="form-label">Min salary </label>
                                    <input class="form-control mr-1" min="0" placeholder="min-salary"
                                           autocomplete="off" name="min_salary" type="number">
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-label">Max salary </label>
                                    <input class="form-control" min="0" placeholder="max-salary" autocomplete="off"
                                           name="max_salary" type="number">
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group col-4">
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label class="form-label">Currency</label>
                                            <select class="form-control" name="currency_salary" id="currency">
                                                @foreach ($currencies as $currency => $value)
                                                    <option value="{{ $value }}">{{ $currency }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-message"></span>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Work place</label>
                                            <select name="remote" id="" class="form-control">
                                                @foreach ($workPlaces as $key => $value)
                                                    <option value="{{ $value }}">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column col-4">
                                            <label class="form-label">Can part-time</label>
                                            <input type="checkbox" id="part-time" name="can_parttime"
                                                   data-switch="bool"/>
                                            <label class="mb-0 mt-1" for="part-time" data-on-label="Yes"
                                                   data-off-label="No"></label>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-8 col-sm-12" id="datepicker1">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label class="form-label">Start date</label>
                                        <input type="date" class="form-control" name="start_date">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" name="end_date">
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label">Number of applicants</label>
                                <input class="form-control" type="number" name="number_applicants" autocomplete="off"
                                       placeholder="Number of applicants">
                                <span class="form-message"></span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="floatingTextarea">Job description</label>
                            <textarea class="form-control ckeditor" name="job_description"
                                      placeholder="Leave a comment here"
                                      id="floatingTextarea" style="height: 250px;"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="floatingTextarea">Job requirements</label>
                            <textarea style="height: 250px;" class="form-control ckeditor" id="ckeditor1"
                                      name="job_requirement"
                                      placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="floatingTextarea3">Job benefit</label>
                            <textarea class="form-control ckeditor" name="job_benefit"
                                      placeholder="Leave a comment here" id="floatingTextarea3"
                                      style="height: 250px;"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Title</label>
                                    <input class="form-control" name="job_title" type="text" autocomplete="off">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Slug</label>
                                    <input class="form-control" name="slug" type="text" autocomplete="off">
                                    <span class="form-message"></span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btn-sb-form" disabled class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="company-modal" data-backdrop="static" tabindex="-1" role="dialog"
                 aria-labelledby="companyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header align-items-center bg-primary">
                            <div class="moodal-header__left">
                                <h4 class="modal-title text-dark text-uppercase" id="companyModalLabel">Create Your
                                    Company</h4>
                                <p class="text-dark">Your company doesn't exist in our system.
                                    Do you want to create it?</p>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="creat-company" action="{{ route('api.company.store') }}" method="post"
                                  id="fmCreate-Company" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <input type="text" name="name" id="company" readonly
                                           class="form-control border-primary">
                                    <span class="form-message"></span>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label class="form-label">Provinces/City (*)</label>
                                        <select type="text" id="city" name="city"
                                                class="form-control select2" data-toggle="select2"></select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">District</label>
                                        <select type="text" name="district" id="district"
                                                class="form-control select2" data-toggle="select2"></select>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                               autocomplete="off">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">Address2</label>
                                        <input type="text" name="address2" class="form-control" autocomplete="off">
                                        <span class="form-message"></span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-4">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone"
                                               autocomplete="off">
                                        <span class="form-message"></span>

                                    </div>
                                    <div class="form-group col-4">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                               autocomplete="off">
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Website</label>
                                        <input type="text" name="link" class="form-control"
                                               placeholder="Link website of your company" autocomplete="off">
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <lable>Overview</lable>
                                    <textarea name="over_view" id="over_view" class="form-control"></textarea>
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <lable>Mission</lable>
                                    <textarea name="mission" class="form-control ckeditor"></textarea>
                                </div>
                                <div class="form-group">
                                    <lable>Introduction</lable>
                                    <textarea name="introduction" class="form-control ckeditor"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Logo</label>
                                        <div class="d-flex">
                                            <input type="file" name="logo" id=""
                                                   class="form-control w-50 mr-1"
                                                   oninput="pic_logo.src=window.URL.createObjectURL(this.files[0])">
                                            <img height="100px" id="pic_logo"/>
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Cover</label>
                                        <div class="d-flex">
                                            <input type="file" name="cover" id=""
                                                   class="form-control w-50 mr-1"
                                                   oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                            <img height="100px" id="pic"/>
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"> Create</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        handleLocation.start();


        // form validator
        document.addEventListener('DOMContentLoaded', function () {

            // form creat new company
            Validator({
                form: '#fmCreate-Post',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#select-company', 'Vui lòng nhập tên công ty của bạn'),
                ],
                onSubmit: function () {
                    checkCompany();
                }
            });

            // form creat new company
            Validator({
                form: '#fmCreate-Company',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#company', 'Vui lòng nhập tên công ty của bạn'),
                    Validator.isRequired('#phone'),
                    Validator.isPhoneNumber('#phone'),
                    Validator.isRequired('#email', 'Vui lòng nhập địa chỉ email'),
                    Validator.isEmail('#email'),
                    Validator.isRequired('#address',),
                    Validator.isRequired('#over_view'),
                ],
                onSubmit: function () {
                    submitForm(this.form)
                }
            });
        });


        $(document).ready(function () {
            function generateTitle() {
                let languages = [];
                $("#select-language :selected").map(function (i, v) {
                    languages.push($(v).text());
                });
                languages = languages.join(', ');
                const company = $('#select-company').val();
                const city = $('#select-provinces :selected').val();

                let title = `(${city}) ${languages}`;
                if (company) {
                    title += ' - ' + company;
                }
                $('input[name="job_title"]').val(title)
                generateSlug(title)
            }

            $('#fmCreate-Post').on('change', '#select-company, #select-language,#select-provinces', function () {
                generateTitle();
            })
            $('input[name="title"]').change(function (e) {
                let title = $(this).val();
                if (title) {
                    generateSlug(title);
                }
            });

            function generateSlug(title) {
                $.ajax({
                    url: '{{ route('api.posts.slug.generate') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        title
                    },
                    success: function (response) {
                        $('input[name="slug"]').val(response.data);
                        $('input[name="slug"]').trigger("change");
                    }
                })
            }

            $("input[name='slug']").change(function () {
                $("#btn-sb-form").attr('disabled', true);
                $.ajax({
                    url: '{{ route('api.posts.slug.check') }}',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        slug: $(this).val()
                    },
                    success: function (response) {
                        if (response.success) {
                            $("#btn-sb-form").attr('disabled', false);
                        }
                    }
                })
            })
            loadDataForSelect2('{{ route('api.companies') }}','#select-company');
            loadDataForSelect2('{{ route('api.languages') }}','#select-language');
        });

        function checkCompany() {
            $.ajax({
                url: '{{ route('api.companies.check') }}/' + $('#select-company').val(),
                type: 'GET',
                dataType: 'JSON',
                success: function (response) {
                    if (response) {
                        submitForm('#fmCreate-Post');
                    } else {
                        $('#company').val($('#select-company').val());
                        $("#city").val($("#select-provinces").val()).trigger('change');
                        $("#company-modal").modal();
                    }
                }
            })
        }

        function submitForm(type) {
            const form = $(type);
            let formData = new FormData(form[0]);
            let redirect = form.attr('redirect');
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
                    if (response.success) {
                        $("#company-modal").modal('hide');
                        notifySuccess();
                        if (redirect) {
                            @if (isAdmin())
                                window.location.href = '{{ route('admin.posts.index') }}'
                            @elseif (isHr())
                                window.location.href = '{{ route('hr.posts.index') }}'
                            @endif ()
                        }
                    } else {
                        console.log(response)
                        notifyError();
                    }
                },
                error: function (response) {
                    console.log(response);
                    let errors = response.responseJSON.errors;
                    showError(errors);
                    console.log(response.responseJSON)
                    notifyError();
                }
            });
        }

        function showError(errors) {
            Object.keys(errors).forEach(value => {
                let elShowMess;
                if (value === 'language') {
                    elShowMess = $('[name="languages[]"]~span.form-message');
                } else {
                    elShowMess = $(`[name="${value}"] ~ span.form-message`);
                }
                const mess = errors[value].join(' ');
                elShowMess.text(mess);
            });
        }
    </script>
@endpush
