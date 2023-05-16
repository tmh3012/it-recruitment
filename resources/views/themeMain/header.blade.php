<header class="header" id="header">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="header__left">
            <a href="{{route('home')}}">
                <h1 class="text-primary">IT Recruitment</h1>
            </a>
        </div>
        <div class="header__nav">
            <ul class="menu-primary default-ul d-flex align-items-center justify-content-between">
                <li class="mr-3 {{request()->routeIs('home') ? 'active' : ''}}">
                    <a href="{{route('home')}}">
                        <span
                            class="text-capitalize text-dark font-16 font-weight-semibold">{{__('frontPage.homePage')}}</span>
                    </a>
                </li>
                <li class="mr-3 {{request()->routeIs('jobs*') ? 'active' : ''}}">
                    <a href="{{route('jobs-page')}}">
                        <span
                            class="text-capitalize text-dark font-16 font-weight-semibold">{{__('frontPage.jobsPage')}}
                        </span>
                    </a>
                </li>
                <li class="mr-3 {{request()->routeIs('profile*') ? 'active' : ''}}">
                    <a href="@if(auth()->check()) {{route('profile.index',user()->id)}} @else {{route('profile.welcome')}} @endif">
                        <span
                            class="text-capitalize text-dark font-16 font-weight-semibold">{{__('frontPage.profilePage')}}
                        </span>
                    </a>
                </li>
                <li class="mr-3 {{request()->routeIs('company*') ? 'active' : ''}}">
                    <a href="{{route('company.index')}}">
                        <span
                            class="text-capitalize text-dark font-16 font-weight-semibold">{{__('frontPage.companyPage')}}</span>
                    </a>
                </li>
                <li class="mr-3 {{request()->routeIs('blog*') ? 'active' : ''}}">
                    <a href="{{route('blog.index')}}">
                        <span class="text-capitalize text-dark font-16 font-weight-semibold">blog</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="header__right align-items-center d-flex">
            @if(auth()->check())
                <ul class="d-flex list-unstyled mb-0 topbar-right-menu">
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none" href="#">
                            <i class="mdi mdi-wechat noti-icon mdi-24px"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg" style="">

                            <!-- item-->
                            <div class="dropdown-item noti-title px-3">
                                <h5 class="m-0">
                                    <span class="float-end">
                                        <a href="javascript: void(0);" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h5>
                            </div>

                            <div style="max-height: 230px;" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                                            <small class="text-muted">1 min ago</small>
                                                        </p>
                                                    </a>

                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon bg-info">
                                                            <i class="mdi mdi-account-plus"></i>
                                                        </div>
                                                        <p class="notify-details">New user registered.
                                                            <small class="text-muted">5 hours ago</small>
                                                        </p>
                                                    </a>

                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon">
                                                            <img src="" class="img-fluid rounded-circle" alt="">
                                                        </div>
                                                        <p class="notify-details">Cristina Pride</p>
                                                        <p class="text-muted mb-0 user-msg">
                                                            <small>Hi, How are you? What about our next meeting</small>
                                                        </p>
                                                    </a>

                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                                            <small class="text-muted">4 days ago</small>
                                                        </p>
                                                    </a>

                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon">
                                                            <img src="" class="img-fluid rounded-circle" alt="">
                                                        </div>
                                                        <p class="notify-details">Karen Robinson</p>
                                                        <p class="text-muted mb-0 user-msg">
                                                            <small>Wow ! this admin looks good and awesome
                                                                design</small>
                                                        </p>
                                                    </a>

                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon bg-info">
                                                            <i class="mdi mdi-heart"></i>
                                                        </div>
                                                        <p class="notify-details">Carlos Crouch liked
                                                            <b>Admin</b>
                                                            <small class="text-muted">13 days ago</small>
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                View All
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="dripicons-bell noti-icon"></i>
                            <span class="noti-icon-badge"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg" style="">

                            <!-- item-->
                            <div class="dropdown-item noti-title px-3">
                                <h5 class="m-0">
                                    <span class="float-end">
                                        <a href="javascript: void(0);" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h5>
                            </div>

                            <div style="max-height: 230px;" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;">
                                                <div class="simplebar-content" style="padding: 0px;">
                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                                            <small class="text-muted">1 min ago</small>
                                                        </p>
                                                    </a>

                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon bg-info">
                                                            <i class="mdi mdi-account-plus"></i>
                                                        </div>
                                                        <p class="notify-details">New user registered.
                                                            <small class="text-muted">5 hours ago</small>
                                                        </p>
                                                    </a>

                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon">
                                                            <img src="" class="img-fluid rounded-circle" alt="">
                                                        </div>
                                                        <p class="notify-details">Cristina Pride</p>
                                                        <p class="text-muted mb-0 user-msg">
                                                            <small>Hi, How are you? What about our next meeting</small>
                                                        </p>
                                                    </a>

                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                        <p class="notify-details">Caleb Flakelar commented on Admin
                                                            <small class="text-muted">4 days ago</small>
                                                        </p>
                                                    </a>

                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon">
                                                            <img src="" class="img-fluid rounded-circle" alt="">
                                                        </div>
                                                        <p class="notify-details">Karen Robinson</p>
                                                        <p class="text-muted mb-0 user-msg">
                                                            <small>Wow ! this admin looks good and awesome
                                                                design</small>
                                                        </p>
                                                    </a>

                                                    <!-- item-->
                                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                        <div class="notify-icon bg-info">
                                                            <i class="mdi mdi-heart"></i>
                                                        </div>
                                                        <p class="notify-details">Carlos Crouch liked
                                                            <b>Admin</b>
                                                            <small class="text-muted">13 days ago</small>
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                </div>
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                View All
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <!-- item -->
                        <a class="nav-link dropdown-toggle nav-user user-block text-dark arrow-none mt-2 mr-0" data-toggle="dropdown" href="#"
                           role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                @if(auth()->user()->avatar)
                                 <img src="{{user()->avatar}}" alt="user-image" class="rounded-circle">
                                 @else
                                    <i class="mdi mdi-24px mdi-account"></i>
                                 @endif
                            </span>
                            <span>
                                <span class="account-user-name">{{user()->name}}</span>
                                <span class="account-position">{{\App\Enums\UserRoleEnum::getKey(user()->role)}}</span>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown" style="">
                            <!-- sub item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome user !</h6>
                            </div>
                            <!-- sub item-->

                            <!-- sub item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="mdi mdi-lock-outline mr-1"></i>
                                <span>Lock Screen</span>
                            </a>
                            <!-- sub item -->
                            <div class="dropdown-item notify-item menu-lang">
                                @if(App::currentLocale() === 'en')
                                    <img style="width:12px; height: 15px " src="{{asset('img/en.png')}}" alt="en" class="mr-1"
                                         height="12">
                                    <span class="align-middle">{{__('frontPage.enLang')}}</span>
                                @else
                                    <img style="width:12px; height: 12px " src="{{asset('img/vi.png')}}" alt="vi" class="mr-1"
                                         height="12">
                                    <span class="align-middle">{{__('frontPage.viLang')}}</span>
                                @endif
                                <div class="dropdown-menu menu-show-lang" style="">
                                    <!-- item-->
                                    <a href="{{route('language','en')}}" class="dropdown-item notify-item @if(App::currentLocale() === 'en') active @endif">
                                        <img style="with:20px; height: 20px " src="{{asset('img/en.png')}}" alt="en" class="mr-1"
                                             height="12">
                                        <span class="align-middle">{{__('frontPage.enLang')}}</span>
                                    </a>
                                    <!-- item-->
                                    <a href="{{route('language','vi')}}" class="dropdown-item notify-item
                                         @if(App::currentLocale() === 'vi') active @endif">
                                        <img style="with:20px; height: 20px " src="{{asset('img/vi.png')}}" alt="vi" class="mr-1"
                                             height="12">
                                        <span class="align-middle">{{__('frontPage.viLang')}}</span>
                                    </a>
                                </div>
                            </div>
                            <!-- sub item-->
                            <a href="{{route('logout')}}" class="dropdown-item notify-item text-danger">
                                <i class="mdi mdi-logout mr-1"></i>
                                <span>{{__('frontPage.logout')}}</span>
                            </a>

                        </div>
                    </li>
                </ul>

            @else
                <div class="block__action">
                    <a href="{{route('register')}}" class="btn mr-2 text-dark"><u>{{__('frontPage.register')}}</u></a>
                    <a href="{{route('login')}}" class="btn btn-primary rounded-lg">{{__('frontPage.login')}}</a>
                </div>
            @endif
        </div>
    </div>
</header>
