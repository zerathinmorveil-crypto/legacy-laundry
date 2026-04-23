@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0"></h1>
        <p class="mb-0 text-muted"></p>
    </div>
    <div>
        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-modern">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card modern-card">
                <div class="card-header border-0 text-center bg-light-primary">
                    <div class="avatar-wrapper mb-3">
                        <div class="avatar bg-warning">
                            <i class="fas fa-user-edit text-white"></i>
                        </div>
                    </div>
                    <h3>Edit Data User</h3>
                    <p class="text-muted">Perbarui informasi user</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="form-modern">
                        @csrf @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Role <span class="text-danger">*</span></label>
                                    <select name="role" class="form-control" required>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="kasir" {{ old('role', $user->role) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        Password Baru
                                        <small class="text-muted">(kosongkan jika tidak ingin ganti)</small>
                                    </label>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-modern">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-modern btn-lg">
                                <i class="fas fa-save mr-2"></i>Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
body {
    background: linear-gradient(135deg, #0f0f0f, #1c1c1c);
}

.container-fluid .col-lg-8 {
    max-width: 95%;
    flex: 0 0 95%;
}

@media (min-width: 1400px) {
    .container-fluid .col-lg-8 {
        max-width: 90%;
    }
}

.modern-card {
    border-radius: 20px;
    background: rgba(20, 20, 20, 0.6);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    box-shadow: 0 10px 40px rgba(0,0,0,0.6);
    border: 1px solid rgba(255,255,255,0.08);
}

.modern-card .card-header {
    padding: 3rem 2rem;
    text-align: center;
    background: rgba(40, 40, 40, 0.4);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255,255,255,0.08);
    color: #fff;
    position: relative;
}

.modern-card .card-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, rgba(255,255,255,0.15), rgba(255,255,255,0.02));
}

.modern-card .card-header > * {
    position: relative;
    z-index: 1;
}

.avatar-wrapper {
    display: flex;
    justify-content: center;
}

.avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    background: rgba(255,255,255,0.08);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 8px 25px rgba(0,0,0,0.6);
}

.card-header h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #fff;
}

.card-header p {
    color: rgba(255,255,255,0.7);
}

.form-modern .row {
    margin-left: -10px;
    margin-right: -10px;
}

.form-modern .col-md-6 {
    padding-left: 10px;
    padding-right: 10px;
}

.form-group { margin-bottom: 1.8rem; }

.form-label {
    color: rgba(255,255,255,0.75);
    font-size: 0.85rem;
}

.form-control {
    border-radius: 14px;
    padding: 16px 20px;
    font-size: 1.05rem;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: #fff;
    transition: 0.3s;
}

.form-control:hover { border-color: rgba(255,255,255,0.25); }

.form-control:focus {
    border-color: rgba(255,255,255,0.4);
    box-shadow: 0 0 0 2px rgba(255,255,255,0.1);
    background: rgba(255,255,255,0.08);
    color: #fff;
}

select.form-control {
    height: 56px;
    cursor: pointer;
}

select.form-control option {
    background: #1c1c1c;
    color: #fff;
}

.form-control.is-invalid { border-color: #ff6b6b; }
.invalid-feedback { font-size: 0.85rem; }

.btn-modern {
    border-radius: 12px;
    padding: 14px 30px;
    font-weight: 600;
    border: none;
    color: #fff;
    position: relative;
    overflow: hidden;
    transition: 0.3s;
}

.btn-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
    transition: left 0.5s;
}

.btn-modern:hover::before { left: 100%; }

.btn-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
}

/* Kembali di content_header (Cyan) */
.btn-secondary.btn-modern {
    background: #06b6d4;
}
.btn-secondary.btn-modern:hover {
    background: #0891b2;
}

/* Batal di form (Merah) */
.d-flex .btn-secondary.btn-modern {
    background: #ef4444;
}
.d-flex .btn-secondary.btn-modern:hover {
    background: #dc2626;
}

/* Update (Kuning) */
.btn-warning.btn-modern {
    background: #facc15;
    color: #000;
}
.btn-warning.btn-modern:hover {
    background: #eab308;
}

.bg-light-primary {
    background: transparent !important;
}
</style>
@stop