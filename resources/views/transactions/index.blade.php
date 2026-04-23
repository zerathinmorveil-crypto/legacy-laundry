@extends('adminlte::page')

@section('title', 'Data Transaksi')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0"></h1>
        <p class="mb-0 text-muted"></p>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    
    {{-- STATS CARDS --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-primary">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="card-subtitle">Total Transaksi</p>
                            <h2 class="card-number"></h2>
                            <p class="card-info">Semua Periode</p>
                        </div>
                        <div class="icon-wrapper bg-primary-light">
                            <i class="fas fa-receipt text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STATUS TRANSAKSI -->
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-label">Status Transaksi <span class="text-danger">*</span></label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="">Pilih Status</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="dikonfirmasi" {{ old('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="proses" {{ old('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="diambil" {{ old('status') == 'diambil' ? 'selected' : '' }}>Diambil</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-warning">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="card-subtitle">Proses</p>
                            <h2 class="card-number"> </h2>
                            <p class="card-info">Sedang Dikerjakan</p>
                        </div>
                        <div class="icon-wrapper bg-warning-light">
                            <i class="fas fa-spinner text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-info">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="card-subtitle">Pendapatan</p>
                            <h2 class="card-number">Rp </h2>
                            <p class="card-info">Total Penjualan</p>
                        </div>
                        <div class="icon-wrapper bg-info-light">
                            <i class="fas fa-money-bill-wave text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODERN TABLE --}}
    <div class="row">
        <div class="col-12">
            <div class="card modern-table-card">
                <div class="card-header border-0">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-list mr-2"></i>
                        Daftar Transaksi Laundry
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-outline-primary btn-modern">
                            <i class="fas fa-plus mr-1"></i>Tambah
                        </a>
                        <a href="{{ route('transactions.pdf') }}" class="btn btn-sm btn-warning btn-modern" target="_blank">
                            <i class="fas fa-file-pdf mr-1"></i>⭐ Cetak PDF
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover modern-table">
                            <thead>
                                <tr>
                                    <th width="60">#</th>
                                    <th width="100">Kode</th>
                                    <th>Customer</th>
                                    <th width="120">Service</th>
                                    <th width="100">Berat</th>
                                    <th width="120">Tgl Masuk</th>
                                    <th width="120">Tgl Ambil</th>
                                    <th width="120">Sub Total</th>
                                    <th width="80">Diskon</th>
                                    <th width="120">Total</th>
                                    <th width="100">Status</th>
                                    <th width="120">Pembayaran</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $index => $item)
                                <tr>
                                    <td>
                                        <strong class="text-primary">{{ ($transactions->currentPage() - 1) * $transactions  ->perPage() + $loop->iteration }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern badge-primary">
                                            {{ $item->kode_transaksi ?? '#'.$item->id }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary-light mr-2 text-primary">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div>
                                                <strong>{{ $item->customer->nama ?? '-' }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $item->customer->no_hp ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern badge-info">
                                            {{ $item->service->nama_service ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern badge-warning">
                                            {{ $item->berat }} kg
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="{{ $item->tanggal_ambil ? '' : 'text-danger font-weight-bold' }}">
                                            {{ $item->tanggal_ambil ? \Carbon\Carbon::parse($item->tanggal_ambil)->format('d/m/Y') : 'Belum ditentukan' }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>Rp {{ number_format($item->sub_total, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern badge-success">
                                            {{ $item->diskon }}%
                                        </span>
                                    </td>
                                    <td>
                                        <strong class="text-success">Rp {{ number_format($item->total, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern {{ $item->status_color }}">
                                            <i class="fas fa-circle mr-1"></i>{{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern {{ $item->status_bayar == 'lunas' ? 'badge-success-solid' : 'badge-warning-solid' }}">
                                            {{ ucfirst($item->status_bayar) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('transactions.show', $item) }}" 
                                               class="btn btn-outline-info btn-modern" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('transactions.edit', $item) }}" 
                                               class="btn btn-outline-warning btn-modern" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('transactions.struk', $item) }}" 
                                               class="btn btn-outline-success btn-modern" 
                                               title="Cetak Struk" target="_blank">
                                                <i class="fas fa-receipt"></i>
                                            </a>
                                            <form action="{{ route('transactions.destroy', $item) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-modern" 
                                                        title="Hapus" onclick="return confirm('Yakin hapus transaksi {{ $item->kode_transaksi }}?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="13" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-receipt fa-3x text-muted mb-3 opacity-50"></i>
                                            <h5 class="text-muted">Belum ada transaksi</h5>
                                            <p class="text-muted mb-4">Mulai tambahkan transaksi pertama Anda</p>
                                            <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-modern">
                                                <i class="fas fa-plus mr-2"></i>Tambah Transaksi
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-top pt-3 clearfix">
                    <div class="float-left">
                        Menampilkan {{ ($transactions->currentPage() - 1) * $transactions->perPage() + 1 }} 
                        - {{ min($transactions->currentPage() * $transactions->perPage(), $transactions->total()) }} 
                        dari {{ $transactions->total() }} transaksi
                    </div>
                    <div class="float-right">
                        {{ $transactions->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
/* IDENTIK DENGAN MEMBER INDEX */
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
.modern-card .card-body {
    padding: 28px;
}
.modern-table-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}
.modern-table-card .card-header {
    background: white;
    padding: 24px 28px;
    border-bottom: 1px solid #e9ecef;
}
.card-subtitle {
    font-size: 13px;
    color: rgba(255,255,255,0.9);
    margin-bottom: 8px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.card-number {
    font-size: 32px;
    font-weight: 700;
    margin: 0;
    color: white;
}
.card-info {
    font-size: 13px;
    color: rgba(255,255,255,0.8);
    margin: 0;
}
.icon-wrapper {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.icon-wrapper i {
    font-size: 24px;
}
.bg-primary-light { 
    background: rgba(78,115,223,0.2) !important; 
}
.bg-success-light { 
    background: rgba(28,200,138,0.2) !important; 
}
.bg-warning-light { 
    background: rgba(246,194,62,0.2) !important; 
}
.bg-info-light { 
    background: rgba(54,185,204,0.2) !important; 
}

.gradient-primary { 
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; 
    color: white !important; 
}
.gradient-success { 
    background: linear-gradient(135deg, #1cc88a 0%, #17a2b8 100%) !important; 
    color: white !important; 
}
.gradient-warning { 
    background: linear-gradient(135deg, #f6c23e 0%, #f8b500 100%) !important; 
    color: white !important; 
}
.gradient-info { 
    background: linear-gradient(135deg, #36b9cc 0%, #4e73df 100%) !important; 
    color: white !important; 
}

.modern-table thead th {
    border-top: none;
    border-bottom: 2px solid #f0f3f5;
    color: #8392a5;
    font-weight: 600;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 18px 24px;
    background: #fafbfc;
}
.modern-table tbody td {
    padding: 18px 24px;
    vertical-align: middle;
    border-top: 1px solid #f0f3f5;
}
.modern-table tbody tr:hover {
    background-color: #f8f9fa;
}
.avatar-sm {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}
.badge-modern {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}
.badge-success-solid { 
    background: #1cc88a !important; 
    color: white !important; 
}
.badge-warning-solid { 
    background: #f6c23e !important; 
    color: white !important; 
}
.empty-state { padding: 60px 20px; }
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
setTimeout(() => $('.alert').fadeOut('slow'), 5000);
$('.table-responsive').on('show.bs.dropdown', function () {
    $('.table-responsive').css('overflow', 'inherit');
});
</script>
@stop