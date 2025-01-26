<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmPeminjaman extends Model
{
    protected $table = 'tm_peminjaman';
    protected $primaryKey = 'pb_id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'pb_id',
        'user_id',
        'pb_tgl',
        'pb_no_siswa',
        'pb_nama_siswa',
        'pb_harus_kembali_tgl',
        'pb_stat',
    ];

    // Relasi ke DetailPeminjamanBarang
    public function tdPeminjamanBarang()
    {
        return $this->hasMany(TdPeminjamanBarang::class, 'pb_id', 'pb_id');
    }

    // Relasi ke Pengembalian
    public function pengembalian()
    {
        return $this->hasOne(TmPengembalian::class, 'pb_id', 'pb_id');
    }

    // Relasi ke User
    public function user()
    { 
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
