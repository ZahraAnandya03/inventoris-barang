<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tm_peminjaman extends Model
{
    use HasFactory;

    protected $table = 'tm_peminjamans';
    protected $primaryKey = 'pb_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id', 'user_id');
    }

    public function peminjamanBarang()
    {
        return $this->hasMany(td_peminjaman_barang::class, 'pb_id', 'pb_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(tm_pengembalian::class, 'pb_id', 'pb_id');
    }
}
