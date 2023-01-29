@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h3">Create new company</span>
                </div>
                <div class="card-body">
                    <form class="creat-company" action="{{route('admin.companies.update', $company)}}"
                          method="post" id="fmCreate-Company" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" id="company" class="form-control border-primary" value="{{$company->name}}" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label class="form-label">Provinces/City (*)</label>
                                <select type="text" id="select-provinces" name="city"
                                        class="form-control select2"
                                        data-toggle="select2"></select>
                            </div>
                            <div class="form-group col-6">
                                <label class="form-label">District</label>
                                <select type="text" name="district" id="select-district"
                                        class="form-control select2"
                                        data-toggle="select2"></select>
                                <span class="form-message text-danger"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control"
                                   value="{{$company->address}}"    autocomplete="off">
                                <span class="form-message text-danger"></span>
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">Address2</label>
                                <input type="text" name="address2" class="form-control" value="{{$company->address2}}"
                                       autocomplete="off">
                                <span class="form-message text-danger"></span>
                            </div>
                            <div class="form-group col-4">
                                <label class="form-label">Website</label>
                                <input type="text" name="link" class="form-control" value="{{$company->link}}"
                                       autocomplete="off">
                                <span class="form-message text-danger"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{$company->phone}}" autocomplete="off">
                            </div>
                            <div class="form-group col-4">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{$company->email}}" autocomplete="off">
                                <span class="form-message text-danger"></span>
                            </div>
                            <div class="form-group col-4">
                                <label>Number of employees</label>
                                <input type="text" name="number_of_employees" class="form-control"  value="{{$company->number_of_employees}}" autocomplete="off">
                                <span class="form-message text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <lable>Over View</lable>
                            <textarea name="over_view" class="form-control">{{$company->over_view}}</textarea>
                        </div>
                        <div class="form-group">
                            <lable>Mission</lable>
                            <textarea name="mission" class="form-control">{{$company->mission}}</textarea>
                        </div>
                        <div class="form-group">
                            <lable>Introduction</lable>
                            <textarea name="introduction" class="form-control ckeditor">{{$company->introduction}}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Logo</label>
                                <div class="d-flex">
                                    <input type="file" name="logo" id="" class="form-control w-50 mr-1"
                                           value="{{$company->logo}}"
                                           oninput="pic_logo.src=window.URL.createObjectURL(this.files[0])">
                                    <img src="{{asset('storage/'.$company->logo)}}" height="100px" id="pic_logo"/>
                                </div>
                                <span class="form-message text-danger"></span>
                            </div>
                            <div class="form-group col-6">
                                <label>Cover</label>
                                <div class="d-flex">
                                    <input type="file" name="cover" id="" class="form-control w-50 mr-1"
                                           value="{{$company->cover}}"
                                           oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                    <img  src="{{asset('storage/'.$company->cover)}}"  height="100px" id="pic"/>
                                </div>
                                <span class="form-message text-danger"></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            handleLocation.start();
            $('#select-provinces').append(new Option(`{{$company->city}}`, `{{$company->city}}`, true, true));
            $('#select-district').append(new Option(`{{$company->district}}`, `{{$company->district}}`, true, true));

            $("#fmCreate-Company").validate({
                rules: {
                    company: {
                        required: true,
                    }
                },
                submitHandler: function () {
                    submitForm('#fmCreate-Company');
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
                    console.log(response.data);
                    if(response.success){
                        notifySuccess();
                        window.location.href = '{{route('admin.companies.index')}}'
                    }else {
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
    </script>
@endpush
