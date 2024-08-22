<!doctype html>
<html class="h-full" data-theme="true" data-theme-mode="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name', 'App') }} - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('metronic/dist/assets/media/app/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180"/>
        <link href="{{ asset('metronic/dist/assets/media/app/favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png"/>
        <link href="{{ asset('metronic/dist/assets/media/app/favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png"/>
        <link href="{{ asset('metronic/dist/assets/media/app/favicon.ico') }}" rel="shortcut icon"/>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
        <link href="{{ asset('metronic/dist/assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet"/>
        <link href="{{ asset('metronic/dist/assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet"/>
        <link href="{{ asset('metronic/dist/assets/css/styles.css') }}" rel="stylesheet"/>
        <link href="{{ asset('assets/css/global.css') }}" rel="stylesheet"/>
        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
        @yield('blockhead')
    </head>
    <body class="flex h-full demo1 sidebar-fixed header-fixed bg-[#fefefe] dark:bg-coal-500">
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
                @include('layouts.header')
                <main class="grow content pt-5" id="content" role="content">
                    <div class="container-fixed" id="content_container"></div>
                    @yield('content')
                </main>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="{{ asset('metronic/dist/assets/js/core.bundle.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/js/widgets/general.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/js/layouts/demo1.js') }}"></script>


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
          </script>
          @yield('blockfoot')
          <style>
            .toast-success .toast-message,
            .toast-error .toast-message {
                margin-left: 0.75rem; 
            }

            .toast-success .toast-title,
            .toast-error .toast-title {
                margin-left: 0.75rem; 
            }
        </style>
    </body>
</html>