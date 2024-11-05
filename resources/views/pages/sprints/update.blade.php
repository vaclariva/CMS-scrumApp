@extends('layouts.app')

@section('title')
Detail Sprint
@endsection

@section('breadcrumb')
@php
$breadcrumb = [
    ['title' => 'Sprint', 'url' => ''],
    ['title' => 'Detail', 'url' => ''],
];
@endphp
@endsection

@section('content')
<div class="container-fixed flex items-center justify-center mt-10">
    <div class="w-full">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Detail Sprint
                </h3>
            </div>
            <div class="card-body">
                <form id="updateSprint" action="{{ route('sprints.update', [$productId, $sprint->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="add_start" name="start_date" value="{{ $sprint->start_date }}" />
                    <input type="hidden" id="add_end" name="end_date" value="{{ $sprint->end_date }}" />

                    <div class="w-full py-2">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Nama
                            </label>
                            <input class="input" name="name" type="text" value="{{$sprint->name}}" required />
                        </div>
                    </div>

                    <div class="w-full py-2">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Deskripsi
                            </label>
                            <textarea class="textarea" id="description" name="description">{!! $sprint->description !!}</textarea>
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
                                <input class="input" id="start" name="start_date_display" type="text" value="{{ \Carbon\Carbon::parse($sprint->start_date)->format('d F Y, H:i') }}" required />
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
                                <input class="input" id="end" name="end_date_display" type="text" value="{{ \Carbon\Carbon::parse($sprint->end_date)->format('d F Y, H:i') }}" required />
                            </div>
                        </div>
                    </div>

                    <div class="w-full py-2">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Status
                            </label>
                            <label class="form-label flex items-center gap-2.5 text-nowrap">
                                <input class="checkbox" id="status" name="status" type="checkbox" value="inactive" {{ $sprint->status == 'inactive' ? 'checked' : '' }} />
                                Selesai
                            </label>
                        </div>
                    </div>

                    <!-- Sections to show/hide -->
                    <div id="review_section" class="w-full py-2" style="display: none;">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Hasil Review
                            </label>
                            <textarea class="textarea" id="result_review" name="result_review">{!!$sprint->result_review!!}</textarea>
                        </div>
                    </div>

                    <div id="retrospective_section" class="w-full py-2" style="display: none;">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label flex items-center gap-1 max-w-48">
                                Hasil Retrospective
                            </label>
                            <textarea class="textarea" id="result_retrospective" name="result_retrospective">{!!$sprint->result_retrospective!!}</textarea>
                        </div>
                    </div>

                    <div class="card-footer justify-end gap-4">
                        <a href="{{route('sprints.index', $productId)}}" class="btn btn-light rounded-full">
                            Kembali
                        </a>
                        <button class="btn btn-primary rounded-full" type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {
    const startDateInput = document.getElementById('start');
    const endDateInput = document.getElementById('end');
    const hiddenStartDate = document.getElementById('add_start');
    const hiddenEndDate = document.getElementById('add_end');

    flatpickr(startDateInput, {
        enableTime: true,
        dateFormat: "d F Y, H:i", 
        start_date: "Y-m-d H:i:s",
        defaultDate: startDateInput.value,
        onChange: function(selectedDates, dateStr, instance) {
            hiddenStartDate.value = instance.formatDate(selectedDates[0], "Y-m-d H:i:s"); 
        }
    });

    flatpickr(endDateInput, {
        enableTime: true,
        dateFormat: "d F Y, H:i",  
        end_date: "Y-m-d H:i:s",
        defaultDate: endDateInput.value,
        onChange: function(selectedDates, dateStr, instance) {
            hiddenEndDate.value = instance.formatDate(selectedDates[0], "Y-m-d H:i:s"); 
        }
    });
});

</script>
@endsection

@push('blockfoot')
    <script src="{{ asset('assets/js/sprints/result-update.js') }}"></script>
    <script src="{{ asset('assets/js/sprints/textarea.js') }}"></script>
@endpush