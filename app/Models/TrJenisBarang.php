<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrJenisBarang extends Model
{
    use HasFactory;

    protected $table = 'tr_jenis_barang';
    protected $primaryKey = 'jns_brg_kode';
    public $timestamps = true;

    protected $fillable = ['jns_brg_kode', 'jns_brg_nama'];
}
