<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'kode_peminjaman',
        'user_id',
        'alat_id',
        'petugas_id',
        'jumlah',
        'tgl_pinjam',
        'tgl_kembali_rencana',
        'status',
        'keperluan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id', 'id');
    }
}
