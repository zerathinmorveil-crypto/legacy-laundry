@extends('adminlte::page')

@section('title', 'Detail Transaksi')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0"></h1>
        <p class="mb-0 text-muted">{{ $transaction->kode_transaksi }}</p>
    </div>
    <div>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary mr-2">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
        <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-primary">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    {{-- PROFILE CARD --}}
    <div class="row">
        <div class="col-12">
            <div class="card modern-card card-profile">
                <div class="card-body text-center p-5">
                    <div class="avatar-wrapper mb-4">
                        <div class="avatar {{ $transaction->status_color }}">
                            <i class="fas fa-receipt text-white"></i>
                        </div>
                    </div>
                    <h2 class="mb-2">{{ $transaction->kode_transaksi }}</h2>
                    <div class="mb-4">
                        <span class="badge badge-modern badge-primary">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h3 class="text-primary">
                                    {{ $transaction->customer->nama ?? '-' }}
                                </h3>
                                <p class="text-muted mb-0">Customer</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h3 class="text-info">{{ $transaction->service->nama_service ?? '-' }}</h3>
                                <p class="text-muted mb-0">Service</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h3 class="text-warning">{{ $transaction->berat }} kg</h3>
                                <p class="text-muted mb-0">Berat</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h3 class="{{ $transaction->status_bayar == 'lunas' ? 'text-success' : 'text-warning' }}">
                                    {{ ucfirst($transaction->status_bayar) }}
                                </h3>
                                <p class="text-muted mb-0">Pembayaran</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        {{-- DETAIL INFO --}}
        <div class="col-lg-8">
            <div class="card modern-card">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2 text-info"></i>
                        Informasi Lengkap
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Kode Transaksi</label>
                                <p class="info-value"><strong>{{ $transaction->kode_transaksi }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Customer</label>
                                <p class="info-value">{{ $transaction->customer->nama ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">No. Telepon</label>
                                <p class="info-value">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $transaction->customer->no_hp ?? '') }}" 
                                       class="text-success" target="_blank">
                                        {{ $transaction->customer->no_hp ?? '-' }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Service</label>
                                <p class="info-value">{{ $transaction->service->nama_service ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Berat</label>
                                <span class="badge badge-modern badge-warning">
                                    {{ $transaction->berat }} kg
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Harga/kg</label>
                                <span class="badge badge-modern badge-info">
                                    Rp {{ number_format($transaction->service->harga_per_kg ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Tanggal Masuk</label>
                                <p class="info-value">{{ $transaction->tanggal_masuk->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Tanggal Ambil</label>
                                <p class="info-value {{ $transaction->tanggal_ambil ? '' : 'text-muted' }}">
                                    {{ $transaction->tanggal_ambil ? $transaction->tanggal_ambil->format('d M Y H:i') : 'Belum ditentukan' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Jenis Pembayaran</label>
                                <span class="badge badge-modern badge-secondary">
                                    {{ ucfirst($transaction->jenis_pembayaran) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Status Pembayaran</label>
                                <span class="badge badge-modern {{ $transaction->status_bayar == 'lunas' ? 'badge-success-solid' : 'badge-warning-solid' }}">
                                    {{ ucfirst($transaction->status_bayar) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FINANCIAL SUMMARY --}}
        <div class="col-lg-4">
            <div class="card modern-card card-actions">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-calculator mr-2 text-success"></i>
                        Ringkasan Keuangan
                    </h3>
                </div>
                <div class="card-body text-center p-4">
                    <h2 class="text-success mb-1">Rp {{ number_format($transaction->total, 0, ',', '.') }}</h2>
                    <p class="text-muted mb-4">Total Tagihan</p>
                    
                    <div class="row text-left mb-4">
                        <div class="col-6">
                            <small class="text-muted">Sub Total</small><br>
                            <strong>Rp {{ number_format($transaction->sub_total, 0, ',', '.') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted">Diskon {{ $transaction->diskon }}%</small><br>
                            <strong class="text-danger">- Rp {{ number_format($transaction->sub_total * $transaction->diskon / 100, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                    
                    <span class="badge badge-modern badge-success-solid mb-2 d-block">
                        {{ ucfirst($transaction->status_bayar) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ACTIVITY --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-2 text-secondary"></i>
                        Aktivitas Transaksi
                    </h3>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon bg-primary">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Transaksi Dibuat</h5>
                                <p>{{ $transaction->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        @if($transaction->updated_at != $transaction->created_at)
                        <div class="timeline-item">
                            <div class="timeline-icon bg-warning">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Status Diperbarui</h5>
                                <p>{{ $transaction->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
/* IDENTIK DENGAN MEMBER SHOW */
.modern-card { 
    border: none; 
    border-radius: 16px; 
    box-shadow: 0 4px 20px rgba(0,0,0,0.08); 
    transition: all 0.3s ease; 
    margin-bottom: 24px; 
    overflow: hidden; 
}
.modern-card:hover { 
    transform: translateY(-4px); 
    box-shadow: 0 12px 30px rgba(0,0,0,0.15); 
}
.card-profile {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}
.card-profile h2{
    color: #ffffff;
}
.card-profile .text-muted{
    color: rgba(255,255,255,0.8) !important;
}
.avatar{
    width:120px;
    height:120px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 20px;
    border:4px solid rgba(255,255,255,0.25);
    background:linear-gradient(145deg,#2b2b2b,#555);
}
.avatar i { font-size: 48px; }
.stat-box{
    text-align: center;
    padding: 20px 10px;
    border-right: 1px solid rgba(255,255,255,0.15);
}
.stat-box:last-child{
    border-right: none;
}
.stat-box h3 {
    font-size: 24px; 
    font-weight: 700; 
    margin-bottom: 4px; 
}
.info-label {
    font-size: 13px; 
    font-weight: 600; 
    color: #8392a5; 
    text-transform: uppercase; 
    letter-spacing: 0.5px; 
    margin-bottom: 8px; 
}
.info-value {
    font-size: 18px; 
    font-weight: 600; 
    color: #2c3e50; 
    margin: 0; 
    line-height: 1.4; 
}
.card-actions {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
.card-actions .card-body {
    text-align: center;
}
.timeline::before { 
    content: ''; 
    position: absolute; 
    left: 20px; top: 0; 
    bottom: 0; width: 2px; 
    background: linear-gradient(to bottom, #e9ecef, #dee2e6); 
}
.timeline-item { 
    position: relative; 
    margin-bottom: 24px; 
    padding-left: 50px; 
}
.timeline-icon { 
    position: absolute; 
    left: 8px; 
    top: 4px; 
    width: 36px; 
    height: 36px; 
    border-radius: 50%; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    color: white; 
    font-size: 14px; 
    z-index: 1; 
}
.timeline-content h5 { 
    color: #2c3e50; 
    font-size: 16px; 
    margin-bottom: 4px; 
    font-weight: 600;
}
.timeline-content p { 
    color: #8392a5; 
    font-size: 13px; 
    margin: 0;
}
@media (max-width: 768px) { 
    .stat-box { 
        border-right: none !important; 
        border-bottom: 1px solid rgba(255,255,255,0.2); 
        margin-bottom: 16px; 
    } 
}
</style>
@stop

@section('js')
<script>
function copyTransactionInfo() {
    const info = `📝 Transaksi #{{ $transaction->kode_transaksi }}
👤 {{ $transaction->customer->nama ?? '-' }}
⚖️ {{ $transaction->berat }} kg - {{ $transaction->service->nama_service ?? '-' }}
💰 Rp {{ number_format($transaction->total, 0, ',', '.') }}
📅 {{ $transaction->tanggal_masuk->format('d M Y') }}
{{ $transaction->status_bayar == 'lunas' ? '✅ LUNAS' : '⏳ BELUM BAYAR' }}`;
    
    navigator.clipboard.writeText(info).then(() => {
        toastr.success('Info transaksi berhasil dicopy!', 'Sukses');
    });
}
</script>
@stop