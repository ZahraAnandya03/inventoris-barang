<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TmUser extends Model
{
    protected $table = 'tm_user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'user_nama',
        'user_pass',
        'user_hak',
        'user_sts',
    ];

    // Relasi ke Peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'user_id', 'user_id');
    }

    // Relasi ke Pengembalian
    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class, 'user_id', 'user_id');
}
}