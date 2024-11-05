<header class="header fixed top-0 z-10 left-0 right-0 flex items-stretch shrink-0 bg-[#fefefe] dark:bg-coal-500 border-b border-gray-300 dark:border-coal-100" data-sticky-class="shadow-sm" data-sticky-name="header" id="header">
    <div class="container-fixed flex justify-between items-stretch lg:gap-4" id="header_container">
        <div class="flex gap-1 lg:hidden items-center -ml-1">
            <a class="shrink-0" href="/">
                <img class="max-h-[25px] w-full" src="{{ asset('metronic/dist/assets/media/app/mini-logo.svg') }}" />
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
                            <nav aria-label="Breadcrumb" class="mt-5">
                                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                    <li>
                                        <a href="{{ route('home') }}" class="menu-link text-nowrap text-sm text-gray-500 font-medium hover:text-primary active:text-gray-900 active:font-semibold pr-2">Sistem</a>
                                    </li>

                                    @if(isset($breadcrumb))
                                    @foreach($breadcrumb as $item)
                                    <li class="flex items-center">
                                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="14px" viewBox="0 0 24 24" version="1.1">
                                                <title>Stockholm-icons / Navigation / Angle-right</title>
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                    <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#6B7280" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-270.000000) translate(-12.000003, -11.999999) " />
                                                </g>
                                            </svg>
                                        </span>

                                        @if (!$loop->last)
                                        <a href="{{ $item['url'] }}" class="text-gray-500 hover:text-primary text-sm font-medium px-2">
                                            {{ $item['title'] }}
                                        </a>
                                        @else
                                        <span class="menu-link text-nowrap text-sm text-gray-700 font-medium active:text-gray-900 active:font-semibold px-2">
                                            {{ $item['title'] }}
                                        </span>
                                        @endif
                                    </li>
                                    @endforeach
                                    @endif
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.profile')
    </div>
</header>