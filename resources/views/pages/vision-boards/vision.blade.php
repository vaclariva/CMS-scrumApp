<div class="vision-board-section space-y-5">
        @if ($visionBoards->isEmpty())
            <p class="p-8 text-gray-500">Belum ada vision board</p>
        @else
            @foreach ($visionBoards as $item)
                <div class="vision-board">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title custom-" contenteditable="true" data-id="{{ $item->id }}" id="item-name-{{ $item->id }}">
                                {{ $item->name }}
                            </h3>
                            <div class="flex gap-2 items-center">
                                <a class="menu-link" onclick="openEditModalVision({
                                    id: {{ $item->id }},
                                    name: '{{ $item->name }}',
                                    vision: '{!! $item->vision !!}',
                                    target_group: '{!! $item->target_group !!}',
                                    needs: '{!! $item->needs !!}',
                                    product: '{!! $item->product !!}',
                                    business_goals: '{!! $item->business_goals !!}',
                                    competitors: '{!! $item->competitors !!}',
                                    url_update: '{{ route('visionBoard.update', [$product->id, $item->id]) }}'
                                })">
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
                                                <form action="{{ route('visionBoard.duplicate', ['product' => $product->id, 'visionBoard' => $item->id]) }}" method="POST" class="mb-1">
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
                                                    id: {{ $item->id }},
                                                    name: '{{ $item->name }}',
                                                    url_delete: '{{ route('visionBoard.destroy', [$product->id, $item->id]) }}'
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
                                @if (
                                    !$item->vision &&
                                    !$item->target_group &&
                                    !$item->needs &&
                                    !$item->product &&
                                    !$item->business_goals
                                )
                                    <!-- No content needed here -->
                                @else
                                    <div class="card-toolbar rotate">
                                        <i class="ki-duotone ki-down fs-1"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
    
                        <div class="card-body-vision">
                            @if($item->vision)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Vision (Visi) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->vision !!}</div>
                                </div>
                            @endif
                        
                            @if($item->target_group)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Target Group (Kelompok Sasaran) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->target_group !!}</div>
                                </div>
                            @endif
                        
                            @if($item->needs)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Needs (Kebutuhan) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->needs !!}</div>
                                </div>
                            @endif
                        
                            @if($item->product)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Product (Product) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->product !!}</div>
                                </div>
                            @endif
                        
                            @if($item->business_goals)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Business Goals (Tujuan Bisnis) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->business_goals !!}</div>
                                </div>
                            @endif
                        
                            @if($item->competitors)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Competitors (Pesaing) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->competitors !!}</div>
                                </div>
                            @endif
                        </div>                        
                    </div>
                </div>
            @endforeach
        @endif
    </div>