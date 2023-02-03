@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="header-action">
                        <a href="{{ isAdmin() ? route('admin.posts.create') : route('hr.posts.create') }}" class="btn btn-primary">
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
                    <table class="table table-striped" id="table-posts">
                        <thead>
                        <tr  class="text-center">
                            <th>#</th>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Range Salary</th>
                            <th>Deadline Apply</th>
                            <th>Status</th>
                            {{-- <th>Is Pinned</th> --}}
                            <th>Edit</th>
                            <th>Created At</th>
                            <th>Update At</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="modalCSV" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import CSV</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-horizontal">
                    <div class="form-group">
                        <label>Levels</label>
                        <select class="form-control" multiple id="levels">
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" id="btn-import-csv">
                            Import
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '{{route('api.posts.getPost')}}',
                dataType: 'json',
                data: {page: {{ request()->get('page') ?? 1 }}},
                success: function (response) {
                    response.data.data.forEach(function (each) {


                        // const is_pinned = each.is_pinned ? 'x' : '';
                        const editBtn = `<button class="btn btn-primary btn-edit-post" data-post="${each.id}">Edit</button>`;
                        const created_at = convertDateToDateTime(each.created_at);
                        const updated_at = each.created_at === each.updated_at ? '' : convertDateToDateTime(each.updated_at);
                        $('#table-posts').append($('<tr>')
                            .append($('<td>').append(each.id)).attr('class','text-center')
                            .append($('<td>').append(each.job_title))
                            .append($('<td>').append(each.location))
                            .append($('<td>').append(each.salary))
                            .append($('<td>').append(each.deadline_submit))
                            .append($('<td>').append(each.status))
                            // .append($('<td>').append('update later'))
                            .append($('<td>').append(editBtn))
                            .append($('<td>').append(created_at))
                            .append($('<td>').append(updated_at))
                        );
                    });
                    renderPagination(response.data.pagination)
                },
                error: function (response) {

                    $.toast({
                        heading: 'Response Error',
                        text: response.responseJSON.message,
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'error'
                    })
                }
            })
            $('#table-posts').on('click','.btn-edit-post', function(){
                let postId = $(this).attr('data-post');
                let url = location.href + '/edit/'+postId;
                location.assign(url);
            })
            $(document).on('click', '#pagination>li>a', function (e){
                e.preventDefault();
                let pageNumber = $(this).text();
                let urlParams = new URLSearchParams(window.location.search);
                urlParams.set('page', pageNumber);
                window.location.search = urlParams;
            })

            $('.header-action').on('change', 'input[name="csv"]', function () {
                let formData = new FormData();
                formData.append('file', $('.header-action #csv')[0].files[0]);
                $.ajax({
                    url: '{{route('admin.posts.import_csv')}}',
                    type: 'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function () {
                        $.toast({
                            heading: 'Import Success',
                            text: 'Your data have been imported',
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            icon: 'success'
                        })
                    },
                    error: function (response) {

                    }
                })
            });
        })
    </script>
@endpush
