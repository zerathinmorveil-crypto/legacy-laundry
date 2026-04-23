@extends('adminlte::page')

@section('title', 'Data Customer')

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
    
    {{-- STATS CARDS - IDENTIK MEMBER --}}
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="card-subtitle">Total Customer</p>
                            <h2 class="card-number">{{ $customers->total() }}</h2>
                            <p class="card-info">All Customers</p>
                        </div>
                        <div class="icon-wrapper bg-primary-light">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="card-subtitle">Aktif</p>
                            <h2 class="card-number">{{ $customers->where('status', 'aktif')->count() }}</h2>
                            <p class="card-info">Active</p>
                        </div>
                        <div class="icon-wrapper bg-success-light">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="card-subtitle">Nonaktif</p>
                            <h2 class="card-number">{{ $customers->where('status', 'nonaktif')->count() }}</h2>
                            <p class="card-info">Inactive</p>
                        </div>
                        <div class="icon-wrapper bg-warning-light">
                            <i class="fas fa-pause-circle text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="card-subtitle">Halaman</p>
                            <h2 class="card-number">{{ $customers->currentPage() }}/{{ $customers->lastPage() }}</h2>
                            <p class="card-info">Pagination</p>
                        </div>
                        <div class="icon-wrapper bg-info-light">
                            <i class="fas fa-list text-info"></i>
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
                        Daftar Customer
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('customers.create') }}" class="btn btn-sm btn-outline-primary btn-modern">
                            <i class="fas fa-plus mr-1"></i>Tambah
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
                                    <th width="50">Foto</th>
                                    <th>Nama Customer</th>
                                    <th width="130">No. HP</th>
                                    <th width="150">Email</th>
                                    <th width="100">Status</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $index => $customer)
                                <tr>
                                    <td>
                                        <strong class="text-primary">{{ ($customers->currentPage() - 1) * $customers->perPage() + $loop->iteration }}</strong>
                                    </td>
                                    <td>
                                        <div class="avatar-sm bg-light-primary">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $customer->nama }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($customer->alamat, 40) }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $customer->no_hp) }}" 
                                           class="text-success font-weight-bold" target="_blank">
                                            <i class="fab fa-whatsapp mr-1"></i>{{ $customer->no_hp }}
                                        </a>
                                    </td>
                                    <td>
                                        <small class="text-muted d-block">{{ Str::limit($customer->email, 25) }}</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern {{ $customer->status == 'aktif' ? 'badge-success' : 'badge-warning' }}">
                                            <i class="fas fa-circle mr-1"></i>{{ ucfirst($customer->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('customers.show', $customer) }}" 
                                               class="btn btn-outline-info btn-modern" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('customers.edit', $customer) }}" 
                                               class="btn btn-outline-warning btn-modern" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-modern" 
                                                        title="Hapus" onclick="return confirm('Yakin hapus customer {{ $customer->nama }}?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-users fa-3x text-muted mb-3 opacity-50"></i>
                                            <h5 class="text-muted">Belum ada customer</h5>
                                            <p class="text-muted mb-4">Mulai tambahkan customer pertama Anda</p>
                                            <a href="{{ route('customers.create') }}" class="btn btn-primary btn-modern">
                                                <i class="fas fa-plus mr-2"></i>Tambah Customer
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
                        Menampilkan {{ ($customers->currentPage() - 1) * $customers->perPage() + 1 }} 
                        - {{ min($customers->currentPage() * $customers->perPage(), $customers->total()) }} 
                        dari {{ $customers->total() }} customer
                    </div>
                    <div class="float-right">
                        {{ $customers->appends(request()->query())->links() }}
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
/* FULL MODERN DESIGN - IDENTIK MEMBER */
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

/* Stats Cards */
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
.bg-primary-light { background: rgba(78,115,223,0.2) !important; }
.bg-success-light { background: rgba(28,200,138,0.2) !important; }
.bg-warning-light { background: rgba(246,194,62,0.2) !important; }
.bg-info-light { background: rgba(54,185,204,0.2) !important; }

/* Gradient Cards */
.gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; color: white !important; }
.gradient-success { background: linear-gradient(135deg, #1cc88a 0%, #17a2b8 100%) !important; color: white !important; }
.gradient-warning { background: linear-gradient(135deg, #f6c23e 0%, #f8b500 100%) !important; color: white !important; }
.gradient-info { background: linear-gradient(135deg, #36b9cc 0%, #4e73df 100%) !important; color: white !important; }

/* Table Styles */
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

/* Avatar & Badges */
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
    display: inline-flex;
    align-items: center;
}
.badge-success { background: rgba(28,200,138,0.15) !important; color: #1cc88a !important; }
.badge-warning { background: rgba(246,194,62,0.15) !important; color: #f6c23e !important; }

/* Empty State */
.empty-state { 
    padding: 60px 20px; 
    color: #6c757d;
}
.empty-state i {
    opacity: 0.5;
}

/* Responsive */
@media (max-width: 768px) {
    .card-body { padding: 20px !important; }
    .modern-table thead th,
    .modern-table tbody td { padding: 12px 16px !important; }
}
</style>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
// Auto dismiss alerts
setTimeout(() => $('.alert').fadeOut('slow'), 5000);

// Table responsive fix
$('.table-responsive').on('show.bs.dropdown', function () {
    $('.table-responsive').css('overflow', 'inherit');
});
</script>
@stop