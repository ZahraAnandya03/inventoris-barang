<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'tm_users';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function barangInventaris()
    {
        return $this->hasMany(tm_barang_inventaris::class, 'user_id', 'user_id');
    }

    public function peminjaman()
    {
        return $this->hasMany(tm_peminjaman::class, 'user_id', 'user_id');
    }

    public function pengembalian()
    {
        return $this->hasMany(tm_pengembalian::class, 'user_id', 'user_id');
    }
}
