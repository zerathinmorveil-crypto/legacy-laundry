@extends('adminlte::page')

@section('title', 'Tambah Member')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0"></h1>
        <p class="mb-0 text-muted"></p>
    </div>
    <a href="{{ route('members.index') }}" class="btn btn-secondary btn-modern">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card modern-card">
                <div class="card-header border-0 text-center">
                    <div class="avatar-wrapper mb-3">
                        <div class="avatar bg-primary">
                            <i class="fas fa-star text-white"></i>
                        </div>
                    </div>
                    <h3>Tambah Member Baru</h3>
                    <p class="text-muted">Auto-fill dari customer atau manual</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('members.store') }}" method="POST" class="form-modern" id="memberForm">
                        @csrf
                        
                        {{-- DROPDOWN CUSTOMER --}}
                        <div class="form-group mb-4">
                            <label class="form-label">Pilih Customer (Opsional)</label>
                            <select name="customer_id" id="customerSelect" class="form-control">
                                <option value="">-- Pilih Customer --</option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" 
                                        data-nama="{{ $customer->nama }}"
                                        data-hp="{{ $customer->no_hp }}"
                                        data-email="{{ $customer->email }}"
                                        data-alamat="{{ $customer->alamat }}">
                                    {{ $customer->nama }} - {{ $customer->no_hp }}
                                </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih customer untuk auto-fill data</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Member <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_member" id="nama_member" class="form-control @error('nama_member') is-invalid @enderror" 
                                           value="{{ old('nama_member') }}" required>
                                    @error('nama_member')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">No. HP <span class="text-danger">*</span></label>
                                    <input type="tel" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                                           value="{{ old('no_hp') }}" required>
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
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Jenis Member <span class="text-danger">*</span></label>
                                    <select name="jenis_member" id="jenis_member" class="form-control" required>
                                        <option value="">Pilih Jenis</option>
                                        <option value="reguler" {{ old('jenis_member') == 'reguler' ? 'selected' : '' }}>Reguler (0-5%)</option>
                                        <option value="silver" {{ old('jenis_member') == 'silver' ? 'selected' : '' }}>Silver (10%)</option>
                                        <option value="gold" {{ old('jenis_member') == 'gold' ? 'selected' : '' }}>Gold (15-20%)</option>
                                        <option value="platinum" {{ old('jenis_member') == 'platinum' ? 'selected' : '' }}>Platinum (25-30%)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Diskon (%) <span class="text-danger">*</span></label>
                                    <input type="number" name="diskon" id="diskon" class="form-control @error('diskon') is-invalid @enderror" 
                                           value="{{ old('diskon', 0) }}" min="0" max="50" required>
                                    @error('diskon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="4" required>
                                {{ old('alamat') }}
                            </textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('members.index') }}" class="btn btn-secondary btn-modern">
                                <i class="fas fa-arrow-left mr-2"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-modern btn-lg">
                                <i class="fas fa-save mr-2"></i>Simpan Member
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
.container-fluid .col-lg-10 {
    max-width: 95%;
    flex: 0 0 95%;
}

@media (min-width: 1400px) {
    .container-fluid .col-lg-10 {
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
    background: linear-gradient(
        120deg,
        rgba(255,255,255,0.15),
        rgba(255,255,255,0.02)
    );
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

/* BUTTON BASE */
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
.btn-secondary.btn-modern {
    background: #06b6d4;
}
.btn-secondary.btn-modern:hover {
    background: #0891b2;
}

/* SIMPAN */
.btn-primary.btn-modern {
    background: #facc15;
    color: #000;
}
.btn-primary.btn-modern:hover {
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

@section('js')
<script>
$(document).ready(function() {
    // Auto-fill saat pilih customer
    $('#customerSelect').on('change', function() {
        const selectedOption = $(this).find('option:selected');
        const customerId = $(this).val();
        
        if (customerId) {
            // Ambil data dari data attribute (cepat)
            $('#nama_member').val(selectedOption.data('nama'));
            $('#no_hp').val(selectedOption.data('hp'));
            $('#email').val(selectedOption.data('email'));
            $('#alamat').val(selectedOption.data('alamat'));
            
            // Effect sukses
            $('.form-control').addClass('is-valid');
            toastr.success('Data customer berhasil dimuat!', 'Auto-fill');
        } else {
            // Clear jika tidak ada pilihan
            $('.form-control').removeClass('is-valid').val('');
        }
    });

    // Auto set diskon berdasarkan jenis member
    $('#jenis_member').on('change', function() {
        const diskonMap = {
            'reguler': 5,
            'silver': 10,
            'gold': 15,
            'platinum': 25
        };
        const jenis = $(this).val();
        if (jenis && diskonMap[jenis]) {
            $('#diskon').val(diskonMap[jenis]);
        }
    });
});
</script>
@stop