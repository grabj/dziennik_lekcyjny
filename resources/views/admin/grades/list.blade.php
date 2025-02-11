@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Admin')
@section('content_header_title', 'Panel Administratora')
@section('content_header_subtitle', 'Wyświetl bazę ocen')

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
                                <a href="{{route('admin.grades.add')}}" class="btn btn-info"> Dodaj ocenę</a>
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
                                        <th>ID oceny</th>
                                        <th>Student (ID)</th>
                                        <th>Nauczyciel (ID)</th>
                                        <th>Ocena</th>
                                        <th>Przedmiot</th>
                                        <th>Szczegóły</th>
                                        <th>Data aktualizacji</th>
                                        <th>Data utworzenia</th>
                                        <th>Status ważności</th>
                                        <th class="col-1">Usuń</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getGrades as $value)
                                            <tr>
                                                <td>{{$value->id}}</td>
                                                <td>{{ $value->student_name }} {{ $value->student_surname }} ({{$value->student_id}})</td>
                                                <td>{{ $value->lecturer_name }} {{ $value->lecturer_surname }} ({{$value->lecturer_id}})</td>
                                                <td>{{$value->mark}}</td>
                                                <td>{{$value->subject}}</td>
                                                <td>{{$value->description}}</td>
                                                <td>{{$value->updated_at}}</td>
                                                <td>{{$value->created_at}}</td>
                                                <td>{{$value->is_valid === 1 ? "OK" : "X"}}</td>
                                                <td>
                                                    <a href="{{url('admin/grades/delete/'.$value->id)}}" class="btn btn-danger btn-sm"><i class='fas fa-solid fa-trash mb-0'></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-2 ">
                                    {!! $getGrades->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
