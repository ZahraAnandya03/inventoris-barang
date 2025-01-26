<?php

namespace App\Http\Controllers;

use App\Models\TmPeminjaman;
use App\Models\TmPengembalian;
use App\Models\BarangInventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = TmPengembalian::with('peminjaman')->get();
        return view('pengembalian.index', compact('pengembalian'));
    }


    public function create()
    {
        $peminjaman = TmPeminjaman::whereNotIn('pb_id', function ($query) {
            $query->select('pb_id')->from('tm_pengembalian');
        })->get();
        return view('pengembalian.create', compact('peminjaman'));
    }
    // git init
    // git add .
    // git commit -m "first commit"
    // git branch -M main
    // git remote add origin https://github.com/ZahraAnandya03/inventoris-barang.git
    // git push -u origin main
    public function store(Request $request)
    {
        $peminjaman = TmPeminjaman::where('pb_id', $request->pb_id)->with(['peminjamanBarang', 'pengembalian'])->first();

        $dataterakhir = TmPeminjaman::orderBy('created_at', 'desc')->first();
        if ($dataterakhir == null) {
            $kembali_id = 'KB' . date('Ym') . 001;
        } else {
            $kembali_id = 'KB' . (substr($dataterakhir->pb_id, 2) + 1);
        }

        foreach ($peminjaman->peminjaman as $peminjaman) {
            $peminjaman->pdb_sts = 0;
            $peminjaman->save();
        }
        


        TmPengembalian::create([
            'kembali_id' => $kembali_id,
            'pb_id' => $request->pb_id,
            'user_id' => Auth::user()->user_id,
            'kembali_tgl' => date('Y-m-d'),
            'kembali_sts' => 1,
        ]);


        return redirect()->back()->with('success', 'Berhasil mengembalikan barang');
    }


    public function edit($id)
    {
        $pengembalian = TmPengembalian::findOrFail($id);
        return view('pengembalian.edit', compact('pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kembali_tgl' => 'required|date',
            'kembali_sts' => 'required|in:01,02,03',
        ]);

        $pengembalian = TmPengembalian::findOrFail($id);
        $pengembalian->update($request->only(['kembali_tgl', 'kembali_sts']));

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        TmPengembalian::findOrFail($id)->delete();
        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
