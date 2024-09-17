<div class="modal" data-modal="true" id="modal_6_3">
    <div class="modal-content modal-center max-w-[500px] p-6">
        <div class="modal-header">
            <h2 class="modal-title">
                Tambah Produk
            </h2>
            <button class="btn btn-xs btn-icon btn-light" data-modal-dismiss="true">
                <i class="ki-outline ki-cross"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
        
                <input type="hidden" id="input_start_date" name="start_date">
                <input type="hidden" id="input_end_date" name="end_date">
        
                <div class="form-group p-2">
                    <label class="text-sm" for="name"><strong>Nama</strong></label>
                    <div class="flex items-center gap-2">
                        <div class="relative" id="icon_create">
                            <button id="iconPickerButton" type="button" class="p-2 rounded border iconPickerButton">
                                <span id="selectedIcon" class="ki-duotone ki-abstract-33"></span> 
                            </button>
                            <div id="iconPicker" class="hidden absolute top-full mt-2 bg-white border rounded shadow-lg dropdownicon">
                                <input type="text" id="iconSearch" class="w-full p-2 border-b" placeholder="Search icons..." />
                                <div id="iconGrid" class="flex flex-wrap p-2 max-h-60 overflow-y-auto">
                                </div>
                            </div>
                        </div>
                        <input class="input" name="name" placeholder="Masukkan Nama Produk" type="text" value="" required/>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="label"><strong>Label</strong></label>
                    <div class="flex gap-">
                        <label class="form-label flex items-center gap-2.5 text-nowrap">
                            <input class="radio" name="label" type="radio" value="internal" required/>
                            Internal
                            <input class="radio" name="label" type="radio" value="eksternal" required/>
                            External
                        </label>
                    </div>
                </div>
        
                <div class="form-group p-2">
                    <label class="text-sm" for="start_date"><strong>Tanggal Mulai</strong></label>
                    <div class="input-group">
                        <span class="btn btn-icon btn-icon-lg btn-input">
                            <i class="ki-duotone ki-calendar text-3xl text-gray-500"></i>
                        </span>
                        <input class="input" id="start_date" name="start_date_display" type="text" value="" required/>
                    </div>
                </div>
        
                <div class="form-group p-2">
                    <label class="text-sm" for="end_date"><strong>Tanggal Berakhir</strong></label>
                    <div class="input-group">
                        <span class="btn btn-icon btn-icon-lg btn-input">
                            <i class="ki-duotone ki-calendar text-3xl text-gray-500"></i>
                        </span>
                        <input class="input" id="end_date" name="end_date_display" type="text" value="" required/>
                    </div>
                </div>
        
                <div class="form-group p-2">
                    <label class="text-sm font-bold" for="user_id"><strong>Produk Owner</strong></label>
                    <div class="relative w-full">
                        <select class="select select2-apply block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" name="user_id" required>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" data-image="{{ $user->image_path ? asset($user->image_path) : asset('metronic/dist/assets/media/avatars/blank.png') }}">
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>                                         
        
                <input type="hidden" id="icon1" name="icon" value="" />
                
                <div class="modal-footer">
                    <div class="flex gap-4 justify-end p-5">
                        <button class="btn btn-light rounded-full" data-modal-dismiss="true" type="button">
                            Batal
                        </button>
                        <button class="btn btn-primary rounded-full" type="submit"> 
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    fetch('/icons')
        .then(response => response.json())
        .then(data => {
            const iconGrid = document.getElementById('iconGrid');

            data.forEach(icon => {
                const iconElement = document.createElement('span');
                iconElement.className = icon.class + ' cursor-pointer p-2 hover:bg-gray-200 rounded';
                iconElement.dataset.class = icon.class; 
                iconGrid.appendChild(iconElement);
            });

            document.querySelectorAll('#iconGrid span').forEach(icon => {
                icon.addEventListener('click', function () {
                    const selectedIcon = document.getElementById('selectedIcon');
                    selectedIcon.className = this.dataset.class; 
                    document.getElementById('icon1').value = this.dataset.class; 
                    document.getElementById('iconPicker').classList.add('hidden');
                });
            });
        });

    document.getElementById('iconPickerButton').addEventListener('click', function () {
        const picker = document.getElementById('iconPicker');
        picker.classList.toggle('hidden');
    });

    document.getElementById('iconSearch').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        const icons = document.querySelectorAll('#iconGrid span');
        icons.forEach(icon => {
            if (icon.dataset.class.includes(query)) {
                icon.classList.remove('hidden');
            } else {
                icon.classList.add('hidden');
            }
        });
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#start_date", {
            enableTime: true,
            dateFormat: "d F Y, H:i",  
            time_24hr: true,
            locale: 'id',
            onChange: function(selectedDates, dateStr, instance) {
                const formattedDate = instance.formatDate(selectedDates[0], "Y-m-d H:i:s"); 
                document.getElementById('input_start_date').value = formattedDate; 
            }
        });

        flatpickr("#end_date", {
            enableTime: true,
            dateFormat: "d F Y, H:i",
            time_24hr: true,
            locale: 'id',
            onChange: function(selectedDates, dateStr, instance) {
                const formattedDate = instance.formatDate(selectedDates[0], "Y-m-d H:i:s"); 
                document.getElementById('input_end_date').value = formattedDate; 
            }
        });
    });
    </script>
