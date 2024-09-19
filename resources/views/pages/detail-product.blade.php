@extends('layouts.app-product')

@section('content')

<div class="flex items-start mt-5">
    <div class="flex-1 p-6 bg-white shadow-lg border-r border-gray-300">
        <div class="flex justify-between bg-white ml-4 py-5 px-10 lg:px-8">
            <h1 class="text-xl font-semibold pl-2 mt-1">Vision Board</h1>
            <a class="btn btn-lg btn-primary rounded-full hover:text-sky-700" id="createVisionBoardBtn">
                <span class="svg-icon svg-icon-primary svg-icon-2x">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                        <title>Stockholm-icons / Navigation / Plus</title>
                        <desc>Created with Sketch.</desc>
                        <defs/>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                            <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                        </g>
                    </svg>
                </span>
                Buat Baru
            </a>
        </div>
    </div>
    
    <form id="hiddenForm" style="display: none;" method="POST" action="{{ route('vision-board.store') }}">
        @csrf
        <input type="hidden" id="productIdField" name="product_id">
        <input type="hidden" name="name" value="Untitled">
        <button type="submit" id="hiddenSubmitButton">Kirim</button>
    </form>    

    <div class="w-px bg-gray-700 mx-4 h-full"></div>

    <div class="flex-1 p-6 bg-white shadow-lg">
        <div class="flex justify-between bg-white ml-5 mr-5 py-5 px-10 lg:px-8">
            <h1 class="text-xl font-semibold px-2 mt-1">Backlog</h1>
            <div class="flex gap-2">
                <a class="btn btn-lg btn-primary rounded-full hover:text-sky-700" data-modal-toggle="#modal_6_1">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                        <title>Stockholm-icons / Navigation / Plus</title>
                        <desc>Created with Sketch.</desc>
                        <defs/>
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                            <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                        </g>
                    </svg></span>
                    Buat Baru
                </a>
                <div class="btn-tabs rounded-full">
                    <button class="btn btn-icon rounded-full active">
                        <i class="ki-filled ki-row-horizontal text-xs"></i>
                    </button>
                    <button class="btn btn-icon rounded-full">
                        <i class="ki-filled ki-element-8 text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-2 gap-10 mt-5 mr-5 ml-5">
    <div class="vision-board-section space-y-5">
        @foreach ($vision_boards as $item)
            <div class="vision-board">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">{{ $item->name }}</h3>
                        <div class="flex gap-2 items-center">
                            @include('components.modal.modal-edit-vision-boards')
                            <a class="menu-link" data-modal-toggle="#modal_draggable">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-notepad-edit text-xl"></i>
                                </span>
                            </a>
                            <div class="dropdown relative" data-dropdown="true" data-dropdown-placement="bottom-end" data-dropdown-trigger="click">
                                <button class="dropdown-toggle btn hover:text-gray-50">
                                    <i class="ki-filled ki-dots-vertical"></i>
                                </button>
                                <div class="dropdown-content absolute left-0 mt-2 w-full max-w-56 py-2 bg-white shadow-lg z-10">
                                    <div class="menu menu-default flex flex-col w-full">
                                        <div class="menu-item">
                                            <div class="flex items-center pl-5 menu-link">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-copy"></i>
                                                </span>
                                                <form action="#" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-xs">Duplikat</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="menu-item">
                                            <a class="menu-link" id="delete_product">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-trash"></i>
                                                </span>
                                                <span class="menu-title">Hapus</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-toolbar rotate">
                                <i class="ki-duotone ki-down fs-1"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body-vision pl-5">
                        <div class="mb-5">
                            <span class="px-2.5" style="font-weight: 500;"> • Vision (Visi) </span><br>
                            <p class="board-sub text-gray-600 justify-between">{{ $item->vision }}</p>
                        </div>
                        <div class="mb-5">
                            <span class="px-2.5" style="font-weight: 500;"> • Target Group (Kelompok Sasaran) </span><br>
                            <p class="board-sub text-gray-600">{{ $item->target_group }}</p>
                        </div>
                        <div class="mb-5">
                            <span class="px-2.5" style="font-weight: 500;"> • Needs (Kebutuhan) </span><br>
                            <p class="board-sub text-gray-600">{{ $item->needs }}</p>
                        </div>
                        <div class="mb-5">
                            <span class="px-2.5" style="font-weight: 500;"> • Product (Product) </span><br>
                            <p class="board-sub text-gray-600">{{ $item->product }}</p>
                        </div>
                        <div class="mb-5">
                            <span class="px-2.5" style="font-weight: 500;"> • Business Goals (Tujuan Bisnis) </span><br>
                            <p class="board-sub text-gray-600">{{ $item->business_goals }}</p>
                        </div>
                        <div class="mb-5">
                            <span class="px-2.5" style="font-weight: 500;"> • Competitors (Pesaing) </span><br>
                            <p class="board-sub text-gray-600">{{ $item->competitors }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!--<div class="backlog-section space-y-5">
        <div class="backlog">
            <div class="card">
                <div class="card-body-backlog">
                    <p>backlog</p>
                </div>
            </div>
        </div>
    </div>-->
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.card-toolbar').forEach(function(toolbar) {
            toolbar.addEventListener('click', function() {
                const cardBody = this.closest('.card').querySelector('.card-body-vision');
                cardBody.classList.toggle('show');
                this.classList.toggle('rotate-180');
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var productId = @json($product->id);

        document.getElementById('createVisionBoardBtn').addEventListener('click', function() {
            document.getElementById('productIdField').value = productId;

            var form = document.getElementById('hiddenForm');
 
            form.submit();
        });
    });
</script>

