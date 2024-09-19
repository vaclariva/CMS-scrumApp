<div class="modal" data-modal="true" id="delete">
    <div class="modal-content max-w-[450px] top-[10%] p-3">
        <div class="text-center mb-2.5">
            <div class="mb-4">
                <img src="{{ asset('metronic/dist/assets/media/images/icon/confirm-delete.svg') }}" alt="Success Icon" class="w-24 h-24 mx-auto">
            </div>
            <h3 class="text-lg font-semibold text-gray-900 leading-none mb-2.5">
                Konfirmasi
            </h3>
            <div class="flex items-center justify-center font-medium">
                <span class="text-2sm me-1.5">
                    Data <span class="text-danger" id="delete_name"></span> akan dihapus secara permanen.<br>
                    Anda tidak akan bisa mengembalikannya lagi.
                </span>
            </div>
            
        </div>
        <div class="modal-footer flex justify-center p-3">
            <div class="flex gap-4">
                <button class="btn btn-light rounded-full" data-modal-dismiss="true">Batal</button>
                <input type="hidden" name="id" id="id"/>
                <form id="delete-form" action="" method="POST" style="display: inline;"  enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-full">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>