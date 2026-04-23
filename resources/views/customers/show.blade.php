@extends('adminlte::page')

@section('title', 'Detail Customer')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0"></h1>
            <p class="mb-0 text-muted"></p>
        </div>
        <div>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i>Kembali
            </a>
            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary ml-2">
                <i class="fas fa-edit mr-1"></i>Edit
            </a>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    
    {{-- CUSTOMER PROFILE CARD --}}
    <div class="row">
        <div class="col-12">
            <div class="card modern-card card-profile">
                <div class="card-body text-center p-5">
                    <div class="avatar-wrapper mb-4">
                        <div class="avatar bg-primary">
                            <i class="fas fa-user text-white"></i>
                        </div>
                    </div>
                    <h2 class="mb-2">{{ $customer->nama }}</h2>
                    <p class="text-muted mb-4">{{ $customer->email }}</p>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h3 class="text-primary">{{ $customer->status == 'aktif' ? 'Aktif' : 'Nonaktif' }}</h3>
                                <p class="text-muted mb-0">Status</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h3 class="text-success">{{ $customer->no_hp }}</h3>
                                <p class="text-muted mb-0">No. HP</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-box">
                                <h3 class="text-info">{{ $customer->email }}</h3>
                                <p class="text-muted mb-0">Email</p>
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
                    <h3 class="card-title mb-0">
                        <i class="fas fa-info-circle mr-2 text-info"></i>
                        Informasi Lengkap
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Nama Lengkap</label>
                                <p class="info-value">{{ $customer->nama }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">No. Telepon</label>
                                <p class="info-value">{{ $customer->no_hp }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Email</label>
                                <p class="info-value">{{ $customer->email }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Status</label>
                                <span class="badge badge-modern {{ $customer->status == 'aktif' ? 'badge-success-solid' : 'badge-danger-solid' }}">
                                    <i class="fas fa-circle mr-1"></i>
                                    {{ ucfirst($customer->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-item">
                                <label class="info-label">Alamat</label>
                                <p class="info-value">{{ $customer->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- QUICK ACTIONS --}}
        <div class="col-lg-4">
            <div class="card modern-card card-actions">
                <div class="card-header border-0">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-cogs mr-2 text-warning"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="action-item mb-3">
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-outline-primary btn-block">
                            <i class="fas fa-edit mr-2"></i>Edit Data
                        </a>
                    </div>
                    <div class="action-item mb-3">
                        <button class="btn btn-outline-success btn-block" onclick="copyContact()">
                            <i class="fas fa-copy mr-2"></i>Copy Kontak
                        </button>
                    </div>
                    <div class="action-item mb-3">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $customer->no_hp) }}" 
                           class="btn btn-success btn-block" target="_blank">
                            <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                        </a>
                    </div>
                    <div class="action-item mb-3">
                        <a href="mailto:{{ $customer->email }}" class="btn btn-outline-info btn-block">
                            <i class="fas fa-envelope mr-2"></i>Kirim Email
                        </a>
                    </div>
                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="action-item">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-block" 
                                onclick="return confirm('Yakin ingin menghapus customer ini?')">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ACTIVITY FEED (Kosong untuk sekarang, bisa diisi log aktivitas) --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header border-0">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-history mr-2 text-secondary"></i>
                        Aktivitas Terakhir
                    </h3>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon bg-primary">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Customer Dibuat</h5>
                                <p>{{ $customer->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        @if($customer->updated_at != $customer->created_at)
                        <div class="timeline-item">
                            <div class="timeline-icon bg-warning">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Data Diperbarui</h5>
                                <p>{{ $customer->updated_at->format('d M Y H:i') }}</p>
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
    /* Modern Card Styles - Same as Dashboard */
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

    .modern-card .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-bottom: 1px solid #e9ecef;
        padding: 24px 28px;
    }

    /* Profile Card */
    .card-profile {
    background: linear-gradient(135deg, gray 0%, #000000 100%);
    color: gray;
    text-align: center;
    } 

    .card-profile .card-body {
        padding: 40px 28px;
    }

    .avatar-wrapper {
        display: inline-block;
    }

    .avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        border: 4px solid rgba(255,255,255,0.3);
    }

    .avatar i {
        font-size: 48px;
    }

    .card-profile h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
        color: white;
    }

    /* Stat Box */
    .stat-box {
        text-align: center;
        padding: 20px 10px;
        border-right: 1px solid rgba(255,255,255,0.2);
    }

    .stat-box:last-child {
        border-right: none;
    }

    .stat-box h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    /* Info Items */
    .info-item {
        margin-bottom: 24px;
    }

    .info-label {
        font-size: 13px;
        font-weight: 600;
        color: #8392a5;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: block;
    }

    .info-value {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
        line-height: 1.4;
    }

    /* Modern Badges */
    .badge-modern {
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Action Items */
    .action-item {
        margin-bottom: 12px;
    }

    .action-item .btn {
        border-radius: 12px;
        padding: 12px 20px;
        font-weight: 500;
        border-width: 2px;
        transition: all 0.3s ease;
    }

    .action-item .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    /* Timeline */
    .timeline {
        position: relative;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #e9ecef, #dee2e6);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 24px;
        padding-left: 50px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
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

    /* Responsive */
    @media (max-width: 768px) {
        .stat-box {
            border-right: none !important;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 16px;
        }
        
        .stat-box:last-child {
            border-bottom: none;
        }
    }

    /* Card Title */
    .card-title {
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
    }

    .card-title i {
        color: inherit;
        opacity: 0.8;
    }
</style>
@stop

@section('js')
<script>
function copyContact() {
    const contactInfo = `{{ $customer->nama }}\n{{ $customer->no_hp }}\n{{ $customer->email }}`;
    
    navigator.clipboard.writeText(contactInfo).then(function() {
        // Show success toast
        toastr.success('Kontak berhasil dicopy!', 'Sukses', {
            timeOut: 3000,
            positionClass: 'toast-top-right'
        });
    }).catch(function(err) {
        console.error('Gagal copy: ', err);
        alert('Gagal copy kontak. Silakan copy manual.');
    });
}

// Auto dismiss alerts
$(document).ready(function() {
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@stop