@extends('layouts.app-product')

@section('content')

   

    <div class="flex items-start mt-5">
        <div class="flex-1 p-6 bg-white shadow-lg border-r border-gray-300">
            <div class=" flex justify-between bg-white ml-5 py-5 px-10 lg:px-8">
                <h1 class="text-xl font-semibold px-2 mt-1">Vision Board</h1>
                <a class="btn btn-lg btn-primary rounded-full hover:text-sky-700"data-modal-toggle="#modal_6_1">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="50px" viewBox="0 0 24 24" version="1.1">
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
            </div>
        </div>

        <div class="w-px bg-gray-700 mx-4 h-full"></div>

        <div class="flex-1 p-6 bg-white shadow-lg ">
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
                    <div class="btn-tabs rounded-full text-xs" data-tabs="true">
                        <a class="btn btn-sm rounded-full text-xs" data-tab-toggle="#border-style_1" href="#">
                            <i class="ki-filled ki-row-horizontal text-xs"></i>
                        </a>
                        <a class="btn btn-sm rounded-full text-xs" data-tab-toggle="#border-style_2" href="#">
                            <i class="ki-filled ki-element-8 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-px bg-gray-300 mx-4 h-full"></div>


            
            <div class="bg-gray-50 border rounded-lg p-4 mt-4">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-lg font-semibold">Vision Board Ver 1.3</h2>
                    <div class="space-x-2">
                        <button class="text-blue-500">Edit</button>
                        <button class="text-red-500">Delete</button>
                    </div>
                </div>
                <div class="container py-10 mx-auto px-4 lg:px-8">
                <div class="space-y-2">
                    <div>
                        <h3 class="font-semibold">Vision (Visi)</h3>
                        <p>Pernyataan singkat yang menggambarkan tujuan jangka panjang dari produk tersebut...</p>
                    </div>
                    <div>
                        <h3 class="font-semibold">Target Group (Kelompok Sasaran)</h3>
                        <p>Deskripsi tentang siapa pengguna atau pelanggan utama produk tersebut...</p>
                    </div>
                    <div>
                        <h3 class="font-semibold">Needs (Kebutuhan)</h3>
                        <p>Identifikasi kebutuhan utama dari kelompok sasaran yang harus dipenuhi oleh produk...</p>
                    </div>
                    <div>
                        <h3 class="font-semibold">Product (Produk)</h3>
                        <p>Gambaran singkat tentang produk itu sendiri...</p>
                    </div>
                    <div>
                        <h3 class="font-semibold">Business Goals (Tujuan Bisnis)</h3>
                        <p>Tujuan bisnis yang ingin dicapai melalui pengembangan dan peluncuran produk ini...</p>
                    </div>
                    <div>
                        <h3 class="font-semibold">Competitors (Pesaing)</h3>
                        <p>Analisis singkat tentang pesaing yang ada di pasar...</p>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>

<!--<div class="container py-10 mx-auto px-4 lg:px-8">
    <div class="flex">
        <div class="flex-1 p-6 bg-white shadow-lg  border-r border-gray-300">
            <h2 class="text-xl font-bold">Bagian Kiri</h2>
            <p class="text-gray-700 mt-2">Ini adalah konten dari bagian kiri.</p>
        </div>

        <div class="flex-1 p-6 bg-white shadow-lg ">
            <h2 class="text-xl font-bold px-5">Bagian Tengah</h2>
            <p class="text-gray-700 mt-2 px-5">Ini adalah konten dari bagian tengah.</p>
        </div>
    </div>
</div>-->


@endsection
