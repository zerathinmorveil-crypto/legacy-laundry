<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_member',
        'nama_member',
        'no_hp',
        'email',
        'alamat',
        'jenis_member',
        'diskon',
        'status'
    ];

    protected $casts = [
        'diskon' => 'integer',
        'status' => 'string'
    ];

    // Auto generate kode member
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($member) {
            if (empty($member->kode_member)) {
                $lastMember = self::orderBy('id', 'desc')->first();
                $nextNumber = $lastMember ? (int)substr($lastMember->kode_member, 3) + 1 : 1;
                $member->kode_member = 'MEM' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Accessor untuk warna jenis member
    public function getJenisMemberColorAttribute()
    {
        return match($this->jenis_member) {
            'reguler' => 'badge-info',
            'silver' => 'badge-secondary',
            'gold' => 'badge-warning',
            'platinum' => 'badge-success'
        };
    }
}