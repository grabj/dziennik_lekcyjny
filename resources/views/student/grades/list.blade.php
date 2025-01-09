@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Student')
@section('content_header_title', 'Oceny')
@section('content_header_subtitle', 'Wyświetl swoje oceny')

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
                                        <th>Przedmiot</th>
                                        <th>Nauczyciel</th>
                                        <th>Ocena</th>
                                        <th>Szczegóły</th>
                                        <th>Data aktualizacji</th>
                                        <th>Data utworzenia</th>
                                        <th>Status ważności</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getYourGrades as $value)
                                            <tr>
                                                <td>{{$value->subject}}</td>
                                                <td>{{ $value->lecturer_name }} {{ $value->lecturer_surname }}</td>
                                                <td>{{$value->mark}}</td>
                                                <td>{{$value->description}}</td>
                                                <td>{{$value->updated_at}}</td>
                                                <td>{{$value->created_at}}</td>
                                                <td>{{$value->is_valid === 1 ? "OK" : "X"}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-2 ">
                                    {!! $getYourGrades->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
