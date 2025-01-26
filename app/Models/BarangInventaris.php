<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangInventaris extends Model
{
    protected $table = 'tm_barang_inventaris';
    protected $primaryKey = 'br_kode';
    protected $keyType = 'string';
    
    
    public $timestamps = false;

    protected $fillable = [
        'br_kode',
        'jns_brg_kode',
        'user_id',
        'br_nama',
        'br_tgl_terima',
        'br_tgl_entry',
        'br_status',
    ];

    // Relasi ke DetailPeminjamanBarang
    public function PeminjamanBarang()
    {
        return $this->hasMany(TdPeminjamanBarang::class, 'br_kode', 'br_kode');
    }

    public function jenisBarang()
    {
        return $this->belongsTo(TrJenisBarang::class, 'jns_brg_kode', 'jns_brg_kode');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
