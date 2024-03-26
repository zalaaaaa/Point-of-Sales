@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Form Level</h3>
        </div>
        <div class="card-body">
            <form action="../level" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" name="level_kode" id="level_kode" class="form-control" placeholder="Kode ...">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="level_nama" id="level_nama" class="form-control" placeholder="Nama ...">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
