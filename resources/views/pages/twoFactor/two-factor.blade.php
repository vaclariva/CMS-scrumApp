@extends('layouts.app')
@section('title')
Two Factor
@endsection
@section('breadcrumb')
@php
$breadcrumb = [
['title' => 'Two Factor', 'url' => ''],
];
@endphp
@endsection

@section('content')

<div class="container-fixed mt-4" id="content_container">
    <div class="container mx-auto lg:px-8">
        <div class="card">
            <div class="card-header">
                <div class="flex flex-col gap-1">
                    <h3 class="card-title text-lg font-semibold">
                        Two Factor Authentication
                    </h3>
                    <span class="text-gray-600 text-sm">
                        Untuk keamanan, selalu aktifkan two-factor authentication. Nonaktifkan jika tidak diperlukan.
                    </span>
                </div>
            </div>            
            <div class="card-body">
                <div class="flex items-center gap-10 mb-8 ">
                    <label class="text-md font-semibold w-1/3 text-gray-800">Two-Factor Authentication</label>
                
                    <div class="flex gap-10">
                        <label class="form-label flex items-center gap-2.5 text-nowrap">
                            <input type="radio" id="enabled" name="enabled_2fa" value="1"
                                   class="radio">
                            Aktif
                        </label>
                
                        <label class="form-label flex items-center gap-2.5 text-nowrap">
                            <input type="radio" id="disabled" name="enabled_2fa" value="0"
                                   class="radio">
                            Nonaktif
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="card-footer justify-end">
                <div class="flex gap-4">
                    <button class="btn btn-light rounded-full" data-modal-dismiss="true" type="button">
                        Batal
                    </button>
                    <button class="btn btn-primary ms-3 rounded-full" type="submit">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection