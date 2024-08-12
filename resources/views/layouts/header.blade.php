<header class="header fixed top-0 z-10 left-0 right-0 flex items-stretch shrink-0 bg-[#fefefe] dark:bg-coal-500" data-sticky="true" data-sticky-class="shadow-sm dark:border-b dark:border-b-coal-100" data-sticky-name="header" id="header">
    <div class="container-fixed flex justify-between items-stretch lg:gap-4" id="header_container">
        <div class="flex gap-1 lg:hidden items-center -ml-1">
            <a class="shrink-0" href="html/demo1.html">
                <img class="max-h-[25px] w-full" src="{{ asset('metronic/dist/assets/media/app/mini-logo.svg') }}"/>
            </a>
            <div class="flex items-center">
            <button class="btn btn-icon btn-light btn-clear btn-sm" data-drawer-toggle="#sidebar">
                <i class="ki-filled ki-menu"></i>
            </button>
            <button class="btn btn-icon btn-light btn-clear btn-sm" data-drawer-toggle="#megamenu_wrapper">
                <i class="ki-filled ki-burger-menu-2"></i>
            </button>
            </div>
        </div>

        <div class="flex items-stretch" id="megamenu_container">
            <div class="flex items-stretch" data-reparent="true" data-reparent-mode="prepend|lg:prepend" data-reparent-target="body|lg:#megamenu_container">
                <div class="hidden lg:flex lg:items-stretch" data-drawer="true" data-drawer-class="drawer drawer-start fixed z-10 top-0 bottom-0 w-full mr-5 max-w-[250px] p-5 lg:p-0 overflow-auto" data-drawer-enable="true|lg:false" id="megamenu_wrapper">
                    <div class="menu flex-col lg:flex-row gap-5 lg:gap-7.5" data-menu="true" id="megamenu">
                        <div class="menu-item active">
                            <a href="/home" class="menu-link text-nowrap text-sm text-gray-700 font-medium menu-item-hover:text-primary menu-item-active:text-gray-900 menu-item-active:font-semibold" href="html/demo1.html">
                                <span class="menu-title text-nowrap">
                                    Sistem
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex items-center gap-2 lg:gap-3.5">
            <div class="menu" data-menu="true">
                <div class="menu-item" data-menu-item-offset="20px, 10px" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                    <div class="menu-toggle btn btn-icon rounded-full">
                        <img alt="" class="size-9 rounded-full shrink-0" src="{{ asset('metronic/dist/assets/media/avatars/300-2.png') }}"></img>
                    </div>
                    <div class="menu-dropdown menu-default light:border-gray-300 w-full max-w-[250px]">                
                        <div class="flex items-center justify-between px-5 py-1.5 gap-1.5">
                            <div class="flex items-center gap-2">
                                <img alt="" class="size-9 rounded-full" src="{{ asset('metronic/dist/assets/media/avatars/300-2.png') }}">
                                    <div class="flex flex-col gap-1.5">
                                        <span class="text-sm text-gray-800 font-semibold leading-none">
                                            Brofit Jackson Pierce
                                        </span>
                                        <a class="text-xs text-gray-600 hover:text-primary font-medium leading-none" href="html/demo1/account/home/get-started.html">
                                            brofit.design@gmail.com
                                        </a>
                                    </div>
                                </img>
                            </div>
                        </div>
                        <div class="menu-separator"></div>
                        <div class="flex flex-col" data-menu-dismiss="true">
                            <div class="menu-item">
                                <a class="menu-link" href="#">
                                    <span class="menu-icon">
                                        <i class="ki-filled ki-profile-circle"></i>
                                    </span>
                                    <span class="menu-title">
                                        My Profile
                                    </span>
                                </a>
                            </div>
                            <div class="menu-item" data-menu-item-offset="-50px, 0" data-menu-item-placement="left-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:hover">
                                <div class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-filled ki-setting-2"></i>
                                    </span>
                                    <span class="menu-title">
                                        Keamanan
                                    </span>
                                    <span class="menu-arrow">
                                        <i class="ki-filled ki-right text-3xs"></i>
                                    </span>
                                </div>
                                <div class="menu-dropdown menu-default light:border-gray-300 w-full max-w-[220px]">
                                    <div class="menu-item">
                                        <a class="menu-link" href="html/demo1/account/security/overview.html">
                                            <span class="menu-icon">
                                                <i class="ki-filled ki-medal-star"></i>
                                            </span>
                                            <span class="menu-title">
                                                Security
                                            </span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link" href="html/demo1/account/members/teams.html">
                                            <span class="menu-icon">
                                                <i class="ki-filled ki-setting"></i>
                                            </span>
                                            <span class="menu-title">
                                                Members &amp; Roles
                                            </span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link" href="html/demo1/account/integrations.html">
                                            <span class="menu-icon">
                                                <i class="ki-filled ki-switch"></i>
                                            </span>
                                            <span class="menu-title">
                                                Integrations
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-separator"></div>
                        <div class="flex flex-col">
                            <div class="menu-item mb-0.5">
                                <div class="menu-link">
                                    <span class="menu-icon">
                                        <i class="ki-filled ki-moon"></i>
                                    </span>
                                    <span class="menu-title">
                                        Dark Mode
                                    </span>
                                    <label class="switch switch-sm">
                                        <input data-theme-state="dark" data-theme-toggle="true" name="check" type="checkbox" value="1"></input>
                                    </label>
                                </div>
                            </div>
                            <div class="menu-item px-4 py-1.5">
                                <a class="btn btn-sm btn-light justify-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>