<div class="sidebar dark:bg-coal-600 bg-gray-900 border-r border-r-gray-200 dark:border-r-coal-100 fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0" data-drawer="true" data-drawer-class="drawer drawer-start top-0 bottom-0" data-drawer-enable="true|lg:false" id="sidebar">
    <div class="sidebar-header hidden lg:flex items-center relative justify-center px-3 lg:px-6 shrink-0" id="sidebar_header">
        <a class="dark:hidden" href="">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/logo.svg') }}"/>
            <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/mini-logo.svg') }}"/>
        </a>
        <a class="hidden dark:block" href="html/demo1.html">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/logo.svg') }}"/>
            <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/mini-logo.svg') }}"/>
        </a>
        <button class="btn btn-icon btn-icon-md size-[30px] rounded-lg border border-gray-200 dark:border-gray-300 bg-light text-gray-500 hover:text-gray-700 toggle absolute left-full top-2/4 -translate-x-2/4 -translate-y-2/4" data-toggle="body" data-toggle-class="sidebar-collapse" id="sidebar_toggle">
            <i class="ki-filled ki-black-left-line toggle-active:rotate-180 transition-all duration-300"></i>
        </button>
    </div>

    <div class="sidebar-content flex grow shrink-0 py-5 pr-2" id="sidebar_content">
        <div class="scrollable-y-hover grow shrink-0 flex pl-2 lg:pl-5 pr-1 lg:pr-3" data-scrollable="true" data-scrollable-dependencies="#sidebar_header" data-scrollable-height="auto" data-scrollable-offset="0px" data-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">
            <div class="menu flex flex-col grow gap-0.5" data-menu="true" data-menu-accordion-expand-all="false" id="sidebar_menu">
                
                <div class="flex justify-center gap-6">
                    <div class="relative">
                     <i class="ki-outline ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 left-0 -translate-y-1/2 ml-3">
                     </i>
                     <input class="input input-sm pl-8 rounded-full" placeholder="Cari" type="text"/>
                    </div>
                   </div>

                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <div class="menu-item pt-2.25 pb-px">
                        <span class="menu-heading uppercase text-2sm font-semibold text-gray-500 pl-[10px] pr-[10px] py-5">
                            Proyek
                        </span>
                    </div>

                    @foreach ($products as $product)
                    <a href="{{$product->id}}" class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                        <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                            <i class="ki-duotone ki-user text-lg menu-link-hover:!text-primary"></i>
                        </span>
                        <span class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
                            {{$product->name}}
                        </span>
                    </a>
                    @endforeach                                                                                                                                                                                                                       

                    <a href="/add-product" class="flex justify-center inline-block px-2 py-2 border-2 border-dashed border-gray-400 rounded-full text-gray-400 text-sm">
                        <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35px" height="20px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Navigation / Plus</title>
                            <desc>Created with Sketch.</desc>
                            <defs/>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect fill="#636674" x="4" y="11" width="16" height="2" rx="1"/>
                                <rect fill="#636674" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                            </g>
                        </svg></span>Tambah Produk
                    </a>                    

                    <div class="menu-item pt-2.25 pb-px">
                        <span class="menu-heading uppercase text-2sm font-semibold text-gray-500 pl-[10px] pr-[10px] pt-5 pb-2">
                            Sistem
                        </span> 
                    </div>

                    <a href="/user" class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                        <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                            <i class="ki-duotone ki-user text-lg menu-link-hover:!text-primary"></i>
                        </span>
                        <span class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Pengguna
                        </span>
                    </a>

                    <a href="/pengaturan" class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                        <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                            <i class="ki-duotone ki-setting-2 text-lg menu-link-hover:!text-primary"></i>
                        </span>
                        <span class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Pengaturan
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>