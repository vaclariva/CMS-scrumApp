<div class="newCreate">
    @foreach ($backlogs as $backlog)
    @if (!empty($backlog->name) && !empty($backlog->product_id) && empty($backlog->priority) && empty($backlog->description) && empty($backlog->hours) && empty($backlog->status) && empty($backlog->sprint_id))
    <div class="card mb-3 backlog-edit" data-backlog-id="{{$backlog->id}}">
        <div class="BacklogNameDisplay card-body title-backlog mb-0 flex justify-between items-center">
            <input type="text" class="card-title title-card-backlog cstm-input" data-product-id="{{ $product->id }}" data-id="{{ $backlog->id }}" id="name-{{ $backlog->id }}" value="{{ $backlog->name }}">
            <div class="flex gap-2 items-center {{ $backlog->created_at == $backlog->updated_at ? '' : 'hidden' }}" id="backlog-action-{{ $backlog->id }}">
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
        <div class="flex justify-between {{ $backlog->created_at == $backlog->updated_at ? 'hidden' : '' }}" id="backlog-footer-{{ $backlog->id }}">
            <div class="px-7 pb-4 flex items-center gap-3">
                <!-- Badge Priority -->
                <div class="BacklogPriorityDisplay {{$backlog->priority ? '' : 'hidden'}}" data-backlog-id="{{$backlog->id}}">
                    {{$backlog->priority}}
                    <span class="badge badge-pill badge-outline gap-1.5 
                        {{$backlog->priority}} === 'Tinggi' ? 'badge-danger' : 
                        {{$backlog->priority}} === 'Sedang' ? 'badge-warning' : 'badge-success'}">
                        <span class="badge badge-dot 
                        {{$backlog->priority}} === 'Tinggi' ? 'badge-danger' : 
                        {{$backlog->priority}} === 'Sedang' ? 'badge-warning' : 
                        'badge-success'} size-1.5" data-backlog-id="{{$backlog->id}}"></span>
                        {{$backlog->priority}}
                    </span>
                </div>

                <!-- Icon Description -->
                <div class="BacklogDescriptionDisplay {{$backlog->description ? '' : 'hidden'}}" data-backlog-id="{{$backlog->id}}">
                    {{$backlog->description}}
                    <i class="ki-duotone ki-textalign-left"></i>
                </div>

                 <!-- Checklist -->
                <div class="BacklogChecklistDisplay flex items-center text-xs" id="checklist-{{$backlog->id}}">
                </div> 

                <!-- Status -->
                <div class="BacklogChecklistDisplay flex items-center text-xs {{$backlog->status == 0 ? 'hidden': 'text-gray-500'}}"
                    data-backlog-id="{{$backlog->id}}">
                    <i class="ki-duotone ki-check-squared text-lg"></i>
                    {{$backlog->status == 1 ? 'Selesai' : ''}}
                </div>

                <!-- Hours -->
                <div class="BacklogHoursDisplay flex items-center {{$backlog->hours ? '' : 'hidden'}}" data-backlog-id="{{$backlog->id}}">
                    <div class="flex items-center text-xs">
                        <i class="ki-duotone ki-timer text-lg"></i>
                        <span class="ml-1 text-xs">{{$backlog->hours}} Jam</span>
                    </div>
                </div>

                <!-- Status Check -->
                <div class="BacklogStatusDisplay {{$backlog->status == 0 ? 'hidden' : ''}}" data-backlog-id="{{$backlog->id}}">
                    <div class="flex items-center text-xs text-success">
                        <i class="ki-duotone ki-flag text-lg"></i>
                        <span class="ml-1">Selesai</span>
                    </div>
                </div>

                <!-- Product Owner Image -->
                <div class="flex items-center">
                    <div class="menu-toggle me-2 rounded-full" data-backlog-id="{{ $backlog->id }}">
                        @if($productOwner->image)
                        <img src="{{ asset('/storage/'. $productOwner->image) }}" alt="{{Auth::user()->name}}" class="w-5 h-5 rounded-full object-cover">
                        @else
                        <img src="{{ asset('metronic/dist/assets/media/avatars/blank.png') }}" alt="Default Image" class="w-5 h-5 rounded-full object-cover">
                        @endif
                    </div>
                    <span class="text-xs">{{$productOwner->name}}</span>
                </div>
            </div>

            <!-- Dropdown Menu -->
            <div class="pb-4">
                <div class="dropdown relative" data-dropdown="true" data-dropdown-placement="bottom-end">
                    <button class="dropdown-toggle btn hover:text-gray-50">
                        <i class="ki-filled ki-dots-vertical"></i>
                    </button>
                    <div class="dropdown-content absolute left-0 mt-2 w-full max-w-56 py-2 bg-white shadow-lg z-10">
                        <div class="menu menu-default flex flex-col w-full">
                            <div class="menu-item">
                                <a class="menu-link editBtn" data-product-id="{{$backlog->product_id}}" data-backlog-id="{{$backlog->id}}"
                                    onclick="openDrawer({url: '{{route('backlogs.edit', ['product' => $backlog->product_id, 'backlog' => $backlog->id])}}', backlogId: {{$backlog->id}}})">
                                    <span class=" menu-icon">
                                        <i class="ki-duotone ki-notepad-edit"></i>
                                    </span>
                                    <span class="menu-title">Edit</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <form action="/backlogs/duplicate/{{$backlog->product_id}}/{{$backlog->id}}" method="POST" class="mb-1">
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
                                <a class="menu-link" href="/backlogs/download/{{$backlog->id}}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-file-down"></i>
                                    </span>
                                    <span class="menu-title">Unduh PDF</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link deleteBtn" onclick="openDeleteBacklog({
                                                    id: {{$backlog->id}},
                                                    name: '{{$backlog->name}}',
                                                    url_delete: '{{route('backlogs.destroy', ['product' => $backlog->product_id, 'backlog' => $backlog->id])}}'})">
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
    @endif
    @endforeach
</div>