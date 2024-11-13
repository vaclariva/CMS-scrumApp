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
                        <button class="btn btn-icon rounded-full active" data-filter="random" onclick="filterBacklogs('random', this)">
                            <i class="ki-filled ki-row-horizontal text-xs"></i>
                        </button>
                        <button class="btn btn-icon rounded-full" data-filter="sprint" onclick="filterBacklogs('sprint', this)">
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
    <!-- Listing vision boards dan backlog -->
    <div class="grid grid-cols-2 gap-10 mt-5 mr-5 ml-5">
        @include('pages.vision-boards.vision')
        @include('pages.backlogs.backlog')
    </div>

    <!-- modal dan drawer untuk vision boards dan backlog -->
    @foreach ($visionBoards as $item)
    @include('pages.vision-boards.partials.modal-edit-vision-board')
    @endforeach

    @foreach ($backlogs as $backlog)
    @php
        $checklists = $backlog->checklists()->get(); 
        $jumlahChecklistSelesai = $checklists->where('status', 1)->count();
        $jumlahChecklistTotal = $checklists->count();
        $persentase = $jumlahChecklistTotal > 0 ? ($jumlahChecklistSelesai / $jumlahChecklistTotal) * 100 : 0;
    @endphp

    @include('pages.backlogs.partials.drawer-edit', [
        'checklists' => $checklists,
    ])
    @endforeach

@endsection

@push('blockfoot')
    <script>
        var productId = @json($product->id);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.title-card-backlog').forEach(textarea => {
                // Set initial height based on scrollHeight when the page loads
                textarea.style.height = 'auto';
                textarea.style.height = `${textarea.scrollHeight}px`;

                // Add an event listener to adjust height on input
                textarea.addEventListener('input', () => {
                    textarea.style.height = 'auto';
                    textarea.style.height = `${textarea.scrollHeight}px`;
                });

                // Add an event listener to disable Enter key
                textarea.addEventListener('keydown', (event) => {
                    if (event.key === 'Enter') {
                        event.preventDefault(); // Prevent Enter from creating a new line
                    }
                });
            });
        });
    </script>


    <script src="{{ asset('assets/js/vision-boards/create.js') }}"></script>
    <script src="{{ asset('assets/js/vision-boards/card.js') }}"></script>
    <script src="{{ asset('assets/js/vision-boards/modal-edit.js') }}"></script>
    <script src="{{ asset('assets/js/vision-boards/modal-delete.js') }}"></script>
    <script src="{{ asset('assets/js/backlogs/create.js') }}"></script>
    <script src="{{ asset('assets/js/backlogs/modal-delete.js') }}"></script>
    <script src="{{ asset('assets/js/backlogs/card.js') }}"></script>
@endpush


<script>
</script>