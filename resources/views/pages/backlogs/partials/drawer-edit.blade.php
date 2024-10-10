<div class="drawer drawer-start flex flex-col gap-4 max-w-[70%] w-[00px]" data-drawer="true" id="drawer_4">
    <div class="flex items-center justify-between p-5 border-b">
        <button class="btn btn-xs btn-icon" data-drawer-dismiss="true">
            <i class="ki-duotone ki-double-right"></i>
        </button>
    </div>

    <div class="scrollable-y py-0 pl-5 pr-2 mr-3">
        <form id="editBacklogForm" action="{{ route('backlogs.update', ['id' => $backlog->id]) }}" method="POST">
            @csrf
            @method('PUT')
        
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        
            <!-- Input untuk nama backlog -->
            <div class="mb-4">
                <input id="name" name="name" class="custom-input" type="text" value="{{ old('name', $backlog->name) }}" placeholder="Enter title" />
            </div>
        
            <!-- Input untuk deskripsi backlog -->
            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-textalign-left"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Deskripsi</label>
                    <input class="input" name="description" type="text" value="{{ old('description', $backlog->description) }}" />
                </div>
            </div>
        
            <!-- Pilihan prioritas backlog -->
            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-abstract-22"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Prioritas</label>
                    <div class="relative w-full">
                        <select class="select select2-apply" name="priority">
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
                    <input class="input" name="hours" type="text" value="{{ old('hours', $backlog->hours) }}" />
                </div>
            </div>
        
            <!-- Checkbox status backlog -->
            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-flag"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Status</label>
                    <label class="form-label flex items-center gap-2.5">
                        <input class="checkbox" id="status_checkbox" name="status" type="checkbox" value="1" {{ $backlog->status == '1' ? 'checked' : '' }} />
                        Selesai
                    </label>
                </div>
            </div>
        
            <!-- Input sprint backlog -->
            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <i class="ki-duotone ki-courier-express"></i>
                    <label class="form-label flex items-center gap-1 max-w-48">Sprint</label>
                    <input class="input" name="sprint_id" type="text" value="{{ old('sprint_id', $backlog->sprint_id) }}" />
                </div>
            </div>

            <div class="w-full py-2">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
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
            <button class="btn btn-light" data-drawer-dismiss="true">Cancel</button>
            <button class="btn btn-primary" form="editBacklogForm">Submit</button>
        </div>        
            
        <form id="checklistForm" action="{{ route('backlogs.checklists.storeOrUpdate', ['backlog_id' => $backlog->id]) }}" method="POST">
            @csrf
        </form>

        <button class="btn btn-primary" form="checklistForm">Submit Checklist</button>

        
    </div>

    <!-- Drawer footer -->
    <div class="flex justify-start gap-4 border-t p-5">
        <button class="btn btn-light" data-drawer-dismiss="true">Cancel</button>
        <button class="btn btn-primary">Submit</button>
    </div>
</div>
