@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Strona główna')
@section('content_header_title', 'Panel Administratora')
@section('content_header_subtitle', 'Widok główny')

{{-- Content body: main page content --}}

@section('content')
    <div class="content">
        @yield('content')

        <div class="container-fluid">
            <div class="row">
                <p>Wybierz stronę z menu...</p>
            </div>
        </div>
    </div>
@stop
{{--@overwrite--}}

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{--    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Strona główna') }}
        </h2>
    </x-slot>


<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Zalogowano się pomyślnie.") }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>--}}
