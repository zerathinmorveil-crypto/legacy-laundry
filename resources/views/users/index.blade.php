@extends('adminlte::page')

@section('title', 'Manajemen User')

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
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="card-subtitle">Total User</p>
                            <h2 class="card-number">{{ $users->total() }}</h2>
                            <p class="card-info">All Users</p>
                        </div>
                        <div class="icon-wrapper bg-primary-light">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="card-subtitle">Admin</p>
                            <h2 class="card-number">{{ $users->where('role', 'admin')->count() }}</h2>
                            <p class="card-info">Administrator</p>
                        </div>
                        <div class="icon-wrapper bg-danger-light">
                            <i class="fas fa-user-shield text-danger"></i>
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
                            <p class="card-subtitle">Kasir</p>
                            <h2 class="card-number">{{ $users->where('role', 'kasir')->count() }}</h2>
                            <p class="card-info">Cashier</p>
                        </div>
                        <div class="icon-wrapper bg-warning-light">
                            <i class="fas fa-user-tie text-warning"></i>
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
                            <h2 class="card-number">{{ $users->currentPage() }}/{{ $users->lastPage() }}</h2>
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

    {{-- TABLE --}}
    <div class="row">
        <div class="col-12">
            <div class="card modern-table-card">
                <div class="card-header border-0">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-users-cog mr-2"></i>
                        Daftar User
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-outline-primary btn-modern">
                            <i class="fas fa-plus mr-1"></i>Tambah User
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
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
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
                                    <th width="50">Avatar</th>
                                    <th>Nama User</th>
                                    <th width="200">Email</th>
                                    <th width="100">Role</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>
                                        <strong class="text-primary">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</strong>
                                    </td>
                                    <td>
                                        <div class="avatar-sm {{ $user->role == 'admin' ? 'bg-light-danger' : 'bg-light-warning' }}">
                                            <i class="fas {{ $user->role == 'admin' ? 'fa-user-shield text-danger' : 'fa-user-tie text-warning' }}"></i>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $user->name }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                @if($user->id === auth()->id())
                                                    <span class="text-primary"><i class="fas fa-star mr-1"></i>Akun Anda</span>
                                                @else
                                                    ID: {{ $user->id }}
                                                @endif
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </td>
                                    <td>
                                        @if($user->role == 'admin')
                                            <span class="badge badge-modern badge-danger-custom">
                                                <i class="fas fa-circle mr-1"></i>Admin
                                            </span>
                                        @else
                                            <span class="badge badge-modern badge-warning-custom">
                                                <i class="fas fa-circle mr-1"></i>Kasir
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('users.edit', $user->id) }}"
                                               class="btn btn-outline-warning btn-modern" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-modern"
                                                        title="Hapus" onclick="return confirm('Yakin hapus user {{ $user->name }}?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @else
                                            <button class="btn btn-outline-secondary btn-modern" disabled title="Tidak bisa hapus akun sendiri">
                                                <i class="fas fa-lock"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-users fa-3x text-muted mb-3 opacity-50"></i>
                                            <h5 class="text-muted">Belum ada user</h5>
                                            <p class="text-muted mb-4">Mulai tambahkan user pertama</p>
                                            <a href="{{ route('users.create') }}" class="btn btn-primary btn-modern">
                                                <i class="fas fa-plus mr-2"></i>Tambah User
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
                        Menampilkan {{ ($users->currentPage() - 1) * $users->perPage() + 1 }}
                        - {{ min($users->currentPage() * $users->perPage(), $users->total()) }}
                        dari {{ $users->total() }} user
                    </div>
                    <div class="float-right">
                        {{ $users->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
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
.modern-card .card-body { padding: 28px; }
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
.icon-wrapper i { font-size: 24px; }
.bg-primary-light { background: rgba(78,115,223,0.2) !important; }
.bg-danger-light  { background: rgba(231,74,59,0.2) !important; }
.bg-warning-light { background: rgba(246,194,62,0.2) !important; }
.bg-info-light    { background: rgba(54,185,204,0.2) !important; }

.gradient-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; }
.gradient-danger  { background: linear-gradient(135deg, #e74a3b 0%, #c0392b 100%) !important; }
.gradient-warning { background: linear-gradient(135deg, #f6c23e 0%, #f8b500 100%) !important; }
.gradient-info    { background: linear-gradient(135deg, #36b9cc 0%, #4e73df 100%) !important; }

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
.modern-table tbody tr:hover { background-color: #f8f9fa; }

.avatar-sm {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}
.bg-light-danger  { background: rgba(231,74,59,0.15) !important; }
.bg-light-warning { background: rgba(246,194,62,0.15) !important; }

.badge-modern {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
}
.badge-danger-custom  { background: rgba(231,74,59,0.15) !important; color: #e74a3b !important; }
.badge-warning-custom { background: rgba(246,194,62,0.15) !important; color: #d4a017 !important; }

.btn-modern {
    border-radius: 8px !important;
    font-weight: 500;
    padding: 6px 12px;
}
.empty-state { padding: 60px 20px; }
.empty-state i { opacity: 0.5; }

@media (max-width: 768px) {
    .card-body { padding: 20px !important; }
    .modern-table thead th,
    .modern-table tbody td { padding: 12px 16px !important; }
}
</style>
@stop

@section('js')
<script>
setTimeout(() => $('.alert').fadeOut('slow'), 5000);
</script>
@stop