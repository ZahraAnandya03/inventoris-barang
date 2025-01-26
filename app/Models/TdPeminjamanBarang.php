<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TdPeminjamanBarang extends Model
{
    protected $table = 'td_peminjaman_barang';
    protected $primaryKey = 'pbd_id';
    public $timestamps = false;

    protected $fillable = [
        'pbd_id',
        'pb_id',
        'br_kode',
        'pdb_tgl',
        'pdb_sts',
    ];

    // Relasi ke BarangInventaris
    public function barangInventaris()
    {
        return $this->belongsTo(BarangInventaris::class, 'br_kode', 'br_kode');
    }

    // Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(TmPeminjaman::class, 'pb_id', 'pb_id');
}
}