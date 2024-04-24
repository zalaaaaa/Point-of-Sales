@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Level ID</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Level ID">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Level Kode</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Level Kode">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Level Nama</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Level Nama">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@stop
@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
