<div class="sidebar dark:bg-coal-600 bg-light border-r border-r-gray-200 dark:border-r-coal-100 fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0" data-drawer="true" data-drawer-class="drawer drawer-start top-0 bottom-0" data-drawer-enable="true|lg:false" id="sidebar">
    <div class="sidebar-header hidden lg:flex items-center relative justify-between px-3 lg:px-6 shrink-0" id="sidebar_header">
        <a class="dark:hidden" href="html/demo1.html">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/default-logo.svg') }}"/>
            <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/mini-logo.svg') }}"/>
        </a>
        <a class="hidden dark:block" href="html/demo1.html">
            <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/default-logo-dark.svg') }}"/>
            <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('metronic/dist/assets/media/app/mini-logo.svg') }}"/>
        </a>
        <button class="btn btn-icon btn-icon-md size-[30px] rounded-lg border border-gray-200 dark:border-gray-300 bg-light text-gray-500 hover:text-gray-700 toggle absolute left-full top-2/4 -translate-x-2/4 -translate-y-2/4" data-toggle="body" data-toggle-class="sidebar-collapse" id="sidebar_toggle">
            <i class="ki-filled ki-black-left-line toggle-active:rotate-180 transition-all duration-300"></i>
        </button>
    </div>
    <div class="sidebar-content flex grow shrink-0 py-5 pr-2" id="sidebar_content">
        <div class="scrollable-y-hover grow shrink-0 flex pl-2 lg:pl-5 pr-1 lg:pr-3" data-scrollable="true" data-scrollable-dependencies="#sidebar_header" data-scrollable-height="auto" data-scrollable-offset="0px" data-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">
            <div class="menu flex flex-col grow gap-0.5" data-menu="true" data-menu-accordion-expand-all="false" id="sidebar_menu">
                <div class="menu-item" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                    <div class="menu-item pt-2.25 pb-px">
                        <span class="menu-heading uppercase text-2sm font-semibold text-gray-500 pl-[10px] pr-[10px]">
                            Dashboards
                        </span>
                    </div>
                    <a href="/home" class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                        <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                            <i class="ki-filled ki-element-11 text-lg text-info"></i>
                        </span>
                        <span class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Dashboards
                        </span>
                    </a>
                    <div class="menu-item pt-2.25 pb-px">
                        <span class="menu-heading uppercase text-2sm font-semibold text-gray-500 pl-[10px] pr-[10px]">
                            User
                        </span>
                    </div>
                    <a href="/member" class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                        <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                            <i class="ki-filled ki-user-square text-lg text-info"></i>
                        </span>
                        <span class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
                            Members
                        </span>
                    </a>
                    <div class="menu-item here menu-item-accordion show" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                        <div class="menu-link flex items-center grow cursor-pointer border border-transparent gap-[10px] pl-[10px] pr-[10px] py-[6px]" tabindex="0">
                         <span class="menu-icon items-start text-gray-500 dark:text-gray-400 w-[20px]">
                          <i class="ki-filled ki-profile-circle text-lg">
                          </i>
                         </span>
                         <span class="menu-title text-sm font-semibold text-gray-700 menu-item-active:text-primary menu-link-hover:!text-primary">
                          Public Profile
                         </span>
                         <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                          <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                          </i>
                          <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                          </i>
                         </span>
                        </div>
                        <div class="menu-accordion gap-0.5 pl-[10px] relative before:absolute before:left-[20px] before:top-0 before:bottom-0 before:border-l before:border-gray-200 show" style="">
                         <div class="menu-item menu-item-accordion" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                          <div class="menu-link border border-transparent grow cursor-pointer gap-[14px] pl-[10px] pr-[10px] py-[8px]" tabindex="0">
                           <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                           </span>
                           <span class="menu-title text-2sm font-medium mr-1 text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                            Profiles
                           </span>
                           <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                            <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                            </i>
                            <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                            </i>
                           </span>
                          </div>
                          <div class="menu-accordion gap-0.5 relative before:absolute before:left-[32px] pl-[22px] before:top-0 before:bottom-0 before:border-l before:border-gray-200">
                           <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/profiles/default" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              Default
                             </span>
                            </a>
                           </div>
                           <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/profiles/creator" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              Creator
                             </span>
                            </a>
                           </div>
                           <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/profiles/company" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              Company
                             </span>
                            </a>
                           </div>
                           <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/profiles/nft" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              NFT
                             </span>
                            </a>
                           </div>
                           <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/profiles/blogger" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              Blogger
                             </span>
                            </a>
                           </div>
                           <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/profiles/crm" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              CRM
                             </span>
                            </a>
                           </div>
                           <div class="menu-item flex-col-reverse menu-item-accordion" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                            <div class="menu-link border border-transparent grow cursor-pointer gap-[5px] pl-[10px] pr-[10px] py-[8px]" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-500 dark:text-gray-400">
                              <span class="hidden menu-item-show:!flex">
                               Show less
                              </span>
                              <span class="flex menu-item-show:hidden">
                               Show 4 more
                              </span>
                             </span>
                             <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                              <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                              </i>
                              <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                              </i>
                             </span>
                            </div>
                            <div class="menu-accordion gap-0.5">
                             <div class="menu-item">
                              <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/profiles/gamer" tabindex="0">
                               <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                               <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Gamer
                               </span>
                              </a>
                             </div>
                             <div class="menu-item">
                              <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/profiles/feeds" tabindex="0">
                               <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                               <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Feeds
                               </span>
                              </a>
                             </div>
                             <div class="menu-item">
                              <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/profiles/plain" tabindex="0">
                               <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                               <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Plain
                               </span>
                              </a>
                             </div>
                             <div class="menu-item">
                              <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/profiles/modal" tabindex="0">
                               <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                               </span>
                               <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                                Modal
                               </span>
                              </a>
                             </div>
                            </div>
                           </div>
                          </div>
                         </div>
                         <div class="menu-item here menu-item-accordion" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                          <div class="menu-link border border-transparent grow cursor-pointer gap-[14px] pl-[10px] pr-[10px] py-[8px]" tabindex="0">
                           <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                           </span>
                           <span class="menu-title text-2sm font-medium mr-1 text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                            Projects
                           </span>
                           <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                            <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                            </i>
                            <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                            </i>
                           </span>
                          </div>
                          <div class="menu-accordion gap-0.5 relative before:absolute before:left-[32px] pl-[22px] before:top-0 before:bottom-0 before:border-l before:border-gray-200" style="height: 0px;">
                           <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/projects/3-columns" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              3 Columns
                             </span>
                            </a>
                           </div>
                           <div class="menu-item active">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[5px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/projects/2-columns" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              2 Columns
                             </span>
                            </a>
                           </div>
                          </div>
                         </div>
                         <div class="menu-item">
                          <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/works" tabindex="0">
                           <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                           </span>
                           <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                            Works
                           </span>
                          </a>
                         </div>
                         <div class="menu-item">
                          <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/teams" tabindex="0">
                           <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                           </span>
                           <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                            Teams
                           </span>
                          </a>
                         </div>
                         <div class="menu-item">
                          <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/network" tabindex="0">
                           <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                           </span>
                           <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                            Network
                           </span>
                          </a>
                         </div>
                         <div class="menu-item">
                          <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/activity" tabindex="0">
                           <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                           </span>
                           <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                            Activity
                           </span>
                          </a>
                         </div>
                         <div class="menu-item flex-col-reverse menu-item-accordion" data-menu-item-toggle="accordion" data-menu-item-trigger="click">
                          <div class="menu-link border border-transparent grow cursor-pointer gap-[14px] pl-[10px] pr-[10px] py-[8px]" tabindex="0">
                           <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                           </span>
                           <span class="menu-title text-2sm font-medium text-gray-500 dark:text-gray-400">
                            <span class="hidden menu-item-show:!flex">
                             Show less
                            </span>
                            <span class="flex menu-item-show:hidden">
                             Show 3 more
                            </span>
                           </span>
                           <span class="menu-arrow text-gray-400 w-[20px] shrink-0 justify-end ml-1 mr-[-10px]">
                            <i class="ki-filled ki-plus text-2xs menu-item-show:hidden">
                            </i>
                            <i class="ki-filled ki-minus text-2xs hidden menu-item-show:inline-flex">
                            </i>
                           </span>
                          </div>
                          <div class="menu-accordion gap-0.5">
                           <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/campaigns/card" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              Campaigns - Card
                             </span>
                            </a>
                           </div>
                           <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/campaigns/list" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              Campaigns - List
                             </span>
                            </a>
                           </div>
                           <div class="menu-item">
                            <a class="menu-link border border-transparent items-center grow menu-item-active:bg-secondary-active dark:menu-item-active:bg-coal-300 dark:menu-item-active:border-gray-100 menu-item-active:rounded-lg hover:bg-secondary-active dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg gap-[14px] pl-[10px] pr-[10px] py-[8px]" href="/metronic/tailwind/demo1/public-profile/empty" tabindex="0">
                             <span class="menu-bullet flex w-[6px] relative before:absolute before:top-0 before:size-[6px] before:rounded-full before:-translate-x-1/2 before:-translate-y-1/2 menu-item-active:before:bg-primary menu-item-hover:before:bg-primary">
                             </span>
                             <span class="menu-title text-2sm font-medium text-gray-700 menu-item-active:text-primary menu-item-active:font-semibold menu-link-hover:!text-primary">
                              Empty
                             </span>
                            </a>
                           </div>
                          </div>
                         </div>
                        </div>
                       </div>
                </div>
            </div>
        </div>
    </div>
</div>