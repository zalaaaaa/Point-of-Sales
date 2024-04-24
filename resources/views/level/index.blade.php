@extends('layout.app')

{{-- Customize layout section --}}

@section('subtitle', 'Level')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Level')

{{-- Customize body:main page content --}}

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Level</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
            <a href={{ route('/level/create') }} class="btn btn-primary">Tambah</a>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
