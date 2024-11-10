<div class="vision-board-section space-y-5">
    @if ($visionBoards->isEmpty())
        <p class="p-8 text-gray-500">Belum ada vision board</p>
    @else
        @foreach ($visionBoards as $item)
            <div class="vision-board" id="vision-board-{{ $item->id }}">
                <div class="card mb-3">
                    <div class="card-header">
                        <input type="text" class="card-title title-card-vision cstm-input" data-product-id="{{ $item->product_id }}" data-id="{{ $item->id }}" id="name-{{ $item->id }}" value="{{ $item->name }}">
                        <div class="flex gap-2 items-center">
                            <a class="menu-link" id="vision-board-btn-{{ $item->id }}" onclick="openEditModalVision({
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
                                <button class="dropdown-toggle btn hover:text-gray-50" id="dropdown-toggle-{{ $item->id }}">
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
                            <div class="card-toolbar rotate"  id="dropdown-toggle-{{ $item->id }}">
                                <i class="ki-duotone ki-down fs-1"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body-vision" id="card-body-vision-{{ $item->id }}">
                        <div id="item-vision-{{ $item->id }}">
                            @if(!empty($item->vision))
                            <div class="mb-5">
                                <span class="px-2.5" style="font-weight: 500;"> • Vision (Visi) </span><br>
                                <div class="board-sub vision text-gray-600">{!! $item->vision !!}</div>
                            </div>
                            @endif
                        </div>
                        
                        <div id="item-target-group-{{ $item->id }}">
                            @if(!empty($item->target_group))
                            <div class="mb-5">
                                <span class="px-2.5" style="font-weight: 500;"> • Target Group (Kelompok Sasaran) </span><br>
                                <div class="board-sub target-group text-gray-600" >{!! $item->target_group !!}</div>
                            </div>
                            @endif
                        </div>
                        
                        <div id="item-needs-{{ $item->id }}">
                            @if(!empty($item->needs))
                            <div class="mb-5">
                                <span class="px-2.5" style="font-weight: 500;"> • Needs (Kebutuhan) </span><br>
                                <div class="board-sub needs text-gray-600">{!! $item->needs !!}</div>
                            </div>
                            @endif
                        </div>
                        
                        <div id="item-product-{{ $item->id }}">
                            @if(!empty($item->product))
                            <div class="mb-5">
                                <span class="px-2.5" style="font-weight: 500;"> • Product (Product) </span><br>
                                <div class="board-sub product text-gray-600">{!! $item->product !!}</div>
                            </div>
                            @endif
                        </div>
                        
                        <div id="item-business-goals-{{ $item->id }}">
                            @if(!empty($item->business_goals))
                            <div class="mb-5">
                                <span class="px-2.5" style="font-weight: 500;"> • Business Goals (Tujuan Bisnis) </span><br>
                                <div class="board-sub business-goals text-gray-600">{!! $item->business_goals !!}</div>
                            </div>
                            @endif
                        </div>
                        
                        <div id="item-competitors-{{ $item->id }}">
                            @if(!empty($item->competitors))
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Competitors (Pesaing) </span><br>
                                    <div class="board-sub competitors text-gray-600">{!! $item->competitors !!}</div>
                                </div>
                            @endif
                        </div>
                    </div>         
                </div>
            </div>
        @endforeach
    @endif
</div>
