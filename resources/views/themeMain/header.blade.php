<header class="header" id="header">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="header__left">
            <h1 class="text-primary">IT Recurrent</h1>
        </div>
        <div class="header__nav">
            <ul class="menu-primary default-ul d-flex align-items-center justify-content-between">
                <li class="mr-3">
                    <a href="{{route('home')}}">
                        <span class="text-capitalize text-dark font-16 font-weight-semibold">Home</span>
                    </a>
                </li>
                <li class="mr-3">
                    <a href="{{route('jobs-page')}}">
                        <span class="text-capitalize text-dark font-16 font-weight-semibold">Find Job</span>
                    </a>
                </li>
                <li class="mr-3">
                    <a href="#">
                        <span class="text-capitalize text-dark font-16 font-weight-semibold">Company</span>
                    </a>
                </li>
                <li class="mr-3">
                    <a href="#">
                        <span class="text-capitalize text-dark font-16 font-weight-semibold">blog</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="header__right align-items-center d-flex">
            <div class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    @if($locale === 'vi')
                        <img style="with:20px; height: 20px " src="{{asset('img/vi.png')}}" alt="vi" class="mr-1"
                             height="12">
                        <span class="align-middle">{{__('frontPage.viLang')}}</span>
                    @else
                        <img style="with:20px; height: 20px " src="{{asset('img/en.png')}}" alt="en" class="mr-1"
                             height="12">
                        <span class="align-middle">{{__('frontPage.enLang')}}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu" style="">
                    <!-- item-->
                    <a href="{{route('language','en')}}" class="dropdown-item notify-item">
                        <img style="with:20px; height: 20px " src="{{asset('img/en.png')}}" alt="en" class="mr-1"
                             height="12">
                        <span class="align-middle">{{__('frontPage.enLang')}}</span>
                    </a>
                    <!-- item-->
                    <a href="{{route('language','vi')}}" class="dropdown-item notify-item">
                        <img style="with:20px; height: 20px " src="{{asset('img/vi.png')}}" alt="vi" class="mr-1"
                             height="12">
                        <span class="align-middle">{{__('frontPage.viLang')}}</span>
                    </a>
                </div>
            </div>
            @if(auth()->check())
                <div class="block__action">
                    <a href="{{route('logout')}}" class="btn mr-2 text-dark"><u>{{__('frontPage.logout')}}</u></a>
                </div>
            @else
                <div class="block__action">
                    <a href="{{route('register')}}" class="btn mr-2 text-dark"><u>{{__('frontPage.register')}}</u></a>
                    <a href="{{route('login')}}" class="btn btn-primary rounded-lg">{{__('frontPage.login')}}</a>
                </div>
            @endif


        </div>

    </div>
</header>
