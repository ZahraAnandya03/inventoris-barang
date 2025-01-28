<?php

namespace App\Http\Controllers;

use App\Models\tm_peminjaman;
use App\Models\tm_pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = tm_pengembalian::with('peminjaman')->get();
        return view('pengembalian.index', compact('pengembalian'));
    }


    public function create()
    {
        $peminjaman = tm_peminjaman::where('pb_stat', 1)->whereNotIn('pb_id', function ($query) {
            $query->select('pb_id')->from('tm_pengembalians');
        })->get();
        return view('pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $peminjaman = tm_peminjaman::where('pb_id', $request->pb_id)->with(['peminjamanBarang', 'pengembalian'])->first();

        $dataterakhir = tm_pengembalian::orderBy('created_at', 'desc')->first();
        if ($dataterakhir == null) {
            $kembali_id = 'KB' . date('Ym') . 001;
        } else {
            $kembali_id = 'KB' . (substr($dataterakhir->pb_id, 2) + 1);
        }

        foreach ($peminjaman->peminjamanBarang as $peminjamanBarang) {
            $peminjamanBarang->pdb_sts = 0;
            $peminjamanBarang->save();
        }
        tm_pengembalian::create([
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
        $pengembalian = tm_pengembalian::findOrFail($id);
        return view('pengembalian.edit', compact('pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kembali_tgl' => 'required|date',
            'kembali_sts' => 'required|in:01,02,03',
        ]);

        $pengembalian = tm_pengembalian::findOrFail($id);
        $pengembalian->update($request->only(['kembali_tgl', 'kembali_sts']));

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        tm_pengembalian::findOrFail($id)->delete();
        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
