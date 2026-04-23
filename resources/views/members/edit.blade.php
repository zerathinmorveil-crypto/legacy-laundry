@extends('adminlte::page')

@section('title', 'Edit Member')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0"></h1>
        <p class="mb-0 text-muted"></p>
    </div>
    <div>
        <a href="{{ route('members.show', $member) }}" class="btn btn-info btn-modern mr-2">
            <i class="fas fa-eye mr-2"></i>Lihat
        </a>
        <a href="{{ route('members.index') }}" class="btn btn-secondary btn-modern">
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
                            <i class="fas fa-edit text-white"></i>
                        </div>
                    </div>
                    <h3>Edit Member Premium</h3>
                    <p class="text-muted mb-0">Kode: <strong>{{ $member->kode_member }}</strong></p>
                </div>
                <div class="card-body">
                    <form action="{{ route('members.update', $member) }}" method="POST" class="form-modern">
                        @csrf @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Member <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_member" class="form-control @error('nama_member') is-invalid @enderror" 
                                           value="{{ old('nama_member', $member->nama_member) }}" required>
                                    @error('nama_member')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">No. HP <span class="text-danger">*</span></label>
                                    <input type="tel" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                                           value="{{ old('no_hp', $member->no_hp) }}" required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $member->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jenis Member <span class="text-danger">*</span></label>
                                    <select name="jenis_member" class="form-control" required>
                                        <option value="reguler" {{ old('jenis_member', $member->jenis_member) == 'reguler' ? 'selected' : '' }}>Reguler</option>
                                        <option value="silver" {{ old('jenis_member', $member->jenis_member) == 'silver' ? 'selected' : '' }}>Silver</option>
                                        <option value="gold" {{ old('jenis_member', $member->jenis_member) == 'gold' ? 'selected' : '' }}>Gold</option>
                                        <option value="platinum" {{ old('jenis_member', $member->jenis_member) == 'platinum' ? 'selected' : '' }}>Platinum</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Diskon (%) <span class="text-danger">*</span></label>
                                    <input type="number" name="diskon" class="form-control @error('diskon') is-invalid @enderror" 
                                           value="{{ old('diskon', $member->diskon) }}" min="0" max="50" required>
                                    @error('diskon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="aktif" {{ old('status', $member->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status', $member->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="4" required>
                                {{ old('alamat', $member->alamat) }}
                            </textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('members.index') }}" class="btn btn-secondary btn-modern">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-modern btn-lg">
                                <i class="fas fa-save mr-2"></i>Update Member
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

/* BACKGROUND PAGE */
body {
    background: linear-gradient(135deg, #0f0f0f, #1c1c1c);
}

/* CARD GLASS */
.modern-card {
    border-radius: 20px;
    background: rgba(20, 20, 20, 0.65);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 0 15px 50px rgba(0,0,0,0.7);
    border: 1px solid rgba(255,255,255,0.08);
    overflow: hidden;
}

/* HEADER */
.modern-card .card-header {
    padding: 2.2rem;
    text-align: center;
    background: rgba(40, 40, 40, 0.35);
    backdrop-filter: blur(25px);
    border-bottom: 1px solid rgba(255,255,255,0.08);
    color: #fff;
}

/* ICON CENTER */
.avatar-wrapper {
    display: flex;
    justify-content: center;
}

.avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    background: rgba(255,255,255,0.08);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
}

/* TEXT */
.card-header h3 {
    font-size: 1.7rem;
    font-weight: 700;
}

.card-header p {
    color: rgba(255,255,255,0.7);
}

/* LABEL */
.form-label {
    color: rgba(255,255,255,0.75);
    font-size: 0.85rem;
    font-weight: 500;
}

/* INPUT GLASS */
.form-control {
    border-radius: 12px;
    padding: 14px 18px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: #fff;
    transition: all 0.3s ease;
}

/* HOVER INPUT */
.form-control:hover {
    border-color: rgba(255,255,255,0.25);
}

/* FOCUS INPUT */
.form-control:focus {
    border-color: rgba(255,255,255,0.45);
    box-shadow: 0 0 0 2px rgba(255,255,255,0.1);
    background: rgba(255,255,255,0.07);
}

/* ERROR */
.form-control.is-invalid {
    border-color: #ff6b6b;
}

/* BUTTON BASE */
.btn-modern {
    border-radius: 12px;
    padding: 12px 26px;
    font-weight: 600;
    border: 1px solid rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.08);
    color: #fff;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

/* HOVER BUTTON */
.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.6);
}

/* === VARIASI WARNA (SESUAI REQUEST) === */

/* CYAN - KEMBALI */
.btn-info.btn-modern {
    background: rgba(0, 255, 255, 0.15);
    border: 1px solid rgba(0, 255, 255, 0.4);
}

/* KUNING - SIMPAN / UPDATE */
.btn-warning.btn-modern {
    background: rgba(255, 193, 7, 0.2);
    border: 1px solid rgba(255, 193, 7, 0.5);
}

/* MERAH - BATAL */
.btn-danger.btn-modern {
    background: rgba(255, 77, 77, 0.18);
    border: 1px solid rgba(255, 77, 77, 0.45);
}

/* DEFAULT SECONDARY */
.btn-secondary.btn-modern {
    background: rgba(255,255,255,0.05);
}

/* FIX BACKGROUND */
.bg-light-primary {
    background: transparent !important;
}

</style>
@stop