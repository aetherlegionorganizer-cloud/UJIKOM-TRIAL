<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = [
        'kode_pengembalian',
        'peminjaman_id',
        'user_id',
        'petugas_id',
        'tgl_kembali_real',
        'terlambat_hari',
        'denda_terlambat',
        'kondisi_alat',
        'denda_kerusakan',
        'total_denda',
        'status_denda',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
