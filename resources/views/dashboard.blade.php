@extends('adminlte::page')

@section('title', 'Dashboard Laundry')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0"></h1>
    </div>
@stop

@section('content')
<div class="container-fluid">
    
    {{-- STATS CARDS WITH MODERN DESIGN --}}
    <div class="row mb-4">
        <!-- Total Transaksi -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="card-subtitle">Total Transaksi</p>
                            <h2 class="card-number">{{ $totalTransaksi }}</h2>
                            <p class="card-info">Selesai</p>
                        </div>
                        <div class="icon-wrapper bg-primary-light">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Sedang Diproses -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="card-subtitle">Sedang Diproses</p>
                            <h2 class="card-number">{{ $proses }}</h2>
                            <p class="card-info">Active cucian</p>
                        </div>
                        <div class="icon-wrapper bg-warning-light">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Total Customer -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="card-subtitle">Total Customer</p>
                            <h2 class="card-number">{{ $totalCustomer }}</h2>
                            <p class="card-info">Member</p>
                        </div>
                        <div class="icon-wrapper bg-success-light">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Pendapatan -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card modern-card gradient-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="card-subtitle">Pendapatan</p>
                            <h2 class="card-number">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h2>
                            <p class="card-info">Bulan ini</p>
                        </div>
                        <div class="icon-wrapper bg-info-light">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TRANSAKSI AKTIF TABLE --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card modern-table-card">
                <div class="card-header border-0">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-list-alt mr-2"></i>
                        Transaksi Aktif
                    </h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover modern-table">
                            <thead>
                                <tr>
                                    <th>Nomor Nota</th>
                                    <th>Customer</th>
                                    <th>Layanan</th>
                                    <th>Berat</th>
                                    <th>Status</th>
                                    <th>Pembayaran</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="service-icon bg-primary">
                                            <i class="fas fa-tshirt"></i>
                                        </div>
                                        <strong class="ml-2"> </strong>
                                    </div>
                                </td>
                            
                                <td>{{ $trx->customer->nama ?? '-' }}</td>
                                <td>{{ $trx->service->nama ?? '-' }}</td>
                                <td> Kg</td>
                            
                                <td>
                                    <span class="badge badge-modern 
                                        ">
                                        
                                    </span>
                                </td>
                            
                                <td>
                                    <span class="badge badge-modern 
                                        ">
                                        
                                    </span>
                                </td>
                            
                                <td>
                            
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">%</span>
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar bg-primary" style="width: 0%"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Belum ada transaksi aktif
                                </td>
                            </tr>
                          
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@stop

@section('css')
<style>
    /* Modern Card Styles */
    .modern-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .modern-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .modern-card .card-body {
        padding: 24px;
    }

    .card-subtitle {
        font-size: 13px;
        color: #8392a5;
        margin-bottom: 8px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-number {
        font-size: 32px;
        font-weight: 700;
        margin: 8px 0;
        color: #2c3e50;
    }

    .card-info {
        font-size: 13px;
        color: #8392a5;
        margin: 0;
    }

    .icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-wrapper i {
        font-size: 24px;
    }

    /* Background Colors */
    .bg-primary-light {
        background-color: rgba(78, 115, 223, 0.1);
    }
    .bg-warning-light {
        background-color: rgba(246, 194, 62, 0.1);
    }
    .bg-success-light {
        background-color: rgba(28, 200, 138, 0.1);
    }
    .bg-info-light {
        background-color: rgba(54, 185, 204, 0.1);
    }

    /* Card Gradients */
    .card-transaksi {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .card-transaksi .card-subtitle,
    .card-transaksi .card-info,
    .card-transaksi .card-number {
        color: white;
    }
    .card-transaksi .icon-wrapper {
        background-color: rgba(255,255,255,0.2);
    }
    .card-transaksi .icon-wrapper i {
        color: white;
    }

    /* Modern Table Card */
    .modern-table-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .modern-table-card .card-header {
        background: white;
        padding: 20px 24px;
    }

    .modern-table {
        margin: 0;
    }

    .modern-table thead th {
        border-top: none;
        border-bottom: 2px solid #f0f3f5;
        color: #8392a5;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 24px;
    }

    .modern-table tbody td {
        padding: 16px 24px;
        vertical-align: middle;
        border-top: 1px solid #f0f3f5;
        font-size: 14px;
    }

    .modern-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Service Icon */
    .service-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    /* Modern Badges */
    .badge-modern {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    .badge-modern i {
        font-size: 6px;
        margin-right: 6px;
    }

    .badge-warning {
        background-color: rgba(246, 194, 62, 0.1);
        color: #f6c23e;
    }

    .badge-success {
        background-color: rgba(28, 200, 138, 0.1);
        color: #1cc88a;
    }

    .badge-info {
        background-color: rgba(54, 185, 204, 0.1);
        color: #36b9cc;
    }

    .badge-success-solid {
        background-color: #1cc88a;
        color: white;
    }

    .badge-warning-solid {
        background-color: #f6c23e;
        color: white;
    }

    .badge-danger-solid {
        background-color: #e74a3b;
        color: white;
    }

    /* Progress Bar */
    .progress {
        height: 6px;
        border-radius: 10px;
        background-color: #e9ecef;
    }

    .progress-bar {
        border-radius: 10px;
    }

    /* Chart Card */
    .modern-chart-card,
    .modern-stats-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .modern-chart-card .card-header,
    .modern-stats-card .card-header {
        background: white;
        padding: 20px 24px;
    }

    /* Stats Item */
    .stat-item {
        padding: 0;
    }

    .stat-label {
        font-size: 13px;
        color: #8392a5;
        font-weight: 500;
    }

    .stat-value {
        font-size: 18px;
        font-weight: 700;
    }

    .progress-sm {
        height: 4px;
    }

    /* Content Header */
    .content-header h1 {
        font-size: 28px;
        font-weight: 700;
        color: #2c3e50;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(function () {
        var ctx = document.getElementById('revenueChart').getContext('2d');
        
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(78, 115, 223, 0.2)');
        gradient.addColorStop(1, 'rgba(78, 115, 223, 0)');
        
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                
                datasets: [{
                    label: 'Pendapatan (Ribu Rp)',

                    borderColor: '#4e73df',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#4e73df',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#4e73df',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#2c3e50',
                        bodyColor: '#8392a5',
                        borderColor: '#e9ecef',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.parsed.y + 'K';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0f3f5',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#8392a5',
                            callback: function(value) {
                                return 'Rp ' + value + 'K';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#8392a5'
                        }
                    }
                }
            }
        });
    });
</script>
@stop
