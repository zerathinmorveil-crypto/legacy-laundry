<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'customer_id',
        'service_id',
        'berat',
        'tanggal_masuk',
        'tanggal_ambil',
        'sub_total',
        'diskon',
        'total',
        'total_harga',
        'status',
        'jenis_pembayaran',
        'status_bayar',
        'sumber',
        'catatan',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_ambil' => 'date',
        'berat' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'total' => 'decimal:2',
        'total_harga' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public static function generateKode(): string
    {
        $prefix = 'TRX-' . date('Ymd');
        $last = self::where('kode_transaksi', 'like', $prefix . '%')
                   ->latest('id')
                   ->first();
        
        $number = $last ? (intval(substr($last->kode_transaksi, -4)) + 1) : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    // Badge warna status
    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'      => 'secondary',
            'dikonfirmasi' => 'info',
            'proses'       => 'warning',
            'selesai'      => 'success',
            'diambil'      => 'dark',
            'baru'         => 'primary',
            default        => 'light',
        };
    }

    // Label status
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'      => 'Menunggu Konfirmasi',
            'dikonfirmasi' => 'Dikonfirmasi',
            'proses'       => 'Sedang Diproses',
            'selesai'      => 'Selesai',
            'diambil'      => 'Sudah Diambil',
            'baru'         => 'Baru',
            default        => $this->status,
        };
    }
}