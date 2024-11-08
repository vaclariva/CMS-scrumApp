<div class="flex items-center gap-2 lg:gap-3.5">
    <div class="menu" data-menu="true">
        <div class="menu-item" data-menu-item-offset="20px, 10px" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
            <div class="menu-toggle btn btn-icon rounded-full">
                <img alt="{{Auth::user()->name}}" class="size-9 rounded-full border-2 border-success shrink-0" src="{{ Auth::user()->image ? asset('/storage/' . Auth::user()->image) : asset('metronic/dist/assets/media/avatars/blank.png')}}"></img>
            </div>
            <div class="menu-dropdown menu-default light:border-gray-300 w-full max-w-[250px]">
                <div class="flex items-center justify-between px-5 py-1.5 gap-1.5">
                    <div class="flex items-center gap-2">
                        <img alt="{{Auth::user()->name}}" class="size-9 rounded-full border-2 border-success shrink-0" src="{{ Auth::user()->image ? asset('/storage/' . Auth::user()->image) : asset('metronic/dist/assets/media/avatars/blank.png')}}">
                        <div class="flex flex-col gap-1.5">
                            <span class="text-sm text-gray-800 font-semibold leading-none">
                                {{Auth::user()->name}}
                            </span>
                            <a class="text-xs text-gray-600 hover:text-primary font-medium leading-none" href="html/demo1/account/home/get-started.html">
                                {{Auth::user()->email}}
                            </a>
                        </div>
                        </img>
                    </div>
                </div>
                <div class="menu-separator"></div>
                <div class="flex flex-col" data-menu-dismiss="true">
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('profile.edit')}}">
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
                                <a class="menu-link" href="{{route('settings.twofactors.index')}}">
                                    <span class="menu-icon">
                                        <i class="ki-filled ki-medal-star"></i>
                                    </span>
                                    <span class="menu-title">
                                        Security 2FA
                                    </span>
                                </a>
                            </div>
                            <!-- <div class="menu-item">
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
                                <a class="menu-link" href="/two-factor">
                                    <span class="menu-icon">
                                        <i class="ki-filled ki-switch"></i>
                                    </span>
                                    <span class="menu-title">
                                        Integrations
                                    </span>
                                </a>
                            </div> -->
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