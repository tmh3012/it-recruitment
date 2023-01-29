@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="h4">Create new blog</span>
                </div>
                <div class="card-body">
                    <form class="creat-blog" action="{{route('admin.blog.store')}}"
                          method="post" id="fmCreate-blog" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="title" class="form-label">Title (*)</label>
                                <input type="text" name="title" id="title" class="form-control">
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group col-6">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" id="slug" name="slug" class="form-control">
                                <span class="form-message"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea rows="5" name="description" id="description" class="form-control" autocomplete="off"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea type="text" name="content" id="content" class="form-control ckeditor" autocomplete="off"></textarea>
                            <span class="form-message"></span>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-7">
                                <label>Images cover</label>
                                <div class="d-flex">
                                    <input type="file" name="image" id="file" class="form-control w-50 mr-1"
                                           oninput="pic_logo.src=window.URL.createObjectURL(this.files[0])">
                                    <img id="pic_logo"/>
                                </div>
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group col-5">
                                <label>Image ALT</label>
                                <input type="text" name="alt_images" class="form-control">
                                <span class="form-message"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="blog-status">Status</label>
                            <div class="d-flex">
                                <div class="form-group  mr-3">
                                    <select class="form-control" id="blog-status" name="status">
                                        <option value="">Chose status</option>
                                        @foreach($blogStatus as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <span class="form-message"></span>
                                </div>

                                <button type="submit" style="height: 40px" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Validator({
                form: '#fmCreate-blog',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#title'),
                    Validator.isRequired('#slug'),
                    Validator.isRequired('#content'),
                    Validator.isRequired('#description'),
                    Validator.isRequired('#blog-status'),
                    Validator.isRequired('#file'),
                ],
                onSubmit: function (data) {
                    // Call API
                    console.log(data);
                }
            })
        })
        $(document).ready(function () {
            $('#fmCreate-blog').on('change', 'input[name="title"]', function () {
                const rs = $('input[name="slug"]');
                let title = $(this).val();
                if (title) {
                    generateSlug(title, rs);
                    $('input[name="alt_images"]').val(title);
                }
            })

            function generateSlug(title, rs) {
                $.ajax({
                    url: '{{route("api.blog.slug.generate")}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {title},
                    success: function (response) {
                        rs.val(response.data);
                    }
                })
            }

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
                    if (response.success) {
                        notifySuccess();
                        window.location.href = '{{route('admin.companies.index')}}'
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
    </script>
@endpush
