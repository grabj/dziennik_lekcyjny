@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Admin')
@section('content_header_title', 'Panel Administratora')
@section('content_header_subtitle', 'Uwaga!')

{{-- Content body: main page content --}}
@section('content')
    <div class="content row ">
        @yield('content')

        <section class="justify-content-center justify-content-end col col-md-8 text-center border p-3">
            <p>Czy na pewno chcesz usunąć użytkownika o ID {{$id}} z bazy użytkowników?</p>
            <form method="POST" action="">
                @csrf
                <input type="hidden" name="_method" value="delete">
                <button class="btn btn-danger m-1" type="submit">TAK</button>
            </form>
            <a href="{{url('admin/users/list')}}" class="btn btn-secondary m-1">NIE</a>
        </section>
    </div>
@stop