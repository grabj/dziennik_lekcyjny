@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Admin')
@section('content_header_title', 'Panel Administratora')
@section('content_header_subtitle', 'Zarządzaj bazą użytkowników')

{{-- Content body: main page content --}}

@section('content')
    <div class="content">

        @yield('content')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-right">
                                <a href="{{route('admin.users.add')}}" class="btn btn-info"> Dodaj użytkowanika</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="users_list" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Imię</th>
                                        <th>Nazwisko</th>
                                        <th>Email</th>
                                        <th>Rola</th>
                                        <th>Data utworzenia</th>
                                        <th>Data aktualizacji</th>
                                        <th>Akcje</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getUsers as $value)
                                            <tr>
                                                <td>{{$value->id}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>{{$value->surname}}</td>
                                                <td>{{$value->email}}</td>
                                                <td>{{$value->role}}</td>
                                                <td>{{$value->created_at}}</td>
                                                <td>{{$value->updated_at}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush
