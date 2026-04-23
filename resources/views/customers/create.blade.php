@extends('adminlte::page')

@section('title', 'Tambah Customer')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0"></h1>
        <p class="mb-0 text-muted">I</p>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card modern-card">
                <div class="card-header border-0 text-center">
                    <div class="avatar-wrapper mb-3">
                        <div class="avatar bg-primary">
                            <i class="fas fa-user-plus text-white"></i>
                        </div>
                    </div>
                    <h3>Tambah Customer Baru</h3>
                    <p class="text-muted">Semua field wajib diisi</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="POST" class="form-modern">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                           value="{{ old('nama') }}" required autocomplete="name">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">No. HP <span class="text-danger">*</span></label>
                                    <input type="tel" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                                           value="{{ old('no_hp') }}" required autocomplete="tel">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                      rows="4" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-modern">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali                            
                            </a>
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-modern">
                                <i class="fas fa-arrow-left mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-modern btn-lg">
                                <i class="fas fa-save mr-2"></i>Simpan Customer
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<style>

/* BACKGROUND */
body {
    background: linear-gradient(135deg, #0f0f0f, #1c1c1c);
}

/* PERLEBAR FORM */
.container-fluid .col-lg-8 {
    max-width: 95%;
    flex: 0 0 95%;
}

@media (min-width: 1400px) {
    .container-fluid .col-lg-8 {
        max-width: 90%;
    }
}

/* CARD GLASS */
.modern-card {
    border-radius: 20px;
    background: rgba(20, 20, 20, 0.6);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    box-shadow: 0 10px 40px rgba(0,0,0,0.6);
    border: 1px solid rgba(255,255,255,0.08);
}

/* HEADER */
.modern-card .card-header {
    padding: 3rem 2rem;
    background: rgba(40, 40, 40, 0.4);
    backdrop-filter: blur(20px);
    color: #fff;
    text-align: center;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    position: relative;
}

/* EFEK KACA */
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

/* AVATAR */
.avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2rem;
    background: rgba(255,255,255,0.08);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.2);
}

/* TEXT */
.card-header h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: #fff;
}

.card-header p {
    color: rgba(255,255,255,0.7);
}

/* GRID */
.form-modern .row {
    margin-left: -10px;
    margin-right: -10px;
}

.form-modern .col-md-6 {
    padding-left: 10px;
    padding-right: 10px;
}

/* FORM */
.form-group {
    margin-bottom: 1.8rem;
}

.form-label {
    color: rgba(255,255,255,0.75);
    font-size: 0.85rem;
}

/* INPUT */
.form-control {
    border-radius: 14px;
    padding: 16px 20px;
    font-size: 1.05rem;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: #fff;
    transition: 0.3s;
}

/* HOVER */
.form-control:hover {
    border-color: rgba(255,255,255,0.25);
}

/* FOCUS */
.form-control:focus {
    border-color: rgba(255,255,255,0.4);
    box-shadow: 0 0 0 2px rgba(255,255,255,0.1);
}

/* SELECT */
select.form-control {
    height: 52px;
}

/* ERROR */
.form-control.is-invalid {
    border-color: #ff6b6b;
}

.invalid-feedback {
    font-size: 0.85rem;
}

/* BUTTON */
.btn-modern {
    border-radius: 12px;
    padding: 14px 32px;
    font-weight: 600;
    border: none;
    color: #fff;
    position: relative;
    overflow: hidden;
    transition: 0.3s;
}

/* SHIMMER */
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

.btn-modern:hover::before {
    left: 100%;
}

.btn-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
}

/* ===== WARNA TOMBOL ===== */

/* KEMBALI (CYAN) */
.btn-secondary.btn-modern:first-of-type {
    background: #06b6d4;
}
.btn-secondary.btn-modern:first-of-type:hover {
    background: #0891b2;
}

/* BATAL (MERAH) */
.btn-secondary.btn-modern:last-of-type {
    background: #ef4444;
}
.btn-secondary.btn-modern:last-of-type:hover {
    background: #dc2626;
}

/* SIMPAN (KUNING) */
.btn-primary.btn-modern {
    background: #facc15;
    color: #000;
}
.btn-primary.btn-modern:hover {
    background: #eab308;
}

</style>
@stop