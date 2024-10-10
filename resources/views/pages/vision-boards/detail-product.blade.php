@extends('layouts.app-product')
@section('title')
{{ $product->name }}
@endsection
@section('content')

<div class="flex items-start mt-5">
    <div class="flex-1 p-6 bg-white shadow-lg border-r border-gray-300">
        <div class="flex justify-between bg-white ml-4 py-5 px-10 lg:px-8">
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-semibold pl-2 mt-1">Vision Board</h1>
                <sub class="text-gray-600">{{$visionBoards->count()}} Versi</sub>
            </div>
            <a class="btn btn-lg btn-primary rounded-full hover:text-sky-700" id="createVisionBoardBtn">
                <span class="svg-icon svg-icon-primary svg-icon-2x">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                        <title>Stockholm-icons / Navigation / Plus</title>
                        <desc>Created with Sketch.</desc>
                        <defs />
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1" />
                            <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1" />
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
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-semibold mt-1">Backlog</h1>
                <sub class="text-gray-600">{{$backlogs->count()}} Versi</sub>
            </div>
            <div class="flex gap-2">
                <a class="btn btn-lg btn-primary rounded-full hover:text-sky-700" id="createBacklog" >
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                            <title>Stockholm-icons / Navigation / Plus</title>
                            <desc>Created with Sketch.</desc>
                            <defs />
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1" />
                                <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1" />
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
        <form id="Form" style="display: none;" method="POST" action="{{ route('backlog.store', ['productId' => $product->id]) }}">
            @csrf
            <input type="hidden" id="productId" name="product_id">
            <input type="hidden" name="name" value="Untitled">
            <button type="submit" id="SubmitButton">Kirim</button>
        </form>
    </div>
</div>

<div class="grid grid-cols-2 gap-10 mt-5 mr-5 ml-5">
    <div class="vision-board-section space-y-5">
        @if ($visionBoards->isEmpty())
            <p class="p-8 text-gray-500">Belum ada vision board</p>
        @else
            @foreach ($visionBoards as $item)
                <div class="vision-board">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title custom-" contenteditable="true" data-id="{{ $item->id }}" id="item-name-{{ $item->id }}">
                                {{ $item->name }}
                            </h3>
                            <div class="flex gap-2 items-center">
                                <a class="menu-link" onclick="openEditModalVision({
                                    id: {{ $item->id }},
                                    name: '{{ $item->name }}',
                                    vision: '{!! $item->vision !!}',
                                    target_group: '{!! $item->target_group !!}',
                                    needs: '{!! $item->needs !!}',
                                    product: '{!! $item->product !!}',
                                    business_goals: '{!! $item->business_goals !!}',
                                    competitors: '{!! $item->competitors !!}',
                                    url_update: '{{ route('visionBoard.update', [$product->id, $item->id]) }}'
                                })">
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
                                                <form action="{{ route('visionBoard.duplicate', ['product' => $product->id, 'visionBoard' => $item->id]) }}" method="POST" class="mb-1">
                                                    @csrf
                                                    <button type="submit" class="text-xs w-full">
                                                        <div class="flex items-center pl-5 menu-link">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-copy"></i>
                                                            </span>
                                                            <span class="menu-title">Duplikat</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" onclick="openDeleteModalVision({
                                                    id: {{ $item->id }},
                                                    name: '{{ $item->name }}',
                                                    url_delete: '{{ route('visionBoard.destroy', [$product->id, $item->id]) }}'
                                                })">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-trash"></i>
                                                    </span>
                                                    <span class="menu-title">Hapus</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (
                                    !$item->vision &&
                                    !$item->target_group &&
                                    !$item->needs &&
                                    !$item->product &&
                                    !$item->business_goals
                                )
                                    <!-- No content needed here -->
                                @else
                                    <div class="card-toolbar rotate">
                                        <i class="ki-duotone ki-down fs-1"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
    
                        <div class="card-body-vision">
                            @if($item->vision)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Vision (Visi) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->vision !!}</div>
                                </div>
                            @endif
                        
                            @if($item->target_group)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Target Group (Kelompok Sasaran) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->target_group !!}</div>
                                </div>
                            @endif
                        
                            @if($item->needs)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Needs (Kebutuhan) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->needs !!}</div>
                                </div>
                            @endif
                        
                            @if($item->product)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Product (Product) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->product !!}</div>
                                </div>
                            @endif
                        
                            @if($item->business_goals)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Business Goals (Tujuan Bisnis) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->business_goals !!}</div>
                                </div>
                            @endif
                        
                            @if($item->competitors)
                                <div class="mb-5">
                                    <span class="px-2.5" style="font-weight: 500;"> • Competitors (Pesaing) </span><br>
                                    <div class="board-sub text-gray-600">{!! $item->competitors !!}</div>
                                </div>
                            @endif
                        </div>                        
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    

    <div class="backlog-section space-y-5">
        <div class="backlog">
            @if ($backlogs->isEmpty())
            <p class="p-8 text-gray-500">Belum ada vision board</p>
        @else
            @foreach ($backlogs as $backlog)
                @if (!empty($backlog->name) && !empty($backlog->product_id) && empty($backlog->priority) && empty($backlog->description) && empty($backlog->hours) && empty($backlog->status))
                    <!-- Kerangka kosongan -->
                    <div class="vision-board">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title custom-" contenteditable="true" data-id="{{ $backlog->id }}" id="name-{{ $backlog->id }}">
                                    {{ $backlog->name }}
                                </h3>
                                <div class="flex gap-2 items-center">
                                    <a class="menu-link" onclick="showDrawer({{ $product->id }}, {{ $backlog->id }})">
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
                                                    <form action="{{ route('backlogs.duplicate', ['product' => $product->id, 'backlog' => $backlog->id]) }}" method="POST" class="mb-1">
                                                        @csrf
                                                        <button type="submit" class="text-xs w-full">
                                                            <div class="flex items-center pl-5 menu-link">
                                                                <span class="menu-icon">
                                                                    <i class="ki-duotone ki-copy"></i>
                                                                </span>
                                                                <span class="menu-title">Duplikat</span>
                                                            </div>
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="menu-item">
                                                    <a class="menu-link" onclick="openDeleteBacklog({
                                                        id: {{ $backlog->id }},
                                                        name: '{{ $backlog->name }}',
                                                        url_delete: '{{ route('backlogs.destroy', [$product->id, $backlog->id]) }}'})">
                                                        <span class="menu-icon">
                                                            <i class="ki-duotone ki-trash"></i>
                                                        </span>
                                                        <span class="menu-title">Hapus</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- listing data sudah terisi -->
                    <div class="card mb-3">
                        <div class="card-body title-backlog mb-0">
                            {{$backlog->name}}
                        </div>
                        <div class="flex justify-between">
                            <div class="px-7 pb-4 flex items-center gap-3">
                                <!-- Badge Priority -->
                                <span class="badge badge-pill badge-outline gap-1.5
                                    @if($backlog->priority == 'Tinggi')
                                        badge-danger
                                    @elseif($backlog->priority == 'Sedang')
                                        badge-warning
                                    @elseif($backlog->priority == 'Rendah')
                                        badge-success
                                    @else
                                        badge-primary
                                    @endif">
                                    <span class="badge badge-dot
                                        @if($backlog->priority == 'Tinggi')
                                            badge-danger
                                        @elseif($backlog->priority == 'Sedang')
                                            badge-warning
                                        @elseif($backlog->priority == 'Rendah')
                                            badge-success
                                        @else
                                            badge-primary
                                        @endif size-1.5"></span>
                                    {{ $backlog->priority ?? 'Belum Ditentukan' }}
                                </span>
        
                                <!-- Icon Description -->
                                @if(!empty($backlog->description))
                                    <i class="ki-duotone ki-textalign-left"></i>
                                @endif

                                <div class="flex text-success items-center text-xs">
                                    <i class="ki-duotone ki-check-squared text-success text-lg"></i>
                                    10/10
                                </div>
        
                                <!-- Hours -->
                                @if(!empty($backlog->hours))
                                <div class="flex items-center text-xs">
                                    <i class="ki-duotone ki-timer text-lg"></i>
                                    <span class="ml-1"> {{$backlog->hours}} Jam</span>
                                </div>
                                @endif

                                <!-- Status Check -->
                                @if($backlog->status == 1)
                                <div class="flex items-center text-xs text-success">
                                    <i class="ki-duotone ki-flag text-lg"></i>
                                    <span class="ml-1">Selesai</span>
                                </div>
                                @endif
        
                                <!-- Product Owner Image -->
                                <div class="flex items-center">
                                    <div class="menu-toggle btn btn-icon rounded-full">
                                        @if($productOwner->image)
                                        <img src="{{ asset('/storage/'. $productOwner->image) }}" alt="{{Auth::user()->name}}" class="w-5 h-5 rounded-full object-cover">
                                        @else
                                        <img src="{{ asset('metronic/dist/assets/media/avatars/blank.png') }}" alt="Default Image" class="w-5 h-5 rounded-full object-cover">
                                        @endif
                                    </div>
                                    <span class="text-xs">{{$productOwner->name}}</span>
                                </div>
                            </div>
        
                            <!-- Dropdown Menu -->
                            <div>
                                <div class="dropdown relative" data-dropdown="true" data-dropdown-placement="bottom-end" data-dropdown-trigger="click">
                                    <button class="dropdown-toggle btn hover:text-gray-50">
                                        <i class="ki-filled ki-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-content absolute left-0 mt-2 w-full max-w-56 py-2 bg-white shadow-lg z-10">
                                        <div class="menu menu-default flex flex-col w-full">
                                            <div class="menu-item">
                                                <a class="menu-link" onclick="showDrawer({{ $product->id }}, {{ $backlog->id }})">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-notepad-edit"></i>
                                                    </span>
                                                    <span class="menu-title">Edit</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <form action="{{ route('backlogs.duplicate', ['product' => $product->id, 'backlog' => $backlog->id]) }}" method="POST" class="mb-1">
                                                    @csrf
                                                    <button type="submit" class="text-xs w-full">
                                                        <div class="flex items-center pl-5 menu-link">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-copy"></i>
                                                            </span>
                                                            <span class="menu-title">Duplikat</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" onclick="openDeleteModalVision({})">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-file-down"></i>
                                                    </span>
                                                    <span class="menu-title">Unduh PDF</span>
                                                </a>
                                            </div>
                                            <div class="menu-item">
                                                <a class="menu-link" onclick="openDeleteBacklog({
                                                    id: {{ $backlog->id }},
                                                    name: '{{ $backlog->name }}',
                                                    url_delete: '{{ route('backlogs.destroy', [$product->id, $backlog->id]) }}'})">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-trash"></i>
                                                    </span>
                                                    <span class="menu-title">Hapus</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif        
        </div>
    </div>
</div>
</div>

@endsection

@if($visionBoards->count() > 0)
@include('pages.vision-boards.partials.modal-edit-vision-board')
@endif
@foreach ($backlogs as $backlog)
@include('pages.backlogs.partials.drawer-edit')
@endforeach



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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var productId = @json($product->id);

        document.getElementById('createBacklog').addEventListener('click', function() {
            document.getElementById('productId').value = productId;

            var form = document.getElementById('Form');

            form.submit();
        });
    });
</script>

<script>
    function openEditModalVision(data) { 

        $('#updateVisionBoardForm').attr('action', data.url_update);

        document.getElementById('name').value = data.name || '';
        document.getElementById('vision').value = data.vision || '';
        editors[0].setData(data.target_group);
        editors[1].setData(data.needs);
        editors[2].setData(data.product);
        editors[3].setData(data.business_goals);
        editors[4].setData(data.competitors);
        showModal('modal_draggable');
    }

    document.querySelectorAll('[data-modal-dismiss="true"]').forEach(button => {
        button.addEventListener('click', closeEditModal);
    });

    function closeEditModal() {
        hideModal('modal_draggable');
    }

    function showModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('open');
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
        } else {
            console.error('Modal with id ' + modalId + ' not found');
        }
    }

    function hideModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('open');
            modal.setAttribute('aria-hidden', 'true');
        } else {
            console.error('Modal with id ' + modalId + ' not found');
        }
    }
</script>

<script>
    function openDeleteModalVision(data) {
        $('#delete-form').attr('action', data.url_delete);
        $('#delete_name').text(data.name);

        console.log('Data:', data);
        console.log('Form action set to:', $('#delete-form').attr('action'));

        showModal('delete');
    }

    function closeDeleteModal() {
        hideModal('delete');
    }

    function showModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('open');
            modal.classList.remove('hidden');
        } else {
            console.error('Modal with id ' + modalId + ' not found');
        }
    }

    function hideModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('open');
        } else {
            console.error('Modal with id ' + modalId + ' not found');
        }
    }

    document.querySelectorAll('[data-modal-dismiss]').forEach(function(btn) {
        btn.addEventListener('click', closeDeleteModal);
    });
</script>

<script>
    function openDeleteBacklog(data) {
        $('#delete-form').attr('action', data.url_delete);
        $('#delete_name').text(data.name);

        console.log('Data:', data);
        console.log('Form action set to:', $('#delete-form').attr('action'));

        showModal('delete');
    }

    function closeDeleteModal() {
        hideModal('delete');
    }

    function showModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('open');
            modal.classList.remove('hidden');
        } else {
            console.error('Modal with id ' + modalId + ' not found');
        }
    }

    function hideModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('open');
        } else {
            console.error('Modal with id ' + modalId + ' not found');
        }
    }

    document.querySelectorAll('[data-modal-dismiss]').forEach(function(btn) {
        btn.addEventListener('click', closeDeleteModal);
    });
</script>

<script>
    function showDrawer(productId, backlogId) {
        // Buat URL berdasarkan route
        var url = "{{ route('backlogs.edit', ['product' => ':product', 'backlog' => ':backlog']) }}";
        url = url.replace(':product', productId).replace(':backlog', backlogId);


        // Ambil elemen drawer berdasarkan ID
        var drawerElement = document.getElementById('drawer_4');

        // Dapatkan instance dari KTDrawer untuk drawer tersebut
        var drawer = KTDrawer.getInstance(drawerElement);

        // Jika drawer belum diinisialisasi, inisialisasi secara manual
        if (!drawer) {
            drawer = KTDrawer.createInstances();
            drawer = KTDrawer.getInstance(drawerElement);
        }

        // Lakukan permintaan AJAX untuk mendapatkan data
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                console.log(response);

                // Tampilkan drawer
                drawer.show();
            },
            error: function(xhr) {
                // Tangani kesalahan jika ada
                alert('Error: ' + xhr.status + ' ' + xhr.statusText);
            }
        });
    }

    // Fungsi untuk menutup drawer
    function closeDrawer() {
        var drawerElement = document.getElementById('drawer_4');
        var drawer = KTDrawer.getInstance(drawerElement);

        // Sembunyikan drawer jika sudah diinisialisasi
        if (drawer) {
            drawer.hide();
        }
    }
</script>