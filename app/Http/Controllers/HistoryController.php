<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
{
    $barangMasuk = History::where('jenis_aktivitas', 'Masuk')->get();
    $barangKeluar = History::where('jenis_aktivitas', 'Keluar')->get();

    return view('barang.daftar', compact('barangMasuk', 'barangKeluar'));
}



}
