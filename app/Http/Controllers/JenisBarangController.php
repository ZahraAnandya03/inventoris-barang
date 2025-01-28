<?php

namespace App\Http\Controllers;

use App\Models\tr_jenis_barang;
use Illuminate\Http\Request;
use App\Models\TrJenisBarang;

class JenisBarangController extends Controller
{
    public function index()
    {
        $jenis = tr_jenis_barang::all();
        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        return view('jenis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jns_brg_kode' => 'required|unique:tr_jenis_barangs|max:10',
            'jns_brg_nama' => 'required|max:255'
        ]);

        tr_jenis_barang::create([
            'jns_brg_kode' => $request->jns_brg_kode,
            'jns_brg_nama' => $request->jns_brg_nama,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis Barang berhasil ditambahkan.');
    }

    public function edit($jeni)
    {
        // Gunakan jns_brg_kode sebagai primary key
        $jenis = tr_jenis_barang::findOrFail($jeni);

        // Kirim data 'jenis' ke view
        return view('jenis.edit', compact('jenis'));
    }

    public function update(Request $request, $jeni)
    {
        $request->validate([
            'jns_brg_nama' => 'required|max:255'
        ]);

        $jenis = tr_jenis_barang::where('jns_brg_kode', $jeni)->firstOrFail();
        $jenis->update([
            'jns_brg_nama' => $request->jns_brg_nama,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis Barang berhasil diperbarui.');
    }

    public function destroy($jeni)
    {
        try {
            // Cari berdasarkan jns_brg_kode dan hapus
            tr_jenis_barang::findOrFail($jeni)->delete();
            return redirect()->route('jenis.index')->with('success', 'Jenis Barang berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jenis.index')->with('error', 'Gagal menghapus jenis barang.');
        }
    }
}
