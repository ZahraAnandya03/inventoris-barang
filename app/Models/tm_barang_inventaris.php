<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tm_barang_inventaris extends Model
{
    use HasFactory;

    protected $table = 'tm_barang_inventaris';
    protected $primaryKey = 'br_kode';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function jenisBarang()
    {
        return $this->belongsTo(tr_jenis_barang::class, 'jns_brg_kode', 'jns_brg_kode');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id', 'user_id');
    }

    public function peminjamanBarang()
    {
        return $this->hasMany(td_peminjaman_barang::class, 'br_kode', 'br_kode');
    }
}
