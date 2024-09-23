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
<div class="container-fixed flex items-center justify-center mt-10">
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
            <a href="{{route('sprints.create')}}" class="btn btn-sm btn-primary rounded-full hover:text-sky-700 py-5">
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
</div>
@endsection