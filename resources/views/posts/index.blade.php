@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="header-action">
                        <a href="{{ isAdmin() ? route('admin.posts.create') : route('hr.posts.create') }}"
                            class="btn btn-primary">
                            Create
                        </a>
                        <label class="btn btn-info btn-import mb-0" for="csv">Import CSV</label>
                        <input type="file" name="csv" id="csv" class="d-none"
                            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    </div>

                    <nav class="float-right">
                        <ul class="pagination pagination-rounded mb-0" id="pagination">
                        </ul>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-posts"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-modal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center bg-primary">
                    <div class="modal-header__left">
                        <h5 class="modal-title text-dark text-uppercase" id="confirmModalLabel">
                            Do you want to continue?</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="description"> Confirm update status of post</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary btn-confirm-status">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('api.posts.getPost') }}',
                dataType: 'json',
                data: {
                    page: {{ request()->get('page') ?? 1 }}
                },
                success: function(response) {
                    if (response.success && response.data.data.length > 0) {
                        $('#table-posts').append(
                                `<thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Job Title</th>
                                    <th>Location</th>
                                    <th>Range Salary</th>
                                    <th>Deadline Apply</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Created At</th>
                                    <th>Update At</th>
                                </tr>
                            </thead>
                            <tbody></tbody>`
                            );
                        const postStatus = response.data.postStatus;
                        response.data.data.forEach(function(each) {

                            function renderFormPostStatusForAdmin(postId, valCurrentStatus) {
                                let optionHtmls = Object.keys(postStatus).map(function(key) {
                                    let selected = postStatus[key] === valCurrentStatus ? 'selected' : '';
                                    return `<option value="${postStatus[key]}" ${selected}>${key}</option>`
                                }).join('');

                                return `<form class="post-status-form" form-id = ${postId}>
                                <select name='status' class="form-control">${optionHtmls}</select>
                            </form>`;
                            }

                            const editBtn = `<button class="btn btn-primary btn-edit-post" data-post="${each.id}">Edit</button>`;
                            const created_at = convertDateToDateTime(each.created_at);
                            const updated_at = each.created_at === each.updated_at ? '' :  convertDateToDateTime(each.updated_at);

                            $('#table-posts')
                                .append($('<tr>')
                                    .append($('<td>').append(each.id)).attr('class', 'text-center')
                                    .append($('<td>').append(each.job_title))
                                    .append($('<td>').append(each.location))
                                    .append($('<td>').append(each.salary))
                                    .append($('<td>').append(each
                                        .deadline_submit)) @if (isAdmin())
                                    .append($('<td>').append(renderFormPostStatusForAdmin(each
                                        .id, each.status)))
                                    @else
                                    .append($('<td>').append(each.status_type_string))
                                    @endif
                                    .append($('<td>').append(editBtn))
                                    .append($('<td>').append(created_at))
                                    .append($('<td>').append(updated_at))
                                );
                        });
                        renderPagination(response.data.pagination)
                    } else{
                        $('#table-posts').append($('<div class="no-post text-center">')
                            .append($('<p>').text('You have no posts yet. Start creating your first post to find potential candidates.'))
                            .append($('<a class="btn btn-primary" href="{{ isAdmin() ? route('admin.posts.create') : route('hr.posts.create') }}">')
                                .text('Create'))
                        );
                    }
                },
                error: function(response) {

                    $.toast({
                        heading: 'Response Error',
                        text: response.responseJSON.message,
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'error'
                    })
                }
            })
            $('#table-posts').on('click', '.btn-edit-post', function() {
                let postId = $(this).attr('data-post');
                let url = location.href + '/edit/' + postId;
                location.assign(url);
            })
            $('#table-posts').on('change', '.post-status-form', function() {
                const formElement = $(this);
                const formId = formElement.attr('form-id');
                let formData = new FormData(formElement[0]);
                let url = location.href + '/update/status/' + formId;
                formData.append('_method', 'PUT');
                if (confirm("Confirm update status") == true) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            notifySuccess();
                        }
                    })
                } else {
                    formElement.trigger("reset");
                }

            })
            $(document).on('click', '#pagination>li>a', function(e) {
                e.preventDefault();
                let pageNumber = $(this).text();
                let urlParams = new URLSearchParams(window.location.search);
                urlParams.set('page', pageNumber);
                window.location.search = urlParams;
            })

            $('.header-action').on('change', 'input[name="csv"]', function() {
                let formData = new FormData();
                formData.append('file', $('.header-action #csv')[0].files[0]);
                $.ajax({
                    url: '{{ route('admin.posts.import_csv') }}',
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function() {
                        $.toast({
                            heading: 'Import Success',
                            text: 'Your data have been imported',
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'success'
                        })
                    },
                    error: function(response) {

                    }
                })
            });
        })
    </script>
@endpush
