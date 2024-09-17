@extends('layouts.app')

@section('breadcrumb')
    @php
        $breadcrumb = [
            //['title' => 'ui', 'url' => route('product')],
            ['title' => 'Pengguna', 'url' => ''],
        ];
    @endphp
@endsection

@section('content')

    <div class="container mx-auto lg:px-8">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-semibold leading-none text-gray-900 mt-5">
                    Pengguna
                </h1>
                <div class="flex items-center gap-2 text-sm font-medium text-gray-600">
                    Total Pengguna : {{ $totalUser }}
                </div>
            </div>
            <div class="flex items-center gap-2.5 text-lg">
                @include('components.modal-create-user')
                <a class="btn btn-sm btn-primary rounded-full hover:text-sky-700" data-modal-toggle="#modal_6_1">
                <i class="ki-duotone ki-plus-circle"></i>
                    Tambah Pengguna
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto lg:px-8 mb-10">
        <div class="grid">
            <div class="card card-grid min-w-full">
                <div class="card-header py-5 flex-wrap">
                    <h3 class="card-title">
                        Menampilkan <span id="currentTotalUser">{{ $totalUser }}</span> dari {{ $totalUser }} Pengguna
                    </h3>                    
                        <div class="flex gap-6">
                            <div class="relative">
                                <div class="search">
                                    <i class="ki-outline ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 left-0 -translate-y-1/2 ml-3">
                                    </i>
                                        <input class="input input-sm pl-8 rounded-full" placeholder="Cari" type="search" id="search" name="search"/>
                                </div>
                            </div>
                            <!--<button class="btn btn-sm btn-outline btn-primary rounded-full">
                                <i class="ki-duotone ki-filter text-primary"></i>
                                Filters
                            </button>-->
                        </div>
                    </div>

                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="5" data-datatable-state-save="true" id="datatable_1">
                            <div class="scrollable-x-auto">
                                <table class="table table-auto table-border" data-datatable-table="true">
                                    <thead>
                                        <tr>
                                            <th class="w-[100px] text-center">
                                                <span class="sort asc">
                                                        <span class="sort-label">
                                                        No
                                                        </span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th>
                                            <th class="min-w-[185px]">
                                                <span class="sort">
                                                    <span class="sort-label">
                                                        Nama
                                                    </span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th>
                                            <th class="w-[185px]">
                                                <span class="sort">
                                                    <span class="sort-label">
                                                        Email
                                                    </span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th>
                                            <th class="w-[185px]">
                                                <span class="sort">
                                                    <span class="sort-label">
                                                        Peran
                                                    </span>
                                                    <span class="sort-icon">
                                                    </span>
                                                </span>
                                            </th>
                                            <th class="w-[60px]">
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <div class="flex justify-start items-center gap-3">
                                                        <div class="menu-toggle btn btn-icon rounded-full">
                                                            @if($user->image_path)
                                                            <img src="{{ asset($user->image_path) }}" alt="User Image" class="w-10 h-10 rounded-full object-cover">
                                                            @else
                                                                <img src="{{ asset('metronic/dist/assets/media/avatars/blank.png') }}" alt="Default Image" class="w-10 h-10 rounded-full object-cover">
                                                            @endif
                                                        </div>
                                                        <div>
                                                            @include('components.modal-edit-user')
                                                            <a class="text-primary cursor-pointer" data-modal-toggle="#modal_user_{{ $user->id }}">
                                                                {{ $user->name }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    {{ $user->role }}
                                                </td>
                                                <td>
                                                    @include('components.confirm-delete-user')
                                                    <button type="button" class="btn btn-sm btn-icon btn-clear btn-light" 
                                                            data-modal-toggle="#delete_user{{ $user->id }}" 
                                                            data-url="{{ route('user.destroy', $user->id) }}">
                                                        <i class="ki-outline ki-trash"></i>
                                                    </button>
                                                </td>                   
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-3 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2">
                                        Show
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage">
                                    </select>
                                        per page
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span data-datatable-info="true">
                                        </span>
                                        <div class="pagination" data-datatable-pagination="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('blockfoot')
    <script>
        $(document).ready(function() {
            $('#user-form').on('submit', function(e) {
                e.preventDefault(); 
        
                var form = $(this);
                var formData = new FormData(form[0]);
        
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success, 'Berhasil');
                            location.reload(); 
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors || {};

                            if (errors.email) {
                                $('#email-error').removeClass('d-none').text(errors.email[0]);
                            }
                        toastr.error(xhr.responseJSON.error || 'Terjadi kesalahan', 'Gagal');
                    }
                });
            });

            $("#parent-upload").on('click', function(){
                $("#image-upload").trigger('click');
                })
            });

            $("#image-upload").on('change', function(e){
                const reader = new FileReader();
                reader.onload = e => $('.image-input-preview').css('background-image', `url(${e.target.result})`);
                reader.readAsDataURL(this.files[0]);
            });

            function removeImagePreview(event) {
            event.preventDefault();
            event.stopPropagation();

            const imageInput = event.currentTarget.closest('.image-input');

            if (imageInput) {
                const imagePreview = imageInput.querySelector('.image-input-preview');

                if (imagePreview) {
                    imagePreview.style.backgroundImage = "url('metronic/dist/assets/media/avatars/blank.png')";
                } else {
                    console.error('Image preview element not found');
                }
            } else {
                console.error('Image input element not found');
            }
        }
    </script>
    
    <script type="text/javascript">
        $('#search').on('keyup', function() {
            var searchValue = $(this).val();
            let datatable = KTDataTable.getInstance(document.getElementById('datatable_1')); 
            datatable.search(searchValue);
        
            // Event listener untuk ketika datatable selesai diperbarui (pencarian, filter, dsb.)
            datatable.on('datatable-on-layout-updated', function() {
                // Menghitung jumlah baris setelah pencarian, dan mengabaikan baris dengan teks "No records found"
                var rowCount = $('#datatable_1 tbody tr').filter(function() {
                    return !$(this).find('td').text().includes('No records found');
                }).length;
        
                $('#currentTotalUser').text(rowCount + ' pengguna');
        
                // Jika tidak ada hasil, tampilkan pesan khusus
                if (rowCount === 0) {
                    $('#datatable_1 tbody').html('<tr><td colspan="5" class="text-center">Tidak ada pengguna yang ditemukan.</td></tr>');
                }
            });
        });
        
            </script>
        
@endsection
