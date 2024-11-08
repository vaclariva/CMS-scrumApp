<div class="backdrop" id="backdrop"></div>
<div class="drawer drawer-up flex flex-col gap-4 max-w-[1200px]" data-drawer="true" id="drawer_4">
    <div class="flex items-center justify-between p-5 border-b">
        <button class="btn btn-xs btn-icon" id="drawerDismissButton">
            <i class="ki-duotone ki-double-right"></i>
        </button>
    </div>

    <div class="scrollable-y py-0 pl-5 pr-2 mr-3">
        <form id="editBacklogForm" method="POST" action="">
            @csrf
            @method('PUT')

            <!-- Input untuk nama backlog -->
            <div class="mb-4">
                <textarea id="BacklogName" name="name" class="custom-input" placeholder="Enter title" oninput="autoResize(this)">{{ old('name', $backlog->name) }}</textarea>
            </div>

            <!-- Input untuk deskripsi backlog -->
            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-textalign-left"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Deskripsi</label>
                    <textarea id="BacklogDescription" name="description" class="textarea" placeholder="Deskripsi" rows="3" value="{{ old('description', $backlog->description) }}"></textarea>
                </div>
            </div>

            <!-- Pilihan prioritas backlog -->
            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-abstract-22"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Prioritas</label>
                    <div class="relative w-full">
                        <select id="backlogPriority" class="select" name="priority">
                            <option value="Tinggi" {{ $backlog->priority == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            <option value="Sedang" {{ $backlog->priority == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Rendah" {{ $backlog->priority == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Input jam backlog -->
            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-timer"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Jam</label>
                    <input id="backlogHours" name="hours" class="input" type="number"></input>
                </div>
            </div>

            <!-- Checkbox status backlog -->
            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-flag"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Status</label>
                    <input type="hidden" name="status" value="0"> <!-- Nilai default ketika tidak dicentang -->
                    <label class="form-label flex items-center gap-2.5">
                        <input class="checkbox" id="backlogStatus" name="status" type="checkbox" value="1" {{ $backlog->status == '1' ? 'checked' : '' }} />
                        Selesai
                    </label>
                </div>
            </div>


            <!-- Input sprint backlog -->
            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-courier-express"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Sprint</label>
                    <select id="backlogSprint" class="input" name="sprint_id">
                        <option value="" disabled selected>Pilih Sprint</option>
                    </select>
                </div>
            </div>

            <!-- Input name applicant -->
            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-users"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Nama Pengguna</label>
                    <input id="backlogApplicant" name="applicant" class="input"></input>
                </div>
            </div>

            <div class="w-full">
                <div class="flex items-center flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-user"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Dibuat Oleh</label>
                    <span class="text-2sm text-gray-600 me-1.5 mb-2 mt-0.5 flex items-center">
                        <div class="menu-toggle btn btn-icon rounded-full">
                            @if($productOwner->image)
                            <img src="{{ asset('/storage/'. $productOwner->image) }}" alt="{{Auth::user()->name}}" class="w-5 h-5 rounded-full object-cover">
                            @else
                            <img src="{{ asset('metronic/dist/assets/media/avatars/blank.png') }}" alt="Default Image" class="w-5 h-5 rounded-full object-cover">
                            @endif
                        </div>
                        {{$productOwner->name}}
                    </span>
                </div>
            </div>
        </form>

        <div class="flex justify-start gap-4 border-t p-5">
            <button class="btn btn-light hidden" data-drawer-dismiss="true">Cancel</button>
            <button class="btn btn-primary hidden" form="editBacklogForm">Submit</button>
        </div>

        <div id="checklist-{{ $backlog->id }}">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800 mb-4" id="checklistCount">
                    Checklist ({{ $checklists->where('status', '1')->count() }}/{{ $checklists->count() }})
                </h2>

                <button type="button" class="btn btn-sm btn-outline btn-primary rounded-full" id="addChecklist">
                    <i class="ki-duotone ki-plus"></i>
                    Tambah
                </button>
            </div>
            <form id="hiddenAdd" style="display: none;" method="POST" action="{{ route('checklists.store', ['backlog' => $backlog->id]) }}">
                @csrf
                <input type="hidden" id="backlog_id" name="backlog_id" value="{{ $backlog->id }}">
                <input type="hidden" name="description" value="untitled">
                <input type="hidden" name="status" value="0">
                <button type="submit" id="hiddenSubmitButton">Kirim</button>
            </form>

            <div class="flex items-center justify-between mb-5">
                <span class="text-sm text-gray-600" id="progressPercentage">
                    {{ $persentase }}%
                </span>
                <div class="progress progress-success">
                    <div class="progress-bar" id="progressBar" style="width: {{ number_format($persentase) }}%">
                    </div>
                </div>
            </div>

            <ul class="list-none" id="checklistItems">
                @if ($checklists->isEmpty())
                <li class="mb-3">
                    <span class="text-gray-600">Belum ada checklist</span>
                </li>
                @else
                @foreach ($checklists as $checklist)
                <li class="mb-3" id="checklist-{{ $checklist->id }}">
                    <form id="form-{{ $checklist->id }}" class="checklist-form" action="{{ route('checklists.update', $checklist) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label class="form-label flex items-center gap-2.5">
                            <input class="checkbox" name="status" type="checkbox" data-id="{{ $checklist->id }}" value="{{ $checklist->id }}" {{ $checklist->status === '1' ? 'checked' : '' }} />
                            <span class="w-full">
                                <textarea class="custom-textarea w-full {{ $checklist->status === '1' ? 'line-through text-gray-500' : '' }}" data-id="{{ $checklist->id }}" name="description">{{ $checklist->description }}</textarea>
                            </span>
                        </label>
                        <button type="submit" class="hidden">Simpan</button>
                    </form>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addChecklist').off('click').on('click', function() {
            var backlogId = $('#backlog_id').val();
            var description = 'untitled';
            var status = 0;

            $.ajax({
                url: '/backlogs/' + backlogId + '/checklists',
                type: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    backlog_id: backlogId,
                    description: description,
                    status: status
                },
                success: function(response) {
                    var checklist = response.checklist;
                    const backlog = response.backlog;
                    const completedChecklists = response.completedChecklists;
                    const totalChecklists = response.totalChecklists;
                    if(!response.backlog.id) {
                        $(`#backlog-action-${response.backlog.id}`).removeClass('hidden');
                        $(`#backlog-footer-${response.backlog.id}`).addClass('hidden');
                    } else {
                        $(`#backlog-action-${response.backlog.id}`).addClass('hidden');
                        $(`#backlog-footer-${response.backlog.id}`).removeClass('hidden');
                    }

                    if (!checklist.id) {
                        console.error('ID checklist tidak ditemukan dalam respons');
                        return;
                    }

                    var newChecklistItem = `
                        <li class="mb-3" id="checklist-${checklist.id}">
                            <label class="form-label flex items-center gap-2.5">
                                <input class="checkbox" name="status" type="checkbox" data-id="${checklist.id}" value="${checklist.id}" ${checklist.status === '1' ? 'checked' : ''}/>
                                <span class="w-full">
                                    ${checklist.status === '1' ? '<span class="line-through text-gray-500">' + checklist.description + '</span>' : '<textarea class="w-full custom-textarea" name="description[]">' + (checklist.description || 'untitled') + '</textarea>'}
                                </span>
                            </label>
                        </li>
                    `;

                    $('#checklistItems').append(newChecklistItem);

                    if ($('#checklist-' + checklist.id).length > 0) {
                        console.log('Checklist baru sudah dimuat di drawer dengan ID:', checklist.id);
                    } else {
                        console.error('Checklist baru gagal dimuat di drawer.');
                    }

                    $('#checklistCount').text(`Checklist ${response.completedChecklists}/${response.totalChecklists}`);
                    $('#progressBar').css('width', `${response.persentase}%`);
                    $('#progressPercentage').text(`${Math.round(response.persentase)}%`);
                    updateBacklogChecklistDisplay(response.backlog, response.completedChecklists, response.totalChecklists);

                },
                error: function(xhr) {
                    console.error('Error menambahkan checklist:', xhr.responseJSON);
                }
            });
        });
    });
</script>