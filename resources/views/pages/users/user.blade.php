@extends('layouts.app')
@section('title')
Pengguna
@endsection
@section('breadcrumb')
@php
$breadcrumb = [
['title' => 'Pengguna', 'url' => ''],
];
@endphp
@endsection

@section('content')

<div class="container-fixed" id="content_container">
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
                @include('pages.users.partials.modal-create-user')
                <a class="btn btn-sm btn-primary rounded-full hover:text-sky-700" data-modal-toggle="#modal_6_1" id="modal-add">
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
                                <input class="input input-sm pl-8 rounded-full" placeholder="Cari" type="search" id="search" name="search" />
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
                                                    @if($user->image)
                                                    <img src="{{ asset('/storage/'.$user->image) }}" alt="{{$user->name}}" class="w-10 h-10 rounded-full object-cover">
                                                    @else
                                                    <img src="{{ asset('metronic/dist/assets/media/avatars/blank.png') }}" alt="Default Image" class="w-10 h-10 rounded-full object-cover">
                                                    @endif
                                                </div>
                                                <div>
                                                    @include('pages.users.partials.modal-edit-user')
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
                                            {{ $user->role->name }}
                                        </td>
                                        <td>
                                            @include('pages.users.partials.confirm-delete-user')
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
@endsection

@push('blockfoot')
    <script>
        var urlIndex = "{{ route('role.index') }}";
    </script>
    <script src="{{ asset('assets/js/users/picture.js') }}"></script>
    <script src="{{ asset('assets/js/users/role.js') }}"></script>
    <script src="{{ asset('assets/js/users/search.js') }}"></script>
@endpush