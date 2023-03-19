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
