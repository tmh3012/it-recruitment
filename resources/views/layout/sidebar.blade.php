<div class="left-side-menu mm-show">

    <!-- LOGO -->
    <a href="#" class="logo text-center logo-light">
        <span class="logo-lg font-24 font-weight-bold text-white">
          {{ config('app.name') }}
        </span>
        <span class="logo-sm font-24 font-weight-bold text-white">
           {{ config('app.name') }}
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="" alt="" height="16">
        </span>
    </a>

    <div class="h-100 mm-active" id="left-side-menu-container" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">
                            @if(isAdmin())
                                <!--- Sidemenu for Admin-->
                                <ul class="side-nav">
                                    <li class="side-nav-title side-nav-item">Manage</li>
                                    <li class="side-nav-item">
                                        <a href="{{ route('admin.users.index') }}" class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Users </span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="{{ route('admin.posts.index') }} " class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Posts </span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="{{ route('admin.companies.index') }} " class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Company </span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="{{ route('admin.blog.index') }} " class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Blog </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="side-nav-link" data-toggle="collapse" href="#config"
                                           role="button" aria-expanded="false" aria-controls="config">
                                            <i class="fa-solid fa-gears"></i>
                                            <span>Config</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <div class="collapse" id="config">
                                            <ul class="side-nav-second-level">
                                                <li><a href="{{route('admin.config.indexText')}}">Config System</a></li>
                                                <li><a href="{{route('admin.config.report.index')}}">Config Web</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            @elseif(isHr())
                                <!--- Sidemenu for Hr-->
                                <ul class="side-nav">
                                    <li class="side-nav-title side-nav-item">Manage</li>
                                    <li class="side-nav-item">
                                        <a href="{{route('hr.posts.index')}}" class="side-nav-link">
                                            <i class="uil-home-alt"></i>
                                            <span> Post </span>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 100px;"></div>
        </div>
    </div>
    <!-- Sidebar -left -->
</div>
