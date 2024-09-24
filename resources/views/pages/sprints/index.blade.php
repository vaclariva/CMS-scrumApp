@extends('layouts.app')

@section('title')
Sprint
@endsection

@section('breadcrumb')
@php
$breadcrumb = [
['title' => 'Sprint', 'url' => ''],
];
@endphp
@endsection

@section('content')
<div class="container-fixed mt-10">
    @if($sprints->count() > 0)
    <div class="container mx-auto lg:px-8">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-semibold leading-none text-gray-900 mt-5">
                    Kelola Sprint
                </h1>
                <div class="flex items-center gap-2 text-sm font-medium text-gray-600">
                    Total Sprint : {{ $sprints->count() }}
                </div>
            </div>
            <div class="flex items-center gap-2.5 text-lg">

                <a href="{{route('sprints.create', $product->id)}}" class="btn btn-sm btn-primary rounded-full hover:text-sky-700">
                    <i class="ki-duotone ki-plus-circle"></i>
                    Tambah Sprint
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto lg:px-8 mb-10">
        <div class="grid">
            <div class="card card-grid min-w-full">
                <div class="card-header py-5 flex-wrap">
                    <h3 class="card-title">
                        Menampilkan <span id="currentTotalSprint">{{ $sprints->count() }}</span> dari {{ $sprints->count() }} Sprint
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
                                        <th class="w-auto text-center">
                                            <span class="sort asc">
                                                <span class="sort-label">
                                                    No
                                                </span>
                                                <span class="sort-icon">
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-auto">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Nama
                                                </span>
                                                <span class="sort-icon">
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-auto">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Deskripsi
                                                </span>
                                                <span class="sort-icon">
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-auto">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Mulai
                                                </span>
                                                <span class="sort-icon">
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-auto">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Berakhir
                                                </span>
                                                <span class="sort-icon">
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-auto">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Hasil Review
                                                </span>
                                                <span class="sort-icon">
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-auto">
                                            <span class="sort">
                                                <span class="sort-label">
                                                    Hasil Retrospective
                                                </span>
                                                <span class="sort-icon">
                                                </span>
                                            </span>
                                        </th>
                                        <th class="w-auto">
                                        </th>
                                        <th class="w-auto">
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sprints as $sprint)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{$sprint->name}}
                                        </td>
                                        <td>
                                            {!! $sprint->description !!}
                                        </td>
                                        <td>
                                            {{ $sprint->start_date }}
                                        </td>
                                        <td>
                                            {{ $sprint->end_date }}
                                        </td>
                                        <td>
                                            {!! $sprint->result_review !!}
                                        </td>
                                        <td>
                                            {!! $sprint->result_retrospective !!}
                                        </td>
                                        <td>
                                            <span class="badge badge-dot size-2 badge-{{ $sprint->status }}">
                                            </span>
                                        </td>
                                        <td>
                                            @include('components.modal.confirm-delete-sprint')
                                            <button type="button" class="btn btn-sm btn-icon btn-clear btn-light"
                                                data-modal-toggle="#delete_sprint{{ $sprint->id }}">
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
    @else
    <div class="justify-center items-center">
        <img class="mx-auto" src="{{ asset('metronic/dist/assets/media/images/2600x1600/tambah-produk.png') }}" />
        <div class="text-center mb-2.5">
            <h3 class="text-lg font-semibold text-gray-900 leading-none mb-2.5">
                Belum Ada Sprint
            </h3>
            <div class="flex items-center justify-center font-medium">
                <span class="text-2sm text-gray-600 me-1.5 mb-5">
                    Klik tombol dibawah untuk menambahkan sprint.
                </span>
            </div>
        </div>
        <div class="flex justify-center gap-2.5 text-xl px-10">
            <a href="{{route('sprints.create', $product->id)}}" class="btn btn-sm btn-primary rounded-full hover:text-sky-700 py-5">
                <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35px" height="20px" viewBox="0 0 24 24" version="1.1">
                        <title>Stockholm-icons / Navigation / Plus</title>
                        <desc>Created with Sketch.</desc>
                        <defs />
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1" />
                            <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1" />
                        </g>
                    </svg></span>
                Tambah Sprint
            </a>
        </div>
    </div>
    @endif
</div>
@endsection