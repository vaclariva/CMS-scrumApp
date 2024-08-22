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

    <div class="container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-semibold leading-none text-gray-900">
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

    <div class="container-fixed">
        <div class="grid">
            <div class="card card-grid min-w-full">
                <div class="card-header py-5 flex-wrap">
                    <h3 class="card-title">
                    Menampilkan ... dari {{ $totalUser }} Pengguna
                    </h3>
                        <div class="flex gap-6">
                            <div class="relative">
                                <i class="ki-outline ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 left-0 -translate-y-1/2 ml-3">
                                </i>
                                    <input class="input input-sm pl-8 rounded-full" placeholder="Search Members" type="text"/>
                            </div>
                            <button class="btn btn-sm btn-outline btn-primary rounded-full">
                                <i class="ki-duotone ki-filter text-primary"></i>
                                Filters
                            </button>
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
                                                    {{$loop->iteration}}
                                                </span>
                                                </td>
                                                <td>
                                                    @include('components.modal-edit-user', ['route' => route('user.update', $user->id), 'user' => $user   ])
                                                    <a class="text-primary" data-modal-toggle="#modal_{{ $user->id }}">
                                                        {{$user->name}}
                                                    </a>
                                                </td>                    
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                <td>
                                                    {{$user->role}}
                                                </td>
                                                <td>
                                                    @include('components.confirm-delete', ['route' => route('user.destroy', $user->id)])
                                                
                                                    <button type="button" class="btn btn-sm btn-icon btn-clear btn-light" 
                                                            data-modal-toggle="#delete_{{ $user->id }}"
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

            // $("#image-upload").on('change', function(){
            //     console.log('change');
            //     console.log($(this).val());
            // });

            // const imageInputEl = document.querySelector('#parent-upload');
            // const options = {
            //     hiddenClass: 'hidden'
            // };

            // const imageInput = new KTImageInput(imageInputEl, options);
            // imageInput.on('changed', () => {
            //     console.log('changed event');
            //     console.log(imageInput.isChanged());
            //     console.log(imageInput.getElement());
            //     console.log(imageInput.getPreviewUrl());
            // });
         
            $("#parent-upload").on('click', function(){
                $("#image-upload").trigger('click');
                })
            });

            $("#image-upload").on('change', function(e){
                const reader = new FileReader();
                reader.onload = e => $('.image-input-preview').css('background-image', `url(${e.target.result})`);
                reader.readAsDataURL(this.files[0]);
            });
    </script>
@endsection