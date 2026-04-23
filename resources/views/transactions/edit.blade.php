@extends('adminlte::page')

@section('title', 'Edit Transaksi')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0"></h1>
        <p class="mb-0 text-muted">{{ $transaction->kode_transaksi }}</p>
    </div>
    <div>
        <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-info btn-modern mr-2">
            <i class="fas fa-eye mr-2"></i>Lihat
        </a>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-modern">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card modern-card">
                <div class="card-header border-0 text-center bg-light-warning">
                    <div class="avatar-wrapper mb-3">
                        <div class="avatar bg-warning">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                    </div>
                    <h3>Edit Transaksi</h3>
                    <p class="text-muted mb-0">Kode: <strong>{{ $transaction->kode_transaksi }}</strong></p>
                </div>
                <div class="card-body">
                    <form action="{{ route('transactions.update', $transaction) }}" method="POST" class="form-modern">
                        @csrf @method('PUT')
                        
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
                                        <option value="{{ $customer->id }}" {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
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
                                        <option value="{{ $service->id }}" {{ old('service_id', $transaction->service_id) == $service->id ? 'selected' : '' }}>
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
                                           value="{{ old('berat', $transaction->berat) }}" min="0.1" required>
                                    @error('berat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                                           value="{{ old('tanggal_masuk', $transaction->tanggal_masuk) }}" required>
                                    @error('tanggal_masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Ambil</label>
                                    <input type="date" name="tanggal_ambil" class="form-control @error('tanggal_ambil') is-invalid @enderror" 
                                           value="{{ old('tanggal_ambil', $transaction->tanggal_ambil) }}">
                                    @error('tanggal_ambil')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Diskon (%)</label>
                                    <input type="number" name="diskon" class="form-control @error('diskon') is-invalid @enderror" 
                                           value="{{ old('diskon', $transaction->diskon) }}" min="0" max="100" step="0.1">
                                    @error('diskon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Status Transaksi <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="baru" {{ old('status', $transaction->status) == 'baru' ? 'selected' : '' }}>Baru</option>
                                        <option value="proses" {{ old('status', $transaction->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ old('status', $transaction->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
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
                                        <option value="lunas" {{ old('status_bayar', $transaction->status_bayar) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                        <option value="belum" {{ old('status_bayar', $transaction->status_bayar) == 'belum' ? 'selected' : '' }}>Belum Lunas</option>
                                    </select>
                                    @error('status_bayar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jenis Pembayaran</label>
                                    <select name="jenis_pembayaran" class="form-control @error('jenis_pembayaran') is-invalid @enderror">
                                        <option value="">Pilih Jenis</option>
                                        <option value="tunai" {{ old('jenis_pembayaran', $transaction->jenis_pembayaran) == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                        <option value="transfer" {{ old('jenis_pembayaran', $transaction->jenis_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                        <option value="debit" {{ old('jenis_pembayaran', $transaction->jenis_pembayaran) == 'debit' ? 'selected' : '' }}>Debit</option>
                                        <option value="kredit" {{ old('jenis_pembayaran', $transaction->jenis_pembayaran) == 'kredit' ? 'selected' : '' }}>Kredit</option>
                                    </select>
                                    @error('jenis_pembayaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row bg-light p-3 rounded mb-4">
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5 class="text-muted mb-1">Sub Total</h5>
                                    <h4 class="text-primary font-weight-bold">Rp {{ number_format($transaction->sub_total, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5 class="text-muted mb-1">Diskon</h5>
                                    <h4 class="text-warning font-weight-bold">{{ $transaction->diskon }}%</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <h5 class="text-muted mb-1">Total</h5>
                                    <h4 class="text-success font-weight-bold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-modern">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-warning btn-modern btn-lg">
                                <i class="fas fa-save mr-2"></i>Update Transaksi
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
.modern-card {
    border: none;
    border-radius: 20px;
    background: rgba(20, 20, 20, 0.6);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    overflow: hidden;
    margin-bottom: 2rem;
    border: 1px solid rgba(255,255,255,0.08);
}

/* HEADER GLASS */
.modern-card .card-header {
    padding: 2.5rem 2rem;
    background: rgba(40, 40, 40, 0.4);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    color: #ffffff;
    position: relative;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    text-align: center;
}

/* EFEK KACA */
.modern-card .card-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        120deg,
        rgba(255,255,255,0.15),
        rgba(255,255,255,0.02)
    );
    pointer-events: none;
}

/* AVATAR */
.avatar { width: 80px; 
    height: 80px; 
    border-radius: 50%; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    font-size: 2rem; 
    box-shadow: 0 8px 25px rgba(0,0,0,0.2); 
    transition: all 0.3s ease; 
    margin: 0 auto;
}

.avatar-wrapper {
    display: flex;
    justify-content: center;
    margin-bottom: 1rem;
}

/* TEXT */
.card-header h3 {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

/* FORM */
.form-label {
    font-weight: 600;
    color: rgba(255,255,255,0.8);
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control {
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 12px;
    padding: 14px 20px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: rgba(255,255,255,0.05);
    color: #fff;
    height: auto;
}

/* FOCUS */
.form-control:focus {
    border-color: rgba(255,255,255,0.4);
    box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.1);
    transform: translateY(-2px);
}

/* BUTTON */
.btn-modern {
    border-radius: 12px;
    padding: 12px 30px;
    font-weight: 600;
    border: 1px solid rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.08);
    color: #fff;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

/* HOVER BUTTON */
.btn-modern:hover {
    background: rgba(255,255,255,0.15);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
}

/* BACKGROUND OPTIONAL */
body {
    background: linear-gradient(135deg, #0f0f0f, #1c1c1c);
}

/* OPTIONAL SECTION BG */
.bg-light-warning {
    background: rgba(255,255,255,0.03) !important;
    backdrop-filter: blur(10px);
}
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
@if(session('success'))
    toastr.success('{{ session('success') }}');
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
    @endforeach
@endif
</script>
@stop   