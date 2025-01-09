@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Admin')
@section('content_header_title', 'Panel Administratora')
@section('content_header_subtitle', 'Dodaj ocenę')

{{-- Content body: main page content --}}

@section('content')
    <div class="content">
        @yield('content')

        @if ($errors->any())
            <div class="alert alert-danger m-1">
                <p>Uzupełnij pola poprawiając następujące błędy:</p>
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        <div class="card col col-md-10 col-xl-8 container-fluid">
            <div class="card-header">
                <h3 class="card-title">Formularz dodawania</h3>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-default-dark m-3">
                    {{Session::get('message')}}
                </div>
            @endif

            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action="{{route('admin.grades.store')}}" >
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- student_id -->
                            <div>
                                <x-input-label for="student_id" :value="__('ID studenta')" />
                                <x-text-input id="student_id" class="block mt-1 w-full bg-white" type="text" name="student_id" :value="old('student_id')" required autofocus/>
                                <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                            </div>
                            <!-- lecturer_id -->
                            <div class="mt-4">
                                <x-input-label for="lecturer_id" :value="__('ID nauczyciela')" />
                                <x-text-input id="lecturer_id" class="block mt-1 w-full bg-white" type="text" name="lecturer_id" :value="old('lecturer_id')" required autofocus />
                                <x-input-error :messages="$errors->get('lecturer_id')" class="mt-2" />
                            </div>
                            <!-- Mark -->
                            <div class="mt-4">
                                <x-input-label for="mark" :value="__('Ocena')" />
                                <x-text-input id="mark" class="block mt-1 w-full bg-white" type="text" name="mark" :value="old('mark')" required autofocus />
                                <x-input-error :messages="$errors->get('mark')" class="mt-2" />
                            </div>
                            <!-- subject -->
                            <div class="mt-4">
                                <x-input-label for="subject" :value="__('Przedmiot')" />
                                <x-text-input id="subject" class="block mt-1 w-full bg-white" type="text" name="subject" :value="old('subject')" required autofocus />
                                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                            </div>
                            <!-- description -->
                            <div class="mt-4 mb-4">
                                    <x-input-label for="description" :value="__('Opis')" />
                                    <x-text-input id="description" class="block mt-1 w-full bg-white" type="text" name="description" :value="old('description')" required autofocus />
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <x-adminlte-button type="submit" value="submit" theme="info" label="Zaakceptuj" autofocus/>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
@stop

