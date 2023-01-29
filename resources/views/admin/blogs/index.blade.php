@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="header-action">
                        <a href="{{route('admin.blog.create')}}" class="btn btn-primary">Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>image</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $each)
                            <tr>
                                <td>{{$each->id}}</td>
                                <td>
                                    <img height="30px" src="{{asset('storage/'.$each->image)}}" alt="">
                                </td>
                                <td>{{$each->title}}</td>

                                <td>
                                    <a class="btn btn-info" href="{{route('admin.companies.edit', $each->id)}}">Edit</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="#">delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav class="mt-3">
                        <ul class="pagination pagination-rounded mb-0">
                            {{ $data->appends(request()->all())->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
