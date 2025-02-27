<!doctype html>
<html class="h-full" data-theme="true" data-theme-mode="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name', 'App') }} - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
        <link href="{{ asset('metronic/dist/assets/media/app/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180"/>
        <link href="{{ asset('metronic/dist/assets/media/app/favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png"/>
        <link href="{{ asset('metronic/dist/assets/media/app/favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png"/>
        <link href="{{ asset('metronic/dist/assets/media/app/mini-logo.svg') }}" rel="shortcut icon" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
        <link href="{{ asset('metronic/dist/assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet"/>
        <link href="{{ asset('metronic/dist/assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet"/>
        <link href="{{ asset('metronic/dist/assets/css/styles.css') }}" rel="stylesheet"/>
        <link href="{{ asset('assets/css/global.css') }}" rel="stylesheet"/>
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <!-- Include CKEditor 5 from CDN -->
        <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
        @yield('blockhead')
        <style>
            .ck-editor {
                width: 100% !important;
            }
            .toast-success .toast-message,
            .toast-error .toast-message {
                margin-left: 0.75rem; 
            }
            .toast-success .toast-title,
            .toast-error .toast-title {
                margin-left: 0.75rem; 
            }

            .title-card-backlog {
                display: block;
                width: 100%;
                line-height: 24px;
                min-height: 24px;
                resize: none;
                -webkit-appearance: none;
                overflow-y: auto;
            }

            
        </style>
    </head>
    
    <body class="flex h-full demo1 sidebar-fixed header-fixed bg-white dark:bg-coal-500">
        <script>
            const defaultThemeMode = 'light';
            let themeMode;
    
            if ( document.documentElement ) {
                if ( localStorage.getItem('theme')) {
                        themeMode = localStorage.getItem('theme');
                } else if ( document.documentElement.hasAttribute('data-theme-mode')) {
                    themeMode = document.documentElement.getAttribute('data-theme-mode');
                } else {
                    themeMode = defaultThemeMode;
                }
    
                if (themeMode === 'system') {
                    themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
    
                document.documentElement.classList.add(themeMode);
            }
        </script>
        
        <div class="flex grow">
            @include('layouts.sidebar')
            
            <div class="wrapper flex grow flex-col">
                @include('layouts.header-product')
                <main class="grow content pt-5 bg-gray-100" id="content" role="content">
                    <div class="container-fixed" id="content_container"></div>
                    @yield('content')
                </main>
            </div>
        </div>
        
        @include('pages.products.partials.modal-create-product', ['route' => route('product.store')])
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{ asset('metronic/dist/assets/js/core.bundle.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/js/widgets/general.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/js/layouts/demo1.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script>
            toastr.options = {
              "closeButton": true,
              "escapeHtml": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "3000",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
  
            @if (session('success'))
                toastr.success("{{ session('success') }}",'Berhasil');
            @endif
  
            @if (session('error'))
                toastr.error("{{ session('error') }}", 'Gagal');
            @endif

            document.addEventListener('DOMContentLoaded', function() {
                $('.select2-apply').select2({
                    templateResult: formatOption,
                    templateSelection: formatSelection
                });

                function formatOption(option) {
                    if (!option.id) {
                        return option.text;
                    }

                    var imageUrl = $(option.element).data('image');

                    var $option = $(
                        `<span class="flex items-center gap-2">
                            <img src="${imageUrl}" class="w-6 h-6 rounded-full object-cover inline-block" />
                            ${option.text}
                        </span>`
                    );

                    return $option;
                }

                function formatSelection(option) {
                    return option.text;
                }

             
            });
        </script>

        <script>
            const textareas = document.querySelectorAll('.editor');
            let editors = [];
            textareas.forEach(textarea => {
                ClassicEditor
                    .create(textarea, {
                        rows: 10,
                        toolbar: [
                            'undo',
                            'redo',
                            'heading',
                            '|',
                            'bold',
                            'italic',
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
                        editors.push(editor);
                    })
                    .catch(error => {
                        console.error('Error during initialization of the editor', error);
                    });
            });
            console.log(editors);
        </script>

        <script>
            function formatDateTimeForInput(dateString) {
                var date = new Date(dateString);

                var day = ('0' + date.getDate()).slice(-2);
                var monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                var month = monthNames[date.getMonth()];
                var year = date.getFullYear();

                var hour = ('0' + date.getHours()).slice(-2);
                var minute = ('0' + date.getMinutes()).slice(-2);

                return `${day} ${month} ${year}, ${hour}:${minute}`;
            }

            function openEditModal(data) {
                console.log('Data:', data);

                $('#updateProductForm').attr('action', data.url_update);

                $('#current-icon').removeClass().addClass(data.icon);
                $('#icon').val(data.icon);

                var productIdElement = document.getElementById('id');
                var productNameElement = document.getElementById('name');
                var internalLabelElement = document.getElementById('internal_label');
                var eksternalLabelElement = document.getElementById('eksternal_label');
                var startDateElement = document.getElementById('start_date');
                var endDateElement = document.getElementById('end_date');
                var userSelectElement = document.getElementById('user_id');

                if (productIdElement && productNameElement && internalLabelElement && eksternalLabelElement && startDateElement && endDateElement && userSelectElement) {
                    productIdElement.value = '';
                    productNameElement.value = '';
                    internalLabelElement.checked = false;
                    eksternalLabelElement.checked = false;
                    startDateElement.value = '';
                    endDateElement.value = '';
                    userSelectElement.value = '';

                    productIdElement.value = data.id;
                    productNameElement.value = data.name || '';

                    if (data.label && data.label.toLowerCase() === 'internal') {
                        internalLabelElement.checked = true;
                    } else if (data.label && data.label.toLowerCase() === 'eksternal') {
                        eksternalLabelElement.checked = true;
                    }

                    if (data.start_date) {
                        startDateElement.value = formatDateTimeForInput(data.start_date);
                    }
                    if (data.end_date) {
                        endDateElement.value = formatDateTimeForInput(data.end_date);
                    }

                    $('#user_id').val(data.user_id).trigger('change');

                    showModal('modal_product');
                } else {
                    console.error('One or more elements are missing:', {
                        productIdElement,
                        productNameElement,
                        internalLabelElement,
                        eksternalLabelElement,
                        startDateElement,
                        endDateElement,
                        userSelectElement
                    });
                }
            }

            function closeEditModal() {
                hideModal('modal_product');
            }

            function showModal(modalId) {
                var modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('open');
                    modal.classList.remove('hidden');
                } else {
                    console.error('Modal with id ' + modalId + ' not found');
                }
            }

            function hideModal(modalId) {
                var modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('open');
                } else {
                    console.error('Modal with id ' + modalId + ' not found');
                }
            }

            document.querySelectorAll('[data-modal-dismiss]').forEach(function(btn) {
                btn.addEventListener('click', closeEditModal);
            });

            document.getElementById('updateProductForm').addEventListener('submit', function(e) {
                const iconInput = document.getElementById('icon');
                const currentIcon = document.getElementById('current-icon');

                if (!iconInput.value && currentIcon.className) {
                    iconInput.value = currentIcon.className;
                }

                console.log('Submitting form with icon:', iconInput.value);
            });
        </script>

        <script>
            function openDeleteModal(data) {
                $('#delete-form').attr('action', data.url_delete);
                
                console.log('Data:', data);
                console.log('Form action set to:', $('#delete-form').attr('action'));

               $('#delete_name').text(data.name);

                showModal('delete');
            }


            function closeDeleteModal() {
                hideModal('delete');
            }

            function showModal(modalId) {
                var modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('open');
                    modal.classList.remove('hidden');
                } else {
                    console.error('Modal with id ' + modalId + ' not found');
                }
            }

            function hideModal(modalId) {
                var modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('open');
                } else {
                    console.error('Modal with id ' + modalId + ' not found');
                }
            }

            document.querySelectorAll('[data-modal-dismiss]').forEach(function(btn) {
                btn.addEventListener('click', closeDeleteModal);
            });
        </script>
        
        @yield('blockfoot')
        @stack('blockfoot')
    </body>
</html>