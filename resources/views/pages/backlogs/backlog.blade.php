<div class="backlog-section space-y-5">
    <div class="backlog">
        @if ($backlogs->isEmpty())
        <p class="p-8 text-gray-500">Belum ada backlog</p>
        @else
            @foreach ($backlogs as $backlog)
                <!----------------------------SETELAH DIBUAT--------------------------->
                    @if (!empty($backlog->name) && !empty($backlog->product_id) && empty($backlog->priority) && empty($backlog->description) && empty($backlog->hours) && empty($backlog->status) && empty($backlog->sprint_id))
                        <div id="backlog-create-{{ $backlog->id }}">
                            <div id="backlogz">
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
                    @else
                    <!----------------------------LIST BACKLOG--------------------------->
                        <div id="backlogList" class="backlog-content" style="display: none;">
                            @foreach ($backlogs as $backlog)
                                @php
                                    $checklists = $backlog->checklists()->get(); 
                                    $jumlahChecklistSelesai = $checklists->where('status', 1)->count();
                                    $jumlahChecklistTotal = $checklists->count();
                                    $persentase = $jumlahChecklistTotal > 0 ? ($jumlahChecklistSelesai / $jumlahChecklistTotal) * 100 : 0;
                                @endphp
                                @if (!empty($backlog->name) && !empty($backlog->product_id) && empty($backlog->priority) && empty($backlog->description) && empty($backlog->hours) && empty($backlog->status) && empty($backlog->sprint_id))
                                    @continue
                                @endif
                                <div class="backlogContainer">
                                    @include('pages.backlogs.partials.card-backlog', ['backlog' => $backlog, 'product' => $product])
                                </div>
                            @endforeach
                        </div>
                    @endif
            @endforeach
        @endif

        <!----------------------------SESUAI SPRINT--------------------------->
        @if ($backlogs->isNotEmpty())
            <div id="groupedBacklogList" class="backlog-content" style="display: none;">
                <div class="backlog-sprint" id="backlog-sprint">
                    @foreach($groupedBacklogs as $sprintId => $sprintBacklogs)
                    @php
                        $sprint = $sprintBacklogs->first()->sprint ?? null;
                    @endphp
                    
                    @if($sprint && !empty($sprint->name))
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="text-md font-bold">
                                    <span class="font-bold">{{ $sprintBacklogs->first()->sprint->name }} </span>
                                    <span class="text-gray-500">
                                        ({{ \Carbon\Carbon::parse($sprintBacklogs->first()->sprint->start_date)->format('d F Y, H:s') }} - 
                                        {{ \Carbon\Carbon::parse($sprintBacklogs->first()->sprint->end_date)->format('d F Y, H:s') }})
                                    </span>
                                </h3>
                                <div class="modal-footer rounded-3xl justify-end hidden">
                                    <button type="submit" class="btn btn-primary rounded-full">Simpan</button>
                                </div>                  
                                <div class="flex gap-2 items-center">    
                                    <div class="backlog-toggle rotate"  id="toggle">
                                        <i class="ki-duotone ki-down fs-1"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body-backlog p-4">
                                @foreach($sprintBacklogs as $backlog)
                                @php
                                    $checklists = $backlog->checklists()->get(); 
                                    $jumlahChecklistSelesai = $checklists->where('status', 1)->count();
                                    $jumlahChecklistTotal = $checklists->count();
                                    $persentase = $jumlahChecklistTotal > 0 ? ($jumlahChecklistSelesai / $jumlahChecklistTotal) * 100 : 0;
                                @endphp
                                    <div class="backlogContainer">
                                        @include('pages.backlogs.partials.card-backlog', ['backlog' => $backlog, 'product' => $product])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

@push('blockfoot')
    <script src="{{ asset('assets/js/backlogs/edit-checklist.js') }}"></script>
    <script src="{{ asset('assets/js/backlogs/edit-backlog.js') }}"></script>
    <script>
        function filterBacklogs(filter, button) {
            const backlogList = document.getElementById('backlogList');
            const groupedBacklogList = document.getElementById('groupedBacklogList');
    
            if (filter === 'random') {
                backlogList.style.display = 'block';
                groupedBacklogList.style.display = 'none';
            } else if (filter === 'sprint') {
                backlogList.style.display = 'none';
                groupedBacklogList.style.display = 'block';
            }
    
            document.querySelectorAll('.btn-icon').forEach(btn => {
                btn.classList.remove('active');
            });
    
            button.classList.add('active');
        }
        document.addEventListener('DOMContentLoaded', () => {
            const defaultButton = document.querySelector('.btn-icon.active'); 
            filterBacklogs(defaultButton.dataset.filter, defaultButton);
        });
    </script>
@endpush