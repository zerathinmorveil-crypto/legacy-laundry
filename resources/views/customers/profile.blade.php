@extends('layouts.customer')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-circle mr-2"></i>Profil Saya</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-circle fa-5x text-muted"></i>
                        <h5 class="mt-2 mb-0">{{ $user->name }}</h5>
                        <small class="text-muted">Customer</small>
                    </div>
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><i class="fas fa-user mr-2 text-muted"></i>Nama</td>
                            <td>: <strong>{{ $user->name }}</strong></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-envelope mr-2 text-muted"></i>Email</td>
                            <td>: {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-calendar mr-2 text-muted"></i>Bergabung</td>
                            <td>: {{ $user->created_at->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit mr-1"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop