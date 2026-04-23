@extends('adminlte::page')

@section('title', 'Jenis Service')

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
    {{-- DATA TABLE --}}
    <div class="row">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header border-0 pb-0">
                    <h3 class="card-title">
                        <i class="fas fa-list mr-2"></i>
                        Daftar Service
                    </h3>
                </div>
                <div class="card-body pt-0">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-modern table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Nama Service</th>
                                    <th>Harga/kg</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $index => $service)
                                <tr>
                                    <td>
                                        <strong>{{ ($services->currentPage() - 1) * $services->perPage() + $loop->iteration }}</strong>
                                    </td>
                                    <td>
                                        <div class="avatar-sm bg-light-primary">
                                            <i class="fas fa-tshirt text-primary"></i>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $service->nama_service }}</strong>
                                            <br><small class="text-muted">{{ Str::limit($service->deskripsi ?? 'Tidak ada deskripsi', 50) }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern badge-success">
                                            Rp {{ number_format($service->harga_per_kg, 0, ',', '.') }}/kg
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-modern {{ $service->status == 'aktif' ? 'badge-success' : 'badge-warning' }}">
                                            <i class="fas fa-circle mr-1"></i>{{ ucfirst($service->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('services.show', $service) }}" class="btn btn-sm btn-outline-info btn-modern">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-outline-warning btn-modern">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('services.destroy', $service) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger btn-modern" 
                                                        onclick="return confirm('Yakin?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="empty-state">
                                            <i class="fas fa-cogs fa-3x text-muted mb-3"></i>
                                            <h5>Belum ada service</h5>
                                            <p class="text-muted">Tambahkan service laundry pertama</p>
                                            <a href="{{ route('services.create') }}" class="btn btn-primary mt-2">
                                                Tambah Service
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer border-top pt-3">
                        {{ $services->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop