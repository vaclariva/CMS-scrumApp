<div class="modal" data-modal="true" id="modal_product">
    <div class="modal-content modal-center max-w-[500px] p-6 z-1000">
        <div class="modal-header">
            <h2 class="modal-title">Edit Produk</h2>
            <button class="btn btn-xs btn-icon btn-light" data-modal-dismiss="true">
                <i class="ki-outline ki-cross"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="updateProductForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 

                <input type="hidden" name="id" id="id"/>
                <input type="hidden" id="icon" name="icon" value="" />

                <div class="form-group p-2">
                    <label class="text-sm" for="name"><strong>Nama</strong></label>
                    <div class="flex items-center gap-2">
                        <div class="relative" id="icon-container">
                            <button id="icon-picker-btn" type="button" class="p-2 rounded border iconPickerButton">
                                <span id="current-icon"></span> 
                            </button>
                            <div id="icon-picker-menu" class="hidden absolute top-full mt-2 bg-white border rounded shadow-lg dropdownicon">
                                <input type="text" id="icon-search-input" class="w-full p-2 border-b" placeholder="Search icons..." />
                                <div id="icon-grid-container" class="flex flex-wrap p-2 max-h-60 overflow-y-auto">
                                </div>
                            </div>
                        </div>                        
                    <input class="input" name="name" id="name" placeholder="Masukkan Nama Produk" type="text" required/>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="label"><strong>Label</strong></label>
                    <div class="flex gap-2">
                        <label class="form-label flex items-center gap-2.5 text-nowrap">
                            <input class="radio" name="label" id="internal_label" type="radio" value="internal"/>
                            Internal
                            <input class="radio" name="label" id="eksternal_label" type="radio" value="eksternal"/>
                            Eksternal 
                        </label>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="start_date"><strong>Tanggal Mulai</strong></label>
                    <div class="input-group">
                        <span class="btn btn-icon btn-icon-lg btn-input">
                            <i class="ki-duotone ki-calendar text-3xl text-gray-500"></i>
                        </span>
                        <input class="input" name="start_date" id="start_date" type="datetime-local" value="" required/>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="end_date"><strong>Tanggal Berakhir</strong></label>
                    <div class="input-group">
                        <span class="btn btn-icon btn-icon-lg btn-input">
                            <i class="ki-duotone ki-calendar text-3xl text-gray-500"></i>
                        </span>
                        <input class="input" name="end_date" id="end_date" type="datetime-local" value="" required/>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm font-bold" for="user_id"><strong>Produk Owner</strong></label>
                    <div class="relative w-full">
                        <select class="select select2-apply block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 text-sm" name="user_id" id="user_id" value="" required>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" data-image="{{ $user->image_path ? asset($user->image_path) : asset('metronic/dist/assets/media/avatars/blank.png') }}">
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="flex gap-4 justify-end p-5">
                        <button class="btn btn-light rounded-full" type="button" data-modal-dismiss="true">
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
            const iconGrid = document.getElementById('icon-grid-container');

            data.forEach(icon => {
                const iconElement = document.createElement('span');
                iconElement.className = icon.class + ' cursor-pointer p-2 hover:bg-gray-200 rounded';
                iconElement.dataset.class = icon.class; 
                iconGrid.appendChild(iconElement);
            });

            document.querySelectorAll('#icon-grid-container span').forEach(icon => {
                icon.addEventListener('click', function () {
                    const selectedIcon = document.getElementById('current-icon');
                    selectedIcon.className = this.dataset.class; 
                    document.getElementById('icon').value = this.dataset.class; 
                    document.getElementById('icon-picker-menu').classList.add('hidden');
                });
            });
        });

    document.getElementById('icon-picker-btn').addEventListener('click', function () {
        const picker = document.getElementById('icon-picker-menu');
        picker.classList.toggle('hidden');
    });

    document.getElementById('icon-search-input').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        const icons = document.querySelectorAll('#icon-grid-container span');
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