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
        <link href="{{ asset('metronic/dist/assets/media/app/mini-logo.svg') }}" rel="shortcut icon" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
        <link href="{{ asset('metronic/dist/assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet"/>
        <link href="{{ asset('metronic/dist/assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet"/>
        <link href="{{ asset('metronic/dist/assets/css/styles.css') }}" rel="stylesheet"/>
        @yield('blockhead')

        <style>
            .spinner {
                border: 4px solid #f3f3f3;
                border-top: 4px solid #3498db;
                border-radius: 50%;
                width: 20px;
                height: 20px;
                animation: spin 1s linear infinite;
                /* display: inline-block; */
                vertical-align: middle;
            }
    
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
    
        </style>
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
        <style>
            .branded-bg { background-image: url('{{ asset("metronic/dist/assets/media/images/2600x1600/Right.png") }}'); 
                background-size: cover;
                background-position: center;
             }
            .dark .branded-bg { background-image: url('{{ asset("metronic/dist/assets/media/images/2600x1600/1-dark.png") }}'); }
        </style>
        
        <div class="grid lg:grid-cols-2 grow">
            <div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1">
                <div class="card max-w-[370px] w-full">
                    @yield('content')
                </div>
            </div>

            <div class=" order-1 lg:order-2 bg-top xxl:bg-center xl:bg-cover bg-no-repeat branded-bg">
                <div class="flex flex-col p-8 lg:p-16 gap-4">
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('metronic/dist/assets/js/core.bundle.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/js/widgets/general.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/js/layouts/demo1.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        @stack('blockfoot')
    </body>
</html>