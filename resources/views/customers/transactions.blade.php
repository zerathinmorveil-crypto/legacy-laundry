@extends('layouts.customer')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">
            <i class="fas fa-receipt mr-2"></i>Riwayat Transaksi Saya
        </h4>
        <a href="{{ route('customer.order.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Buat Pesanan Baru
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- CARD --}}
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Layanan</th>
                            <th>Berat</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th> {{-- 🔥 tambahan --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                        <tr>
                            <td>
                                {{ $loop->iteration + ($transactions->currentPage() - 1) * $transactions->perPage() }}
                            </td>

                            <td>
                                <code>{{ $trx->kode_transaksi ?? '#'.$trx->id }}</code>
                            </td>

                            <td>{{ $trx->service->nama_service ?? '-' }}</td>

                            <td>{{ $trx->berat ?? '-' }} kg</td>

                            <td>
                                Rp {{ number_format($trx->sub_total ?? $trx->total, 0, ',', '.') }}
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @php
                                    $status = $trx->status ?? 'pending';

                                    $badge = match($status) {
                                        'pending'       => 'secondary',
                                        'dikonfirmasi'  => 'info',
                                        'proses'        => 'warning',
                                        'selesai'       => 'success',
                                        'diambil'       => 'dark',
                                        default         => 'light'
                                    };
                                @endphp

                                <span class="badge badge-{{ $badge }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y') }}
                            </td>

                            {{-- AKSI --}}
                            <td>
                                @if(($trx->status ?? '') === 'pending')
                                <form action="{{ route('customer.order.cancel', $trx->id) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-xs"
                                        onclick="return confirm('Batalkan pesanan ini?')">
                                        <i class="fas fa-times"></i> Batal
                                    </button>
                                </form>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Belum ada transaksi. <br>

                                <a href="{{ route('customer.order.create') }}"
                                   class="btn btn-primary btn-sm mt-2">
                                    <i class="fas fa-plus mr-1"></i> Buat Pesanan Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if($transactions->hasPages())
        <div class="card-footer">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</div>
@stop