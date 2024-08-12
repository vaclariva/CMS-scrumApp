<div class="sidebar dark:bg-coal-600 bg-black border-r border-r-gray-200 dark:border-r-coal-100 fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0" data-drawer="true" data-drawer-class="drawer drawer-start top-0 bottom-0" data-drawer-enable="true|lg:false" id="sidebar">
    <div class="sidebar-header hidden lg:flex items-center relative justify-between px-3 lg:px-6 shrink-0" id="sidebar_header">
        <a class="dark:hidden" href="">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/logo.svg') }}"/>
            <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/logo.svg') }}"/>
        </a>
        <button class="btn btn-icon btn-icon-md size-[30px] rounded-lg border border-gray-200 dark:border-gray-300 bg-light text-gray-500 hover:text-gray-700 toggle absolute left-full top-2/4 -translate-x-2/4 -translate-y-2/4" data-toggle="body" data-toggle-class="sidebar-collapse" id="sidebar_toggle">
            <i class="ki-filled ki-black-left-line toggle-active:rotate-180 transition-all duration-300"></i>
        </button>
    </div>
    <div class="sidebar-content flex grow shrink-0 py-5 pr-2" id="sidebar_content">
        <div class="scrollable-y-hover grow shrink-0 flex pl-2 lg:pl-5 pr-1 lg:pr-3" data-scrollable="true" data-scrollable-dependencies="#sidebar_header" data-scrollable-height="auto" data-scrollable-offset="0px" data-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">
            <div class="menu flex flex-col grow gap-0.5" data-menu="true" data-menu-accordion-expand-all="false" id="sidebar_menu">
                
                <div class="flex gap-6">
                    <div class="relative">
                     <i class="ki-outline ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 left-0 -translate-y-1/2 ml-3">
                     </i>
                     <input class="input input-sm pl-8 rounded-full" placeholder="Cari" type="text"/>
                    </div>
                   </div>

                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <div class="menu-item pt-2.25 pb-px">
                        <span class="menu-heading uppercase text-2sm font-semibold text-gray-500 pl-[10px] pr-[10px]">
                            Proyek
                        </span>
                    </div>

                    <div class="menu-item pt-2.25 pb-px">
                        <span class="menu-heading uppercase text-2sm font-semibold text-gray-500 pl-[10px] pr-[10px]">
                            Sistem
                        </span>
                    </div>
                    <a href="/pengguna" class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
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