<div class="backlog-section space-y-5">
    <div class="backlog">
        @if ($backlogs->isEmpty())
        <p class="p-8 text-gray-500">Belum ada vision board</p>
        @else
            @foreach ($backlogs as $backlog)
                <div class="vision-board">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title custom-" contenteditable="true" data-id="{{ $backlog->id }}" id="name-{{ $backlog->id }}">
                                {{ $backlog->name }}
                            </h3>
                            <div class="flex gap-2 items-center">
                                <a class="menu-link" onclick="" data-drawer-toggle="#drawer_4">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-notepad-edit text-xl"></i>
                                    </span>
                                </a>
                                <div class="dropdown relative" data-dropdown="true" data-dropdown-placement="bottom-end" data-dropdown-trigger="click">
                                    <button class="dropdown-toggle btn hover:text-gray-50">
                                        <i class="ki-filled ki-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-content absolute left-0 mt-2 w-full max-w-56 py-2 bg-white shadow-lg z-10">
                                        <div class="menu menu-default flex flex-col w-full">
                                            <div class="menu-item">
                                                <form action="" method="POST" class="mb-1">
                                                    @csrf
                                                    <button type="submit" class="text-xs w-full">
                                                        <div class="flex items-center pl-5 menu-link">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-copy"></i>
                                                            </span>
                                                            <span class="menu-title">Duplikat</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" onclick="">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-trash"></i>
                                                    </span>
                                                    <span class="menu-title">Hapus</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="card">
            <div class="card-body title-backlog">
                Centralize your team information with our management tools. Access detailed instructions, expert advice, and technical documentation to maintain an up-to-date team directory.
            </div>
            <div class="flex justify-between">
                <div class="px-7 pb-4 flex items-center gap-4">
                    <span class="badge badge-primary badge-pill badge-outline gap-1.5">
                        <span class="badge badge-dot badge-primary size-1.5">
                        </span>
                        New
                    </span>
                    <i class="ki-duotone ki-textalign-left"></i>
                    <div class="flex text-success items-center text-xs">
                        <i class="ki-duotone ki-check-squared text-success text-lg"></i>
                        10/10
                    </div>
                    <div class="flex items-center text-xs">
                        <i class="ki-duotone ki-timer text-lg "></i>
                        <span class="ml-2">4 Jam</span>
                    </div>
                    <div class="flex items-center text-xs text-success">
                        <i class="ki-duotone ki-flag text-lg"></i>
                        <span class="ml-2">Selesai</span>
                    </div>
                    <div class="flex items-center">
                        <div class="menu-toggle btn btn-icon rounded-full">
                            @if($productOwner->image)
                            <img src="{{ asset('/storage/'. $productOwner->image) }}" alt="{{Auth::user()->name}}" class="w-5 h-5 rounded-full object-cover">
                            @else
                            <img src="{{ asset('metronic/dist/assets/media/avatars/blank.png') }}" alt="Default Image" class="w-5 h-5 rounded-full object-cover">
                            @endif
                        </div>
                        <span class="text-xs">{{$productOwner->name}}</span>
                    </div>
                </div>
                <div>
                    <div class="dropdown relative" data-dropdown="true" data-dropdown-placement="bottom-end" data-dropdown-trigger="click">
                        <button class="dropdown-toggle btn hover:text-gray-50">
                            <i class="ki-filled ki-dots-vertical"></i>
                        </button>
                        <div class="dropdown-content absolute left-0 mt-2 w-full max-w-56 py-2 bg-white shadow-lg z-10">
                            <div class="menu menu-default flex flex-col w-full">
                                <div class="menu-item">
                                    <a class="menu-link" onclick="openDeleteModalVision({
                                    })">
                                        <span class="menu-icon">
                                            <i class="ki-duotone ki-notepad-edit"></i>
                                        </span>
                                        <span class="menu-title">Edit</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <form action="" method="POST" class="mb-1">
                                        @csrf
                                        <button type="submit" class="text-xs w-full">
                                            <div class="flex items-center pl-5 menu-link">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-copy"></i>
                                                </span>
                                                <span class="menu-title">Duplikat</span>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" onclick="openDeleteModalVision({
                                    })">
                                        <span class="menu-icon">
                                            <i class="ki-duotone ki-file-down"></i>
                                        </span>
                                        <span class="menu-title">Unduh PDF</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link" onclick="openDeleteModalVision({
                                    })">
                                        <span class="menu-icon">
                                            <i class="ki-duotone ki-trash"></i>
                                        </span>
                                        <span class="menu-title">Hapus</span>
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