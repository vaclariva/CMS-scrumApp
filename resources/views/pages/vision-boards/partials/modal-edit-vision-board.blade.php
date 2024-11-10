<div class="modal hidden" data-modal="true" id="modal_draggable" >
    <div class="modal-content max-w-[1200px] top-[10%]">
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
                @method('PUT')

                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" id="vision-board-id" value="{{ $item->id }}">


                <div class="mb-4">
                    <input id="name-vision" name="name" class="custom-input" type="text" placeholder="Enter title" value="{!! $item->name !!}" />
                </div>                

                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="vision">
                        Vision <span class="text-gray-600">(Visi)</span>
                    </label>
                    <textarea id="vision" name="vision" class="textarea" placeholder="Vision" rows="4" value="{!! $item->vision !!}" ></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="target-group">
                        Target Group <span class="text-gray-600"> (Kelompok Sasaran)</span>
                    </label>
                    <textarea id="editor1" name="target_group" class="editor" placeholder="Target Group" rows="4" value="{!! $item->target_group !!}" ></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="needs">
                        Needs <span class="text-gray-600"> (Kebutuhan) </span>
                    </label>
                    <textarea id="editor2" name="needs" class="editor" placeholder="Needs" rows="4" value="{!! $item->needs !!}" ></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="product">
                        Product <span class="text-gray-600"> (Produk) </span>
                    </label>
                    <textarea id="editor3" name="product" class="editor" placeholder="Product" rows="4" value="{!! $item->product !!}" ></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="input-vision block text-sm font-bold mb-2" for="business-goals">
                        Business Goals <span class="text-gray-600"> (Tujuan Bisnis) </span>
                    </label>
                    <textarea id="editor4" name="business_goals" class="editor" placeholder="Business Goals" rows="4" value="{!! $item->business_goals !!}" ></textarea>
                </div>
                
                <div id="competitors-section" class="mb-4" hidden>
                    <label class="input-vision block text-sm font-bold mb-2" for="competitors">
                        Competitors <span class="text-gray-600"> (Pesaing) </span>
                    </label>
                    <textarea id="editor5" name="competitors" class="editor" placeholder="Competitors" value="{!! $item->competitors !!}" rows="4"></textarea>
                </div>


                <div class="modal-footer justify-center items-center">
                    <div class="flex items-center  justify-center">
                        
                        <button type="button" id="removeCompetitorsBtn" class="btn btn-link btn-sm text-danger items-center hidden" onclick="toggleCompetitorsForm(false)" hidden>
                            Hapus Form Competitors (Pesaing)
                        </button>
                        <button type="button" id="addCompetitorsBtn" class="btn btn-link btn-sm items-center " onclick="toggleCompetitorsForm(true)">
                            Tambah Form Competitors (Pesaing)
                        </button>
                    </div>
                </div>
                <div class="modal-footer rounded-3xl justify-end hidden">
                    <button type="submit" class="btn btn-primary rounded-full">Simpan</button>
                </div>
            </form>
            @include('pages.vision-boards.partials.confirm-delete')
        </div>
    </div>
</div>


