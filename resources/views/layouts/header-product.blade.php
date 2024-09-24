<header class="header header-product fixed top-0 z-10 left-0 right-0 flex items-stretch shrink-0 bg-white dark:bg-coal-500 border-b border-red-700 dark:border-coal-100" id="header">
    <div class="container-fixed mx-auto lg:px-8 flex justify-between items-stretch lg:gap-4" id="header_container">
        <div class="flex gap-1 lg:hidden items-center -ml-1">
            <a class="shrink-0" href="html/demo1.html">
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
                            <div class="items-center">
                                <div class="flex items-center gap-2.5">
                                    <i class="{{ $product->icon }} mt-5"></i>
                                    <h3 class="text-xl font-semibold text-gray-900 leading-none mt-5 pr-5">
                                        {{ $product->name }}
                                    </h3>
                                    <span class="badge badge-success badge-pill badge-outline gap-1.5 mt-5 py-1.5">
                                        <span class="badge badge-dot badge-success size-1.5"></span>
                                        {{ $product->label }}
                                    </span>
                                </div>
                                <div class="flex items-center font-medium ">
                                    <span class="text-2sm text-gray-600 me-1.5 mb-2 mt-0.5 flex items-center">
                                        {{ $product->start_date->translatedFormat('d F Y, H:i') }} - {{ $product->end_date->translatedFormat('d F Y, H:i') }} •
                                        <div class="menu-toggle btn btn-icon rounded-full">
                                            @if($productOwner->image)
                                            <img src="{{ asset('/storage/'. $productOwner->image) }}" alt="{{Auth::user()->name}}" class="w-5 h-5 rounded-full object-cover">
                                            @else
                                            <img src="{{ asset('metronic/dist/assets/media/avatars/blank.png') }}" alt="Default Image" class="w-5 h-5 rounded-full object-cover">
                                            @endif
                                        </div>
                                        {{$productOwner->name}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.profile')
    </div>
</header>