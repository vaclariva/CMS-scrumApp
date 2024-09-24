<div class="modal" data-modal="true" id="modal_draggable">
    <div class="modal-content max-w-[600px] top-[10%]">
        <div class="modal-header flex justify-end items-center gap-3">
            <div class="flex items-center gap-3">
                <form action="{{ route('visionBoard.duplicate', ['product' => $product->id, 'visionBoard' => $item->id]) }}" method="POST" class="mb-1">
                    @csrf
                    <button type="submit" class="text-xs flex items-center">
                        <span class="menu-icon pl-5">
                            <i class="ki-duotone ki-copy text-md"></i>
                        </span>
                    </button>
                </form>
                
                <a class="menu-link" onclick="openDeleteModalVision({ id: {{ $item->id }}, name: '{{ $item->name }}', url_delete: '{{ route('visionBoard.destroy', [$product->id, $item->id]) }}' })">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-trash text-md"></i>
                    </span>
                </a>
            </div>
            
            <button class="btn btn-xs btn-icon" data-modal-dismiss="true">
                <i class="ki-duotone ki-cross text-xl"></i>
            </button>
        </div>        
        <div class="modal-body mt-4 max-h-[70vh] overflow-y-auto">
            <form id="updateVisionBoardForm" action="" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="mb-4">
                    <label for="name" class="block text-sm font-bold mb-2">Title</label>
                    <input id="name" name="name" class="w-full py-2 px-3 text-sm rounded-md shadow-sm" type="text" placeholder="Enter title" required />
                </div>

                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="vision">
                        Vision <span class="text-gray-600">(Visi)</span>
                    </label>
                    <textarea id="editor_vision" name="vision" class="textarea" placeholder="Vision" rows="4" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="target-group">
                        Target Group <span class="text-gray-600"> (Kelompok Sasaran)</span>
                    </label>
                    <textarea id="editor1" name="target_group" class="textarea" placeholder="Target Group" rows="4" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="needs">
                        Needs <span class="text-gray-600"> (Kebutuhan) </span>
                    </label>
                    <textarea id="editor2" name="needs" class="textarea" placeholder="Needs" rows="4" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="product">
                        Product <span class="text-gray-600"> (Produk) </span>
                    </label>
                    <textarea id="editor3" name="product" class="textarea" placeholder="Product" rows="4" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="business-goals">
                        Business Goals <span class="text-gray-600"> (Tujuan Bisnis) </span>
                    </label>
                    <textarea id="editor4" name="business_goals" class="textarea" placeholder="Business Goals" rows="4" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="competitors">
                        Competitors <span class="text-gray-600"> (Pesaing) </span>
                    </label>
                    <textarea id="editor5" name="competitors" class="textarea" placeholder="Competitors" rows="4" required></textarea>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const modalInputs = document.querySelectorAll('#updateVisionBoardForm input, #updateVisionBoardForm textarea');
    
    modalInputs.forEach(input => {
        input.addEventListener('input', function () {
            if (this.autoSaveTimeout) clearTimeout(this.autoSaveTimeout);

            this.autoSaveTimeout = setTimeout(() => {
                autoSaveForm();
            }, 1000); 
        });
    });

    function autoSaveForm() {
        const form = document.getElementById('updateVisionBoardForm');
        const formData = new FormData(form);

        fetch('{{ route("visionBoard.update", ["product" => $product->id, "visionBoard" => $item->id]) }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Auto-save successful');
            } else {
                console.error('Auto-save failed');
            }
        })
        .catch(error => {
            console.error('Error during auto-save:', error);
        });
    }
    });
</script>
