<div class="modal" data-modal="true" id="modal_draggable">
    <div class="modal-content max-w-[600px] top-[10%]">
        <div class="modal-header flex justify-end items-center gap-3">
            <div class="flex space-x-2 gap-3">
                <a class="menu-link" id="copy_menu_item">
                    <i class="ki-duotone ki-copy-success text-xl"></i>
                </a>
                <a class="menu-link" id="trash_menu_item">
                    <i class="ki-duotone ki-trash text-xl"></i>
                </a>
            </div>
            <button class="btn btn-xs btn-icon" data-modal-dismiss="true">
                <i class="ki-duotone ki-cross text-xl"></i>
            </button>
        </div>
        <div class="modal-body mt-4 max-h-[70vh] overflow-y-auto">
            <form action="{{ route('vision-board.store', ['product_id' => $product_id]) }}" method="POST">
                @csrf
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
                    <textarea id="editor_target_group" name="target_group" class="textarea" placeholder="Target Group" rows="4" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="needs">
                        Needs <span class="text-gray-600"> (Kebutuhan) </span>
                    </label>
                    <textarea id="editor_needs" name="needs" class="textarea" placeholder="Needs" rows="4" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="product">
                        Product <span class="text-gray-600"> (Produk) </span>
                    </label>
                    <textarea id="editor_product" name="product" class="textarea" placeholder="Product" rows="4" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="business-goals">
                        Business Goals <span class="text-gray-600"> (Tujuan Bisnis) </span>
                    </label>
                    <textarea id="editor_business_goals" name="business_goals" class="textarea" placeholder="Business Goals" rows="4" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="competitors">
                        Competitors <span class="text-gray-600"> (Pesaing) </span>
                    </label>
                    <textarea id="editor_competitors" name="competitors" class="textarea" placeholder="Competitors" rows="4" required></textarea>
                </div>                

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor_vision');
    CKEDITOR.replace('editor_target_group');
    CKEDITOR.replace('editor_needs');
    CKEDITOR.replace('editor_product');
    CKEDITOR.replace('editor_business_goals');
    CKEDITOR.replace('editor_competitors');
</script>
