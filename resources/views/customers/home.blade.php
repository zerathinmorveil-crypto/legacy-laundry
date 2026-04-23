@extends('layouts.customer')

@section('title', 'Dashboard Saya')

@section('content')
<div class="container py-4">

    {{-- Greeting --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white shadow">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <h4 class="mb-1">Halo, {{ $user->name }}! 👋</h4>
                        <p class="mb-0 opacity-75">Selamat datang di layanan laundry kami.</p>
                    </div>
                    <i class="fas fa-tshirt fa-3x ml-auto opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center border-left-primary">
                <div class="card-body">
                    <i class="fas fa-shopping-bag fa-2x text-primary mb-2"></i>
                    <h5 class="font-weight-bold">{{ $recentTransactions->count() }}</h5>
                    <p class="text-muted mb-0">Total Transaksi</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center border-left-success">
                <div class="card-body">
                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                    <h5 class="font-weight-bold">
                        {{ $recentTransactions->where('status', 'selesai')->count() }}
                    </h5>
                    <p class="text-muted mb-0">Selesai</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center border-left-warning">
                <div class="card-body">
                    <i class="fas fa-spinner fa-2x text-warning mb-2"></i>
                    <h5 class="font-weight-bold">
                        {{ $recentTransactions->where('status', 'proses')->count() }}
                    </h5>
                    <p class="text-muted mb-0">Diproses</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Transaksi Terbaru --}}
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-history mr-2"></i>Transaksi Terbaru</h5>
            <a href="{{ route('customer.transactions') }}" class="btn btn-sm btn-outline-primary">
                Lihat Semua
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Kode</th>
                            <th>Layanan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $trx)
                        <tr>
                            <td><code>{{ $trx->kode_transaksi ?? '#'.$trx->id }}</code></td>
                            <td>{{ $trx->service->nama_service ?? '-' }}</td>
                            <td>Rp {{ number_format($trx->sub_total, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $badge = match($trx->status ?? '') {
                                        'selesai'  => 'success',
                                        'proses'   => 'warning',
                                        'antrian'  => 'info',
                                        'diambil'  => 'secondary',
                                        default    => 'light'
                                    };
                                @endphp
                                <span class="badge badge-{{ $badge }}">
                                    {{ ucfirst($trx->status ?? 'pending') }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Belum ada transaksi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@stop