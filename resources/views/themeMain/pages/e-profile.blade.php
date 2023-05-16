@extends('themeMain.master')
@section('content')
    <div class="profile " id="profile">
        <div class="profile-header bg-white">
            <div class="profile-wrapper">
                <div class="cover background--image"
                     style="background-image:url('{{$data->cover}}')"></div>
                <div class="cover background--color"></div>
                <div class="profile-user">
                    <div class="container">
                        <div class="background-main container"
                             style="background-image:url('{{$data->cover}}')">
                        </div>
                        <div class="user-container d-flex px-4">
                            <div class="user-ava">
                                <div class="ava-image p-1 bg-white">
                                    <img class="w-100"
                                         src="{{$data->avatar}}"
                                         alt="">
                                </div>
                            </div>
                            <div class="user-info mt-2">
                                <h1 class="text-cl-main">@if(!empty($data->name))
                                        {{$data->name}}
                                    @endif</h1>
                                <h2 class="font-18 font-weight-semibold">@if(!empty($data->position))
                                        {{$data->position}}
                                    @endif</h2>
                                <span class=" text-black-50 font-weight-semibold">
                                    @if(!empty($data->name))
                                        <i class="mdi mdi-map-marker-outline"></i>{{$data->city}}
                                    @endif
                                </span>
                            </div>
                            <div class="user-action mt-auto ml-auto">
                                @auth
                                    @if($data->id !== user()->id)
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" class="btn btn-success mr-2">Follow</a>
                                            <a href="javascript:void(0)" class="btn btn-primary">
                                                <i class="fa-brands fa-facebook-messenger"></i> Message</a>
                                        </div>
                                    @endif
                                    @if($data->id === user()->id)
                                        <a href="{{route('applicant.profile.index')}}" class="btn btn-primary "> Edit
                                            profile</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="user-navigation px-4">
                            <ul class="default-ul d-none navigation-wrap ">
                                <li class="nav-item active mr-2">
                                    <a class="item-link font-weight-bold text-black-50 font-16" href="#">Over view</a>
                                </li>
                                <li class="nav-item mr-2">
                                    <a class="item-link font-weight-bold text-black-50 font-16"
                                       href="?tab=about">About</a>
                                </li>
                                <li class="nav-item mr-2">
                                    <a class="item-link font-weight-bold text-black-50 font-16" href="#">Project</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-main mt-3">
            <div class="container content-wrapper">
                <div class="profile__over-view  px-4">
                    <div class="row">
                        <div class="col-4">
                            <!-- start about me -->
                            <x-profile.aboutme :data="$data"/>
                            <!-- end about me -->
                        </div>
                        <div class="col-8">
                            <div class="main-content bg-white rounded p-3 box-shadow">
                                <div class="content-wrapper">
                                    <!-- start Experience component -->
                                    <x-profile.experience :data="$experiences"/>
                                    <!-- end Experience component -->

                                    <!-- start Experience component -->
                                    <x-profile.education :data="$data"/>
                                    <!-- end Experience component -->

                                    {{--                                    <h5 class="mb-3 mt-4 text-uppercase"><i class="mdi mdi-cards-variant me-1"></i>--}}
                                    {{--                                        Projects</h5>--}}
                                    {{--                                    <div class="table-responsive">--}}
                                    {{--                                        <table class="table table-borderless table-nowrap mb-0">--}}
                                    {{--                                            <thead class="table-light">--}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <th>#</th>--}}
                                    {{--                                                <th>Clients</th>--}}
                                    {{--                                                <th>Project Name</th>--}}
                                    {{--                                                <th>Start Date</th>--}}
                                    {{--                                                <th>Due Date</th>--}}
                                    {{--                                                <th>Status</th>--}}
                                    {{--                                            </tr>--}}
                                    {{--                                            </thead>--}}
                                    {{--                                            <tbody>--}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <td>1</td>--}}
                                    {{--                                                <td><img src="assets/images/users/avatar-2.jpg" alt="table-user"--}}
                                    {{--                                                         class="me-2 rounded-circle" height="24"> Halette Boivin--}}
                                    {{--                                                </td>--}}
                                    {{--                                                <td>App design and development</td>--}}
                                    {{--                                                <td>01/01/2015</td>--}}
                                    {{--                                                <td>10/15/2018</td>--}}
                                    {{--                                                <td><span class="badge badge-info-lighten">Work in Progress</span></td>--}}
                                    {{--                                            </tr>--}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <td>2</td>--}}
                                    {{--                                                <td><img src="assets/images/users/avatar-3.jpg" alt="table-user"--}}
                                    {{--                                                         class="me-2 rounded-circle" height="24"> Durandana Jolicoeur--}}
                                    {{--                                                </td>--}}
                                    {{--                                                <td>Coffee detail page - Main Page</td>--}}
                                    {{--                                                <td>21/07/2016</td>--}}
                                    {{--                                                <td>12/05/2018</td>--}}
                                    {{--                                                <td><span class="badge badge-danger-lighten">Pending</span></td>--}}
                                    {{--                                            </tr>--}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <td>3</td>--}}
                                    {{--                                                <td><img src="assets/images/users/avatar-4.jpg" alt="table-user"--}}
                                    {{--                                                         class="me-2 rounded-circle" height="24"> Lucas Sabourin--}}
                                    {{--                                                </td>--}}
                                    {{--                                                <td>Poster illustation design</td>--}}
                                    {{--                                                <td>18/03/2018</td>--}}
                                    {{--                                                <td>28/09/2018</td>--}}
                                    {{--                                                <td><span class="badge badge-success-lighten">Done</span></td>--}}
                                    {{--                                            </tr>--}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <td>4</td>--}}
                                    {{--                                                <td><img src="assets/images/users/avatar-6.jpg" alt="table-user"--}}
                                    {{--                                                         class="me-2 rounded-circle" height="24"> Donatien Brunelle--}}
                                    {{--                                                </td>--}}
                                    {{--                                                <td>Drinking bottle graphics</td>--}}
                                    {{--                                                <td>02/10/2017</td>--}}
                                    {{--                                                <td>07/05/2018</td>--}}
                                    {{--                                                <td><span class="badge badge-info-lighten">Work in Progress</span></td>--}}
                                    {{--                                            </tr>--}}
                                    {{--                                            <tr>--}}
                                    {{--                                                <td>5</td>--}}
                                    {{--                                                <td><img src="assets/images/users/avatar-5.jpg" alt="table-user"--}}
                                    {{--                                                         class="me-2 rounded-circle" height="24"> Karel Auberjo--}}
                                    {{--                                                </td>--}}
                                    {{--                                                <td>Landing page design - Home</td>--}}
                                    {{--                                                <td>17/01/2017</td>--}}
                                    {{--                                                <td>25/05/2021</td>--}}
                                    {{--                                                <td><span class="badge badge-warning-lighten">Coming soon</span></td>--}}
                                    {{--                                            </tr>--}}

                                    {{--                                            </tbody>--}}
                                    {{--                                        </table>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @includeUnless(auth()->check(), 'modal.modalLogin')
@endsection
@push('css')
    <style>
        .profile-wrapper {
            position: relative;
            margin-top: 0;
            /*height: 500px;*/
            overflow: hidden;
        }

        .cover.background--image {
            background-position: 50%;
            background-size: cover;
            filter: blur(7rem);
            -webkit-filter: blur(7rem);
            position: absolute;
            top: 0;
            right: 0;
            bottom: 140px;
            left: 0;
        }

        .cover.background--color {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 140px;
            left: 0;
            opacity: 0.6;
            background-color: #ffffff00;
            background-position: 50%;
        }

        .profile-user {
            position: relative;
            z-index: 1;
            background-image: linear-gradient(180deg, hsl(0deg 0% 100% / 0%), #ffffff);
        }

        .background-main.container {
            height: 450px;
            width: 100%;
            position: relative;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            border-bottom-right-radius: 10px;
            border-bottom-left-radius: 10px;

        }

        .user-container {
            padding-bottom: 20px;
        }

        .user-container .user-ava {
            width: 160px;
            height: 120px;
            margin-right: 20px;
            position: relative;

        }

        .user-container .user-ava .ava-image {
            position: absolute;
            top: -35%;
            border: 1px solid transparent;
            border-radius: 100%;
            width: 160px;
            height: 160px;
        }

        .user-container .user-ava .ava-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
            border-radius: 100%;
        }

        .navigation-wrap {
            border-top: 2px solid hsl(220deg 6.25% 81.18%);
        }

        .user-navigation .nav-item {
            position: relative;
            padding: 10px 0;
        }

        .user-navigation .nav-item .item-link {
            padding: 10px 5px;
        }

        .user-navigation .nav-item.active .item-link {
            color: var(--primary) !important;
        }

        .user-navigation .nav-item.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            height: 2px;
            background-color: var(--primary);
        }

        .user-navigation .nav-item:hover:not(.nav-item.active) .item-link {
            background-color: #edededcc;
            border-radius: 6px;
        }

        .social-list-item {
            display: flex;
            align-items: center;
            justify-content: center;
        }

    </style>
@endpush

