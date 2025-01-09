@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Lecturer')
@section('content_header_title', 'Oceny')
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
                <form method="post" action="{{route('lecturer.grades.store')}}" >
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- student_id -->
                            <div>
                                <label for="student_id">Wybór studenta</label>
                                <select id="student_id" name="student_id" class="block mt-1 w-full bg-white" required autofocus>
                                    <option value="" disabled selected>Wybierz...</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">[{{ $student->id }}] {{ $student->name }} {{ $student->surname }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                            </div>
                            <!-- lecturer_id -->
                            <input type="hidden" name="lecturer_id" id="lecturer_id" value="{{ $lecturer_id }}">
                            <!-- Mark -->
                            <div class="mt-4 form-group">
                                <label for="mark">Ocena</label>
                                <select class="form-control block" id="mark" name="mark" required autofocus>
                                    <option value="" disabled selected>Wybierz...</option>
                                    <option>2.0</option>
                                    <option>3.0</option>
                                    <option>3.5</option>
                                    <option>4.0</option>
                                    <option>4.5</option>
                                    <option>5.0</option>
                                </select>
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
                                    <x-text-input id="description" class="block mt-1 w-full bg-white" type="text" name="description" :value="old('description')" autofocus />
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

