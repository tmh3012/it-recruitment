@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="header-action">
                        <a href="{{route('admin.companies.create')}}" class="btn btn-primary">Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Company name</th>
                            <th>Address</th>
                            <th>District</th>
                            <th>City</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $each)
                            <tr>
                                <td>{{$each->id}}</td>
                                <td>
                                    <img height="30px" src="{{asset('storage/'.$each->logo)}}" alt="">
                                </td>
                                <td>{{$each->name}}</td>
                                <td>{{$each->address}}</td>
                                <td>{{$each->district}}</td>
                                <td>{{$each->city}}</td>
                                <td>
                                    <a class="btn btn-info" href="#">Edit</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="#">delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
