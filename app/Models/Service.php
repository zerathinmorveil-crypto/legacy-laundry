<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_service',
        'harga_per_kg', 
        'deskripsi',
        'status'
    ];

    protected $casts = [
        'harga_per_kg' => 'decimal:2',
        'status' => 'string'
    ];
}