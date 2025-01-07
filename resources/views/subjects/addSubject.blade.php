@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Przedmioty')
@section('content_header_title', 'Przedmiot')
@section('content_header_subtitle', 'Dodaj')

{{-- Content body: main page content --}}

@section('content')
    <div class="content">
        @yield('content')
        <form action="addSubject" method="post">
            @csrf
            <div>
                <x-input-label for="name" :value="__('Nazwa')" />
                <x-adminlte-input id="name" class="" type="text" name="name" placeholder="Nazwa przedmiotu" required autofocus/>
            </div>
            <div>
                <x-input-label for="class_id" :value="__('Klasa')" />
                <x-adminlte-input id="class_id" class="" type="text" name="class_id" placeholder="Wybierz klasę..." autofocus/>
            </div>
            <div>
                <x-input-label for="lecturer_id" :value="__('Prowadzący')" />
                <x-adminlte-input id="lecturer_id" class="" type="text" name="lecturer_id" placeholder="Wybierz prowadzącego..." autofocus/>
            </div>
            <x-adminlte-button type="submit" value="submit" theme="info" label="Zaakceptuj"/>
        </form>
    </div>
@stop

