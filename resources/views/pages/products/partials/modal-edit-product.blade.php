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
                
                <input type="hidden" id="formatted_start_date" name="start_date" value="{{ $product->start_date }}" />
                <input type="hidden" id="formatted_end_date" name="end_date" value="{{ $product->end_date }}" /> 

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
                    <input class="input" name="name" id="name" placeholder="Masukkan Nama Produk" type="text" value="{{$product->name}}" required/>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="label"><strong>Label</strong></label>
                    <div class="flex gap-2">
                        <label class="form-label flex items-center gap-2.5 text-nowrap">
                            <input class="radio" name="label" id="internal_label" type="radio" value="Internal"
                            {{ $product->label == 'Internal' ? 'checked' : '' }} />
                            Internal
                        </label>
                
                        <label class="form-label flex items-center gap-2.5 text-nowrap">
                            <input class="radio" name="label" id="eksternal_label" type="radio" value="Eksternal"
                            {{ $product->label == 'Eksternal' ? 'checked' : '' }} />
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
                        <input class="input" id="start_date" name="start_date_display" type="text" value="{{$product->start_date}}" required/>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="end_date"><strong>Tanggal Berakhir</strong></label>
                    <div class="input-group">
                        <span class="btn btn-icon btn-icon-lg btn-input">
                            <i class="ki-duotone ki-calendar text-3xl text-gray-500"></i>
                        </span>
                        <input class="input" id="end_date" name="end_date_display" type="text" value="{{$product->end_date}}" required/>
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

@push('blockfoot')
    <script src="{{ asset('assets/js/products/icon.js') }}"></script>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const parseIndonesianDate = (dateStr) => {
            const months = {
                "Januari": "01",
                "Februari": "02",
                "Maret": "03",
                "April": "04",
                "Mei": "05",
                "Juni": "06",
                "Juli": "07",
                "Agustus": "08",
                "September": "09",
                "Oktober": "10",
                "November": "11",
                "Desember": "12"
            };
    
            const [datePart, timePart] = dateStr.split(', ');
            const [day, monthName, year] = datePart.split(' ');
            const [hours, minutes] = timePart.split(':');
    
            const month = months[monthName];
    
            return new Date(`${year}-${month}-${day}T${hours}:${minutes}:00`);
        };
    
        const formatDateForView = (date) => {
            const options = {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
            };
            return new Date(date).toLocaleDateString('id-ID', options);
        };
    
        const formatDateForDB = (date) => {
            const d = new Date(date);
            const year = d.getFullYear();
            const month = ('0' + (d.getMonth() + 1)).slice(-2);
            const day = ('0' + d.getDate()).slice(-2);
            const hours = ('0' + d.getHours()).slice(-2);
            const minutes = ('0' + d.getMinutes()).slice(-2);
            const seconds = ('0' + d.getSeconds()).slice(-2);
            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        };
    
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
    
        startDateInput.value = formatDateForView(startDateInput.value);
        endDateInput.value = formatDateForView(endDateInput.value);
    
        const updateProductForm = document.getElementById('updateProductForm');
        updateProductForm.addEventListener('submit', function () {
            const startDateDB = formatDateForDB(parseIndonesianDate(startDateInput.value));
            const endDateDB = formatDateForDB(parseIndonesianDate(endDateInput.value));
    
            document.getElementById('formatted_start_date').value = startDateDB;
            document.getElementById('formatted_end_date').value = endDateDB;
        });
    });
</script>