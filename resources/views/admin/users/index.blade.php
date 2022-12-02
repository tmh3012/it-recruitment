@extends('layout.master')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form class="form-inline" action="" id="form-filter">
                        <div class="form-group mr-2">
                            <label class="pr-1" for="role">Role</label>

                            <select class="form-select form-control filter__items" name="role" id="role"
                                    aria-label="Select role for filter">
                                <option value="all" selected>Select role</option>
                                @foreach($roles as $role => $value)
                                    <option value="{{$value}}"
                                            @if($selectRole == $value) selected @endif
                                    >
                                        {{$role}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mr-2">
                            <label class="pr-1" for="city">City</label>

                            <select class="form-select form-control filter__items" name="city" id="city"
                                    aria-label="Select city for filter">
                                <option value="all" selected>Select cities</option>
                                @foreach($cities as $city)
                                    <option value="{{$city}}"
                                            @if($selectCity == $city) selected @endif
                                    >
                                        {{$city}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mr-2">
                            <label class="pr-1" for="company">Company</label>
                            <select class="form-select form-control filter__items" name="company" id="company"
                                    aria-label="Select company for filter">
                                <option value="all" selected>Select company</option>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}"
                                            @if($selectCompany == $company->id) selected @endif
                                    >
                                        {{$company->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </form>

                </div>
                @if($data->total() > 0)
                    <div class="card-body">
                        <table class="table table-hover table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Info</th>
                                <th>Role</th>
                                <th>Position</th>
                                <th>City</th>
                                <th>Company</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $each)
                                <tr>
                                    <td>
                                        {{--                                    {{ route("admin.$table.show", $each) }}--}}
                                        <a href="#">
                                            {{ $each->id }}
                                        </a>
                                    </td>
                                    <td>
                                        <img src="{{ $each->avatar }}" height="100">
                                    </td>
                                    <td>
                                        {{ $each->name }} - {{ $each->gender_name }}
                                        <br>
                                        <a href="mailto:{{$each->email}}">
                                            {{ $each->email }}
                                        </a>
                                        <br>
                                        <a href="tel:{{$each->phone}}">
                                            {{ $each->phone }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $each->role_name }}
                                    </td>
                                    <td>
                                        {{ $each->position }}
                                    </td>
                                    <td>
                                        {{ $each->city }}
                                    </td>
                                    <td>
                                        {{ optional($each->company)->name }}
                                    </td>
                                    <td>
                                        <form action="{{route("admin.$table.destroy", $each->id) }}}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination pagination-rounded mb-0">
                                {{ $data->links() }}
                            </ul>
                        </nav>
                    </div>
                @else
                    <div class="card-body d-flex align-items-center flex-column card-noti-empty">
                        <p class="card-text text-center">
                            Hix. Không có sản phẩm nào. Bạn thử tắt điều kiện lọc và tìm lại nhé?<br>or
                        </p>
                        <a href="{{route('admin.users.index')}}" class="btn btn-danger text-capitalize">Xóa bộ lọc</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(".filter__items").change(function () {
                $("#form-filter").submit();
            });
        });
    </script>
@endpush
