<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrudController extends Controller
{
    // // Menampilkan daftar barang
    // public function index()
    // {
    //     $barang = BarangInventaris::all();
    //     return redirect()->route('barang.create');
    // }

    // // Menampilkan daftar barang
    // public function show($id)
    // {
    //     $barang = BarangInventaris::findOrFail($id);
    //     return view('barang.index', compact('barang'));
    // }

    // // Menampilkan form input barang
    // public function create()
    // {
    //     return view('crudmasuk.barang_masuk');
    // }

    // // Menyimpan data barang ke database
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'br_nama' => 'required|max:50',
    //         'br_tgl_terima' => 'required|date',
    //         'br_status' => 'required|max:2',
    //     ]);

    // //   dd(date('d-m-Y'));
    //     BarangInventaris::create([
    //         'br_kode' => 'br-'. date('d') .  rand(111, 999),
    //         'jns_brg_kode' => 1,
    //         'user_id' => Auth::user()->user_id,
    //         'br_nama' => $request->br_nama,
    //         'br_tgl_terima' => $request->br_tgl_terima,
    //         'br_tgl_entry' => date(now()),
    //         'br_status' => $request->br_status,
    //     ]);
    
    //     return redirect('barang-inventaris')->with('success', 'Barang berhasil ditambahkan.');
    // }
    

    // // Menghapus data barang
    // public function destroy(BarangInventaris $barang)
    // {
    //     // $barang = BarangInventaris::findOrFail($id); // Mencari barang berdasarkan ID
    //     $barang->delete(); // Menghapus barang

    //     return redirect()->route('barang-inventaris')->with('success', 'Barang berhasil dihapus.');
    // }


}