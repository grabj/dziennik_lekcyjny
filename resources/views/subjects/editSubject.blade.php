@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Przedmioty')
@section('content_header_title', 'Przedmiot')
@section('content_header_subtitle', 'Edytuj')

{{-- Content body: main page content --}}

@section('content')
    <div class="content">
        @yield('content')
        <h3>Edytowanie przedmiotu</h3>
        <form action="editSubject" method="post">
            @csrf
            <div>
                <x-input-label for="name" :value="__('Nazwa')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $subject->name)" required autofocus/>
            </div>
            <div>
                <x-input-label for="class_id" :value="__('Klasa')" />
                <x-text-input id="class_id" class="block mt-1 w-full" type="text" name="class_id" :value="old('class_id', $subject->class_id)" required autofocus/>
            </div>
            <div>
                <x-input-label for="lecturer_id" :value="__('Prowadzący')" />
                <x-text-input id="lecturer_id" class="block mt-1 w-full" type="text" name="lecturer_id" :value="old('lecturer_id', $subject->lecturer_id)"autofocus/>
            </div>
            <input type="submit" value="Dodaj przedmiot">
        </form>
    </div>
@stop
