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
        <style>
            .branded-bg { background-image: url('{{ asset("metronic/dist/assets/media/images/2600x1600/1.png") }}'); }
            .dark .branded-bg { background-image: url('{{ asset("metronic/dist/assets/media/images/2600x1600/1-dark.png") }}'); }
        </style>
        
        <div class="grid lg:grid-cols-2 grow">
            <div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1">
                <div class="card max-w-[370px] w-full">
                    @yield('content')
                </div>
            </div>

            <div class="lg:rounded-xl lg:border lg:border-gray-200 lg:m-5 order-1 lg:order-2 bg-top xxl:bg-center xl:bg-cover bg-no-repeat branded-bg">
                <div class="flex flex-col p-8 lg:p-16 gap-4">
                    <a href="html/demo1.html">
                        <img class="h-[28px] max-w-none" src="{{ asset("metronic/dist/assets/media/app/mini-logo.svg") }}"/>
                    </a>
                    <div class="flex flex-col gap-3">
                        <h3 class="text-2xl font-semibold text-gray-900">
                            Secure Access Portal
                        </h3>
                        <div class="text-base font-medium text-gray-600">
                            Lorem ipsum dolor sit amet consectetur<br /> adipisicing elit reprenderit.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('metronic/dist/assets/js/core.bundle.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/js/widgets/general.js') }}"></script>
        <script src="{{ asset('metronic/dist/assets/js/layouts/demo1.js') }}"></script>
    </body>
</html>