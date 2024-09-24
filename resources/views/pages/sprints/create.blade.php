@extends('layouts.app')

@section('title')
Tambah Sprint
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
    <div class="w-full">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Tambah Sprint
                </h3>
            </div>
            <form action="{{route('sprints.store', $id)}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$id}}">
                <input type="hidden" id="input_start_date" name="start_date">
                <input type="hidden" id="input_end_date" name="end_date">
                <div class="card-body">
                    <div class="w-full py-2">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Nama
                            </label>
                            <input class="input" name="name" type="text" />
                        </div>
                    </div>
                    <div class="w-full py-2">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Deskripsi
                            </label>
                            <textarea class="textarea" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="w-full py-2">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Mulai
                            </label>
                            <div class="input-group w-full">
                                <span class="btn btn-icon btn-icon-lg btn-input">
                                    <i class="ki-duotone ki-calendar text-3xl text-gray-500"></i>
                                </span>
                                <input class="input" id="start_date" name="start_date_display" type="text" value="" required />
                            </div>
                        </div>
                    </div>
                    <div class="w-full py-2">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Berakhir
                            </label>
                            <div class="input-group w-full">
                                <span class="btn btn-icon btn-icon-lg btn-input">
                                    <i class="ki-duotone ki-calendar text-3xl text-gray-500"></i>
                                </span>
                                <input class="input" id="end_date" name="end_date_display" type="text" value="" required />
                            </div>
                        </div>
                    </div>
                    <div class="w-full py-2">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Status
                            </label>
                            <label class="form-label flex items-center gap-2.5 text-nowrap">
                                <input class="checkbox" name="status" type="checkbox" value="inactive" />
                                Selesai
                            </label>
                        </div>
                    </div>
                    <div class="w-full py-2">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Hasil Review
                            </label>
                            <textarea class="textarea" id="result_review" name="result_review"></textarea>
                        </div>
                    </div>
                    <div class="w-full py-2">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Hasil Retrospective
                            </label>
                            <textarea class="textarea" id="result_retrospective" name="result_retrospective"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer justify-end gap-4">
                    <a href="#" class="btn btn-light rounded-full">
                        Batal
                    </a>
                    <button class="btn btn-primary rounded-full" type="submit">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const textareas = document.querySelectorAll('.textarea');

    textareas.forEach(textarea => {
        ClassicEditor
            .create(textarea, {
                rows: 10,
                toolbar: [
                    'undo',
                    'redo',
                    'heading',
                    '|',
                    'alignment',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    'link',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'insertTable',
                    'blockQuote',
                ],
            })
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error('Error during initialization of the editor', error);
            });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#start_date", {
            enableTime: true,
            dateFormat: "d F Y, H:i",
            time_24hr: true,
            locale: 'id',
            onChange: function(selectedDates, dateStr, instance) {
                const formattedDate = instance.formatDate(selectedDates[0], "Y-m-d H:i:s");
                document.getElementById('input_start_date').value = formattedDate;
            }
        });

        flatpickr("#end_date", {
            enableTime: true,
            dateFormat: "d F Y, H:i",
            time_24hr: true,
            locale: 'id',
            onChange: function(selectedDates, dateStr, instance) {
                const formattedDate = instance.formatDate(selectedDates[0], "Y-m-d H:i:s");
                document.getElementById('input_end_date').value = formattedDate;
            }
        });
    });
</script>
@endsection