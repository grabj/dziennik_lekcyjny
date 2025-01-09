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
                            @if(Session::has('message'))
                                <div class="alert alert-default-dark m-3">
                                    {{Session::get('message')}}
                                </div>
                            @endif
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="users_list" class="table table-striped table-bordered table-sm table-light ">
                                    <thead class="bg-secondary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Imię</th>
                                        <th>Nazwisko</th>
                                        <th>Email</th>
                                        <th>Rola</th>
                                        <th>Data utworzenia</th>
                                        <th>Data aktualizacji</th>
                                        <th class="col-1">Akcje</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getUsers as $value)
                                            <tr>
                                                <td>{{$value->id}}</td>
                                                <td>{{$value->name}}</td>
                                                <td>{{$value->surname}}</td>
                                                <td>{{$value->email}}</td>
                                                <td>
                                                    {{$value->role === "0" ? "Admin" : "" }}
                                                    {{$value->role === "1" ? "Lecturer" : "" }}
                                                    {{$value->role === "2" ? "Student" : "" }}
                                                </td>
                                                <td>{{$value->created_at}}</td>
                                                <td>{{$value->updated_at}}</td>
                                                <td>
                                                    <a href="{{url('admin/users/edit/'.$value->id)}}" class="btn btn-info btn-sm"><i class='fas fa-solid fa-marker mb-0'></i></a>
                                                    <a href="{{url('admin/users/delete/'.$value->id)}}" class="btn btn-danger btn-sm"><i class='fas fa-solid fa-trash mb-0'></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-2 ">
                                    {!! $getUsers->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
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
