@extends('adminlte::page')

@section('title', 'Detail Member')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0"></h1>
        <p class="mb-0 text-muted"></p>
    </div>
    <div>
        <a href="{{ route('members.index') }}" class="btn btn-secondary mr-2">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
        <a href="{{ route('members.edit', $member) }}" class="btn btn-primary">
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
                        <div class="avatar {{ $member->jenis_member_color }}">
                            <i class="fas fa-star text-white"></i>
                        </div>
                    </div>
                    <h2 class="mb-2">{{ $member->nama_member }}</h2>
                    <div class="mb-4">
                        <span class="badge badge-modern badge-primary">{{ $member->kode_member }}</span>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h3 class="text-{{ $member->jenis_member == 'platinum' ? 'success' : ($member->jenis_member == 'gold' ? 'warning' : 'info') }}">
                                    {{ ucfirst($member->jenis_member) }}
                                </h3>
                                <p class="text-muted mb-0">Jenis</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h3 class="text-success">{{ $member->diskon }}%</h3>
                                <p class="text-muted mb-0">Diskon</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h3 class="text-primary">{{ $member->no_hp }}</h3>
                                <p class="text-muted mb-0">No. HP</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-box">
                                <h3 class="{{ $member->status == 'aktif' ? 'text-success' : 'text-warning' }}">
                                    {{ ucfirst($member->status) }}
                                </h3>
                                <p class="text-muted mb-0">Status</p>
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
                                <label class="info-label">Kode Member</label>
                                <p class="info-value"><strong>{{ $member->kode_member }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Nama Lengkap</label>
                                <p class="info-value">{{ $member->nama_member }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">No. Telepon</label>
                                <p class="info-value">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->no_hp) }}" 
                                       class="text-success" target="_blank">
                                        {{ $member->no_hp }}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Email</label>
                                <p class="info-value">{{ $member->email ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Jenis Member</label>
                                <span class="badge badge-modern {{ $member->jenis_member_color }}">
                                    {{ ucfirst($member->jenis_member) }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <label class="info-label">Diskon</label>
                                <span class="badge badge-modern badge-success">
                                    {{ $member->diskon }}%
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-item">
                                <label class="info-label">Alamat</label>
                                <p class="info-value">{{ $member->alamat }}</p>
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
                    <h3 class="card-title">
                        <i class="fas fa-cogs mr-2 texttext-warning"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="action-item mb-3">
                        <a href="{{ route('members.edit', $member) }}" class="btn btn-outline-primary btn-block">
                            <i class="fas fa-edit mr-2"></i>Edit Data
                        </a>
                    </div>
                    <div class="action-item mb-3">
                        <button class="btn btn-outline-success btn-block" onclick="copyContact()">
                            <i class="fas fa-copy mr-2"></i>Copy Kontak
                        </button>
                    </div>
                    <div class="action-item mb-3">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->no_hp) }}" 
                           class="btn btn-success btn-block" target="_blank">
                            <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                        </a>
                    </div>
                    @if($member->email)
                    <div class="action-item mb-3">
                        <a href="mailto:{{ $member->email }}" class="btn btn-outline-info btn-block">
                            <i class="fas fa-envelope mr-2"></i>Kirim Email
                        </a>
                    </div>
                    @endif
                    <div class="action-item">
                        <form action="{{ route('members.destroy', $member) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-block" 
                                    onclick="return confirm('Yakin hapus member premium ini?')">
                                <i class="fas fa-trash mr-2"></i>Hapus Member
                            </button>
                        </form>
                    </div>
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
                        Aktivitas Member
                    </h3>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon bg-primary">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Member Dibuat</h5>
                                <p>{{ $member->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        @if($member->updated_at != $member->created_at)
                        <div class="timeline-item">
                            <div class="timeline-icon bg-warning">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Data Diperbarui</h5>
                                <p>{{ $member->updated_at->format('d M Y H:i') }}</p>
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
/* Identik dengan Customer Show */
.modern-card { border: none; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; margin-bottom: 24px; overflow: hidden; }
.modern-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.15); }
.card-profile {
    background: linear-gradient(135deg, #1c1c1c 0%, #3a3a3a 50%, #6a6a6a 100%);
    color: white;
}
.card-profile h2{
    color: #ffffff;
}
.card-profile .text-muted{
    color: rgba(255,255,255,0.7) !important;
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
.action-item .btn { 
    border-radius: 12px; 
    padding: 12px 20px; 
    font-weight: 500; 
    border-width: 2px; 
}
.action-item .btn:hover { 
    transform: translateY(-2px); 
    box-shadow: 0 6px 15px rgba(0,0,0,0.15); 
}
.timeline::before { 
    content: ''; 
    position: absolute; 
    left: 20px; top: 0; 
    bottom: 0; width: 2px; 
    background: linear-gradient(to bottom, #e9ecef, #dee2e6); 
    border-radius: 1px;
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
    } }
</style>
@stop

@section('js')
<script>
function copyContact() {
    const contact = `{{ $member->nama_member }} | {{ $member->kode_member }}
📱 {{ $member->no_hp }}
✉️ {{ $member->email ?? 'Tidak ada' }}
⭐ {{ ucfirst($member->jenis_member) }} - {{ $member->diskon }}%`;
    
    navigator.clipboard.writeText(contact).then(() => {
        toastr.success('Kontak member berhasil dicopy!', 'Sukses');
    });
}
</script>
@stop