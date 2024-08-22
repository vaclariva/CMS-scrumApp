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
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group p-2">
                    <label class="text-sm" for="name"><strong>Nama</strong></label>
                    <input class="input" name="name" placeholder="Masukkan Nama Pengguna" type="text" value="" required/>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="name"><strong>Label</strong></label>
                        <div class="flex gap-12">
                            <label class="form-label flex items-center gap-2.5 text-nowrap">
                                <input class="radio" name="label" type="radio" value="Internal"/>
                                    Internal
                            </label>
                            <label class="form-label flex items-center gap-2.5 text-nowrap">
                                <input checked="" class="radio" name="label" type="radio" value="Eksternal"/>
                                    External
                            </label>
                        </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="email"><strong>Tanggal Mulai</strong></label>
                    <div class="input-group" type="email">
                        <span class="btn btn-icon btn-icon-lg btn-input">
                            <i class="ki-duotone ki-calendar text-3xl text-gray-500"></i>
                        </span>
                        <input class="input" name="start_date" placeholder="Pilih Tanggal" type="date" value="" required/>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="email"><strong>Tanggal Berakhir</strong></label>
                    <div class="input-group" type="email">
                        <span class="btn btn-icon btn-icon-lg btn-input">
                            <i class="ki-duotone ki-calendar text-3xl text-gray-500"></i>
                        </span>
                        <input class="input" name="end_date" placeholder="Pilih Tanggal" type="date" value="" required/>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label class="text-sm" for="user_id"><strong>Produk Owner</strong></label>
                        <select class="select" name="user_id" required>
                            <i class="ki-outline ki-down !text-sm dropdown-open:hidden"></i>
                            <i class="ki-outline ki-up !text-sm hidden dropdown-open:block"></i> 
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"> {{ $user->name}}</option>
                                @endforeach
                        </select>
                </div>

                <div class="modal-footer ">
                    <div class="flex gap-4 justify-end p-5">
                        <button class="btn btn-light rounded-full" data-modal-dismiss="true">
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