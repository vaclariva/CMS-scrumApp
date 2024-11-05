<div class="newCreate">
    @foreach ($backlogs as $backlog)
        @if (!empty($backlog->name) && !empty($backlog->product_id) && empty($backlog->priority) && empty($backlog->description) && empty($backlog->hours) && empty($backlog->status) && empty($backlog->sprint_id))
            <div id="backlog-create-{{ $backlog->id }}">
                <div id="backlog">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title custom-" contenteditable="true" data-id="{{ $backlog->id }}" id="name-{{ $backlog->id }}">
                                {{ $backlog->name }}
                            </h3>        
                            <div class="flex gap-2 items-center">
                                <a class="btn btn-icon" id="editBtn" data-product-id="{{ $product->id }}" data-backlog-id="{{ $backlog->id }}" 
                                    onclick="openDrawer({backlogId: {{ $backlog->id }}, url: '{{ route('backlogs.edit', ['product' => $product->id, 'backlog' => $backlog->id]) }}'})">
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
                                                <form action="{{ route('backlogs.duplicate', ['product' => $product->id, 'backlog' => $backlog->id]) }}" method="POST" class="mb-1">
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
                                                <a class="menu-link" onclick="openDeleteBacklog({
                                                    id: {{ $backlog->id }},
                                                    name: '{{ $backlog->name }}',
                                                    url_delete: '{{ route('backlogs.destroy', [$product->id, $backlog->id]) }}'})">
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
        @endif
    @endforeach
</div>