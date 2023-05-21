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

    <div class="h-100 mm-active" id="left-side-menu-container" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">
                            @includeWhen(isAdmin(), 'layout.sidebar.admin')
                            @includeWhen(isHr(), 'layout.sidebar.hr')
                            @includeWhen(isApplicant(), 'layout.sidebar.applicant')
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
