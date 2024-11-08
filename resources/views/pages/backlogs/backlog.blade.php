<div class="backlog-section space-y-5">
    <div class="backlog">
        <!----------------------------PENGELOMPOKAN SESUAI SPRINT--------------------------->
        @if ($backlogs->isNotEmpty())
            <div id="groupedBacklogList" class="backlog-content" style="display: none;">
                <div class="backlog-sprint" id="backlog-sprint">
                    @if ($groupedBacklogs->isEmpty())
                        <p class="p-8 text-gray-500">Belum ada backlog</p>
                    @else
                        @foreach($groupedBacklogs as $sprintId => $sprintBacklogs)
                            @php
                                $sprint = $sprintBacklogs->first()->sprint ?? null;
                            @endphp

                            @if ($sprint && !empty($sprint->name))
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h3 class="text-md font-bold">
                                            <span class="font-bold">{{ $sprint->name }} </span>
                                            <span class="text-gray-500">
                                                ({{ \Carbon\Carbon::parse($sprint->start_date)->format('d F Y, H:i') }} - 
                                                {{ \Carbon\Carbon::parse($sprint->end_date)->format('d F Y, H:i') }})
                                            </span>
                                        </h3>
                                        <div class="modal-footer rounded-3xl justify-end hidden">
                                            <button type="submit" class="btn btn-primary rounded-full">Simpan</button>
                                        </div>                  
                                        <div class="flex gap-2 items-center">    
                                            <div class="backlog-toggle rotate" id="toggle">
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
                                                <div class="filter-backlog" data-backlog-id="{{ $backlog->id }}">
                                                    @include('pages.backlogs.partials.card-backlog', ['backlog' => $backlog, 'product' => $product])
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        @endif

        @if ($backlogs->isEmpty())
        <p class="p-8 text-gray-500">Belum ada backlog</p>
        @else
            @foreach ($backlogs as $backlog)
                <!----------------------------LIST BACKLOG--------------------------->
                <div id="backlogList" class="backlog-content" style="display: none;">
                    @foreach ($backlogs as $backlog)
                        <div class="backlogContainer">
                            @include('pages.backlogs.partials.card-backlog', ['backlog' => $backlog, 'product' => $product])
                        </div>
                    @endforeach
                </div>
            @endforeach
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