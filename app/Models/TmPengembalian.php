<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmPengembalian extends Model
{
    protected $table = 'tm_pengembalian';
    protected $primaryKey = 'kembali_id';
    public $timestamps = false;

    protected $fillable = [
        'kembali_id',
        'pb_id',
        'user_id',
        'kembali_tgl',
        'kembali_sts',
    ];

    // Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(TmPeminjaman::class, 'pb_id', 'pb_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
}
}