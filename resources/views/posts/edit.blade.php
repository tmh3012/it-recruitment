@extends('layout.master')
@push('css')
    <link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Form Post -->
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('admin.posts.update', $post->id)}}" class="form-horizontal"
                          id="fmCreate-Post" enctype="multipart/form-data">
                        <input type="hidden" name="redirect" value="{{route('admin.posts.index')}}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="form-label">Company</label>
                            <select class="form-control select2" id="select-company" name="company"
                                    data-toggle="select2"></select>
                            <span class="form-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Language</label>
                            <select class="select2 form-control select2-multiple" id="select-language"
                                    name="languages[]"
                                    data-toggle="select2" multiple="multiple" data-placeholder="Choose ..."></select>
                            <span class="form-message text-danger"></span>
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
                                    <input class="form-control mr-1" min="0" placeholder="min-salary" autocomplete="off"
                                           name="min_salary" value="{{$post->min_salary}}" type="number">
                                    <span class="form-message text-danger"></span>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-label">Max salary </label>
                                    <input class="form-control" min="0" placeholder="max-salary" autocomplete="off"
                                           value="{{$post->max_salary}}" name="max_salary" type="number">
                                    <span class="form-message text-danger"></span>
                                </div>
                                <div class="form-group col-4">
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label class="form-label">Currency</label>
                                            <select class="form-control" name="currency_salary" id="currency">

                                                @foreach($currencies as $currency=>$value)
                                                    <option
                                                        @if($currency === $post->enum_currency_salary)
                                                            selected
                                                        @endif
                                                        value="{{$value}}">{{$currency}}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-message text-danger"></span>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Work place</label>
                                            <select name="remote" id="" class="form-control">
                                                @foreach($workPlaces as $key => $value)
                                                    <option
                                                        @if($post->remote === $value)
                                                            selected
                                                        @endif
                                                        value="{{$value}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-flex flex-column col-4">
                                            <label class="form-label">Can part-time</label>
                                            <input type="checkbox" id="part-time" name="can_parttime"
                                                   @if($post->can_parttime)
                                                     checked
                                                       @endif
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
                                        <input type="date" class="form-control" value="{{$post->start_date}}"
                                               name="start_date">
                                        <span class="form-message text-danger"></span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">End Date</label>
                                        <input type="date" class="form-control" value="{{$post->end_date}}"
                                               name="end_date">
                                        <span class="form-message text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label">Number of applicants</label>
                                <input class="form-control" type="number" name="number_applicants"
                                       value="{{$post->number_applicants}}"
                                       autocomplete="off"
                                       placeholder="Number of applicants">
                                <span class="form-message text-danger"></span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="floatingTextarea">Description</label>
                            <textarea class="form-control ckeditor" name="job_description" placeholder="Leave a comment here"
                                   >{{$post->job_description}}</textarea>
                            <span class="form-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="floatingTextarea">Requirements</label>
                            <textarea class="form-control ckeditor" name="job_requirement" placeholder="Leave a comment here"
                                      id="ckeditor1">{{$post->job_requirement}}</textarea>
                            <span class="form-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="floatingTextarea">Benefits</label>
                            <textarea class="form-control ckeditor" name="job_benefit" placeholder="Leave a comment here"
                                      id="ckeditor1" >{{$post->job_benefit}}</textarea>
                            <span class="form-message text-danger"></span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Title</label>
                                    <input class="form-control" name="job_title" value="{{$post->job_title}}"
                                           type="text" autocomplete="off">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label">Slug</label>
                                    <input class="form-control" name="slug" value="{{$post->slug}}" type="text"
                                           autocomplete="off">
                                    <span class="form-message text-danger"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="btn-sb-form" disabled class="btn btn-primary">Submit</button>
                        </div>
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
                            <form class="creat-company" action="{{route('admin.companies.store')}}"
                                  method="post" id="fmCreate-Company" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <input type="text" name="name" id="company" readonly
                                           class="form-control border-primary">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label class="form-label">Provinces/City (*)</label>
                                        <select type="text" id="city" name="city"
                                                class="form-control select2"
                                                data-toggle="select2"></select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="form-label">District</label>
                                        <select type="text" name="district" id="district"
                                                class="form-control select2"
                                                data-toggle="select2"></select>
                                        <span class="form-message text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control"
                                           autocomplete="off">
                                    <span class="form-message text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address2</label>
                                    <input type="text" name="address2" class="form-control"
                                           autocomplete="off">
                                    <span class="form-message text-danger"></span>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" autocomplete="off">
                                        <span class="form-message text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label>Logo</label>
                                        <input type="file" name="logo" id="" class="form-control"
                                               oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                        <span class="form-message text-danger"></span>
                                    </div>
                                    <div class="form-group col-6">
                                        <img height="100px" id="pic"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="submitForm('#fmCreate-Company')">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/quillEditor.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            const locationApi = '{{asset('location/index.json')}}';
            const handleLocation = {
                getProvinces: function () {
                    const _this = this;
                    fetch(locationApi)
                        .then(function (response) {
                            return response.json();
                        })
                        .then(function (provinces) {
                            _this.renderLocations(provinces)
                        });
                },
                renderLocations: function (provinces) {
                    let selectProvince = document.getElementById('select-provinces');
                    let selectCityForModal = document.getElementById('city');
                    let postCity = '';
                    @if($post->city)
                        postCity = '{{$post->city}}';
                    @endif
                    let htmls = Object.keys(provinces).map(function (key) {
                        let checkSelected = (postCity == key) ? 'selected' : '';
                        return `<option ${checkSelected} data-path="${provinces[key].file_path}" >${key}</option> `;
                    }).join('');
                    selectProvince.innerHTML = htmls;
                    this.loadDistrict('#select-provinces', '#select-district');
                    selectCityForModal.innerHTML = htmls;
                },
                loadDistrict: function (el, rs) {
                    let x = $(el).find(':selected');
                    let path = x.attr('data-path');
                    let districtApi = '{{asset('location')}}' + path;
                    fetch(districtApi)
                        .then(function (response) {
                            return response.json();
                        })
                        .then(function (data) {
                            const selectedValue = $(rs).val();
                            let postDistrict = '';
                            @if($post->district)
                                postDistrict = '{{$post->district}}';
                            @endif
                            console.log(postDistrict)
                            let htmls = data.district.map(function (k) {
                                let selected = (selectedValue === k.name || k.name === postDistrict) ? 'selected' : '';
                                return `<option ${selected}>${k.name}</option>`;
                            }).join('');
                            document.querySelector(rs).innerHTML = htmls;
                        });
                },
                handleEvent: function () {
                    const _this = this;
                    $('#select-provinces').change(function () {
                        _this.loadDistrict('#select-provinces', '#select-district');
                    });
                    $('#city').change(function () {
                        _this.loadDistrict('#city', '#district');
                    });
                },
                start: function () {
                    this.getProvinces()
                    this.handleEvent()
                }
            }
            handleLocation.start();

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
                    url: '{{route('api.post.slug.generate')}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {title},
                    success: function (response) {
                        $('input[name="slug"]').val(response.data);
                        $('input[name="slug"]').trigger("change");
                    }
                })
            }

            $("input[name='slug']").change(function () {
                $("#btn-sb-form").attr('disabled', true);
                $.ajax({
                    url: '{{route('api.post.slug.check')}}',
                    type: 'get',
                    dataType: 'json',
                    data: {slug: $(this).val()},
                    success: function (response) {
                        if (response.success) {
                            $("#btn-sb-form").attr('disabled', false);
                        }
                    }
                })
            })

            $('#select-company').select2({
                tags: true,
                ajax: {
                    url: '{{route('api.companies')}}',
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.name
                                }
                            })
                        };
                    }
                }
            });
            // Fetch the preselected item, and add to the control
            let urlCompany = "{{route('api.company_id',$post->company->id)}}";
            let companySelect = $('#select-company');
            fetch(urlCompany)
                .then(function (response) {
                    return response.json();
                })
                .then(activeCompany);

            function activeCompany(response) {
                companySelect.append(new Option(`${response.data.name}`, `${response.data.name}`, true, true));
            }

            $('#select-language').select2({
                tags: true,
                ajax: {
                    url: '{{route('api.languages')}}',
                    data: function (params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.name
                                }
                            })
                        };
                    }
                }
            });

            @foreach($arrLanguage as $languages)
            $('#select-language').append(new Option(`{{$languages}}`, `{{$languages}}`, true, true));
            @endforeach
            $("#fmCreate-Post").validate({
                rules: {
                    company: {
                        required: true,
                    }
                },
                submitHandler: function () {
                    checkCompany();
                }
            })

            function checkCompany() {
                $.ajax({
                    url: '{{route('api.companies.check')}}/' + $('#select-company').val(),
                    type: 'GET',
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.data) {
                            submitForm('#fmCreate-Post');
                        } else {
                            $('#company').val($('#select-company').val());
                            $("#city").val($("#select-provinces").val()).trigger('change');
                            $("#company-modal").modal();
                        }
                    }
                })
            }

            $("#fmCreate-Post").change(function () {
                $('#btn-sb-form').attr('disabled', false)
            });
        });

        function submitForm(type) {
            const form = $(type);
            let formData = new FormData(form[0]);
            formData.append('_method', 'PUT');
            let redirect = $(type +'input[name="redirect"]');
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
                        if (redirect){
                            window.location.href = '{{route('admin.posts.index')}}';
                        }

                    } else {
                        console.log(response)
                        notifyError();
                    }
                },
                error: function (response) {
                    console.log(response.responseJSON)
                    notifyError();
                    let errors = response.responseJSON.errors;
                    showError(errors);
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
