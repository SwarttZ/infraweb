@extends('backend.layout.master')

@section('title', 'dashboard')

@push('styles')
<link href="{{ asset('backend/css/buttons.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container-buttons">
    <a class="btn btn-app bg-secondary" href="{{ route('admin.create.server') }}">
        <span class="badge bg-success">{{ $servers }}</span>
        <i class="fas fa-server"></i> servidores
    </a>
    <a class="btn btn-app bg-success" href="{{ route('admin.create.user') }}">
        <span class="badge bg-purple">{{ $user }}</span>
        <i class="fas fa-users"></i> Usuários
    </a>

    <a class="btn btn-app bg-warning">
        <span class="badge bg-info">12</span>
        <i class="fas fa-envelope"></i> Inbox
    </a>
</div>
@include('backend.layout.partials.content')

@endsection
