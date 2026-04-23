@extends('adminlte::page')

@section('title', 'Tambah Transaksi')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0"></h1>
        <p class="mb-0 text-muted"></p>
    </div>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-modern">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card modern-card">
                <div class="card-header border-0 text-center bg-light-primary">
                    <div class="avatar-wrapper mb-3">
                        <div class="avatar bg-success">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                    </div>
                    <h3>Tambah Transaksi Baru</h3>
                    <p class="text-muted mb-0">Laundry Premium Service</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('transactions.store') }}" method="POST" class="form-modern">
                        @csrf
                        
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <h6><i class="fas fa-exclamation-circle mr-2"></i>Periksa Input:</h6>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Customer <span class="text-danger">*</span></label>
                                    <select name="customer_id" class="form-control @error('customer_id') is-invalid @enderror" required>
                                        <option value="">Pilih Customer</option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->nama }} - {{ $customer->no_hp }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Service <span class="text-danger">*</span></label>
                                    <select name="service_id" class="form-control @error('service_id') is-invalid @enderror" required>
                                        <option value="">Pilih Service</option>
                                        @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->nama_service }} (Rp {{ number_format($service->harga_per_kg, 0, ',', '.') }}/kg)
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('service_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Berat (kg) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.1" name="berat" class="form-control @error('berat') is-invalid @enderror" 
                                           value="{{ old('berat') }}" min="0.1" required>
                                    @error('berat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                                           value="{{ old('tanggal_masuk') }}" required>
                                    @error('tanggal_masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Ambil</label>
                                    <input type="date" name="tanggal_ambil" class="form-control @error('tanggal_ambil') is-invalid @enderror" 
                                           value="{{ old('tanggal_ambil') }}">
                                    @error('tanggal_ambil')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Status Transaksi <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="baru" {{ old('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                                        <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Status Bayar <span class="text-danger">*</span></label>
                                    <select name="status_bayar" class="form-control @error('status_bayar') is-invalid @enderror" required>
                                        <option value="lunas" {{ old('status_bayar') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                        <option value="belum" {{ old('status_bayar') == 'belum' ? 'selected' : '' }}>Belum Lunas</option>
                                    </select>
                                    @error('status_bayar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Jenis Pembayaran</label>
                                    <select name="jenis_pembayaran" class="form-control @error('jenis_pembayaran') is-invalid @enderror">
                                        <option value="">Pilih Jenis</option>
                                        <option value="tunai" {{ old('jenis_pembayaran') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                        <option value="transfer" {{ old('jenis_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                        <option value="debit" {{ old('jenis_pembayaran') == 'debit' ? 'selected' : '' }}>Debit</option>
                                        <option value="kredit" {{ old('jenis_pembayaran') == 'kredit' ? 'selected' : '' }}>Kredit</option>
                                    </select>
                                    @error('jenis_pembayaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between pt-4">
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-modern">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-modern btn-lg">
                                <i class="fas fa-save mr-2"></i>Simpan Transaksi
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

/* ====== PERLEBAR FORM ====== */
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
    overflow: hidden;
    margin-bottom: 2rem;
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

/* ICON */
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
    font-size: 2.2rem;
    background: rgba(255,255,255,0.08);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 8px 25px rgba(0,0,0,0.6);
}

/* TEXT */
.card-header h3 {
    font-size: 1.8rem;
    font-weight: 700;
}

.card-header p {
    color: rgba(255,255,255,0.7);
}

/* FORM GRID */
.form-modern .row {
    margin-left: -10px;
    margin-right: -10px;
}

.form-modern .col-md-6,
.form-modern .col-md-4,
.form-modern .col-md-3 {
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
    font-weight: 500;
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

.form-control:hover {
    border-color: rgba(255,255,255,0.25);
}

.form-control:focus {
    border-color: rgba(255,255,255,0.4);
    box-shadow: 0 0 0 2px rgba(255,255,255,0.1);
}

/* SELECT FIX */
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

/* ====== WARNA TOMBOL ====== */

/* KEMBALI */
.btn-kembali {
    background: #06b6d4;
}
.btn-kembali:hover {
    background: #0891b2;
}

/* SIMPAN */
.btn-simpan {
    background: #facc15;
    color: #000;
}
.btn-simpan:hover {
    background: #eab308;
}

/* BATAL */
.btn-batal {
    background: #ef4444;
}
.btn-batal:hover {
    background: #dc2626;
}

/* FIX BG */
.bg-light-primary {
    background: transparent !important;
}

</style>
@stop