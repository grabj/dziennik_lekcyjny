<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dziennik lekcyjny') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    @extends('adminlte::page')

    {{-- Extend and customize the browser title --}}

    @section('title')
        {{ config('adminlte.title') }}
        @hasSection('subtitle') | @yield('subtitle') @endif
    @stop

    {{-- Extend and customize the page content header --}}

    @section('content_header')
        @hasSection('content_header_title')
            <h1 class="text-muted">
                @yield('content_header_title')
                @hasSection('content_header_subtitle')
                    <small class="text-dark">
                        <i class="fas fa-xs fa-angle-right text-muted"></i>
                        @yield('content_header_subtitle')
                    </small>
                @endif
            </h1>
        @endif
    @stop

    {{-- Setup Custom Preloader Content --}}

    @section('preloader')
        <i class="fas fa-3x fa-spin fa-hourglass text-secondary"></i>
    @stop

    {{-- Rename section content to content_body --}}

    @section('content')
        @yield('content_body')
    @stop

    {{-- Create a common footer --}}

    @section('footer')
        <div class="float-right">
            Version: {{ config('app.version', '1.0.0') }}
        </div>

        <a href="{{ config('app.company_url', '#') }}">
            {{ config('app.company_name', 'My school') }}
        </a>

    @stop

    {{-- Add common Javascript/Jquery code --}}

    @push('js')
        <script>

            $(document).ready(function() {
                // Add your common script logic here...
            });

        </script>
    @endpush

    {{-- Add common CSS customizations --}}

    @push('css')
        <style type="text/css">

            {{-- You can add AdminLTE customizations here --}}

    .small-box {
        font-weight: 500;
        color: #1b1e21;
    }

        </style>
    @endpush
{{--    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>--}}
</html>
