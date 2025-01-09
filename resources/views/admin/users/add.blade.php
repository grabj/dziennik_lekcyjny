@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Admin')
@section('content_header_title', 'Panel Administratora')
@section('content_header_subtitle', 'Dodaj użytkownika')

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
                <form method="post" action="{{route('admin.users.store')}}" >
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full bg-white" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <!-- name -->
                            <div class="mt-4">
                                <x-input-label for="name" :value="__('Imię')" />
                                <x-text-input id="name" class="block mt-1 w-full bg-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <!-- Surname -->
                            <div class="mt-4">
                                <x-input-label for="surname" :value="__('Nazwisko')" />
                                <x-text-input id="surname" class="block mt-1 w-full bg-white" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname" />
                                <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                            </div>
                            <!-- Role -->
                            <div class="mt-4 form-group">
                                <label for="role">Rola</label>
                                <select class="form-control block" id="role" name="role" required autofocus>
                                    <option value="2">Student</option>
                                    <option value="1">Lecturer</option>
                                    <option value="0">Admin</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
                            <!-- Password -->
                            <div class="mt-4 mb-4">
                                <x-input-label for="password" :value="__('Hasło')" />
                                <x-text-input id="password" class="block mt-1 w-full bg-white"
                                              type="password"
                                              name="password"
                                              required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
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

