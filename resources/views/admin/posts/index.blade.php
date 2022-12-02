@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="header-action">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
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
                            <th>Remotable</th>
                            <th>Is Part-time</th>
                            <th>Range Salary</th>
                            <th>Date Range</th>
                            <th>Status</th>
                            <th>Is Pinned</th>
                            <th>Created At</th>
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
                            {{--                            @foreach($levels as $option => $val)--}}
                            {{--                                <option value="{{ $val }}">--}}
                            {{--                                    {{ ucwords(strtolower($option)) }}--}}
                            {{--                                </option>--}}
                            {{--                            @endforeach--}}
                        </select>
                    </div>
                    {{--                    <div class="form-group">--}}
                    {{--                        <label>File</label>--}}
                    {{--                        <input--}}
                    {{--                                type="file"--}}
                    {{--                                name="csv-2"--}}
                    {{--                                id="csv"--}}
                    {{--                                class="form-control"--}}
                    {{--                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"--}}
                    {{--                        >--}}
                    {{--                    </div>--}}
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
                url: '{{route('api.posts')}}',
                dataType: 'json',
                data: {page: {{ request()->get('page') ?? 1 }}},
                success: function (response) {
                    response.data.data.forEach(function (each) {
                        const remotable = (each) ? 'x' : '';
                        const partTime = (each) ? 'x' : '';
                        const range_salary = (each.min_salary && each.max_salary) ? each.min_salary + '-' + each.max_salary : '';
                        const range_date = (each.start_date && each.end_date) ? each.start_date + '-' + each.end_date : '';
                        const is_pinned = each.is_pinned ? 'x' : '';
                        const created_at = convertDateToDateTime(each.created_at);
                        $('#table-posts').append($('<tr>')
                            .append($('<td>').append(each.id)).attr('class','text-center')
                            .append($('<td>').append(each.job_title))
                            .append($('<td>').append(each.city))
                            .append($('<td>').append(remotable))
                            .append($('<td>').append(partTime))
                            .append($('<td>').append(range_salary))
                            .append($('<td>').append(range_date))
                            .append($('<td>').append(each.status))
                            .append($('<td>').append(is_pinned))
                            .append($('<td>').append(created_at))
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
