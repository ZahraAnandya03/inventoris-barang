<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\tm_barang_inventaris;
use App\Models\TrJenisBarang;
use App\Models\TmPeminjaman;
use App\Models\TmPengembalian;
use App\Models\tr_jenis_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangInventarisController extends Controller
{

    public function dashboard()
    {

        return view('barang.index');
    }

    public function index()
    {
        $barang = tm_barang_inventaris::with('jenisBarang')->get();
        // @dd($barang);
        return view('barang.daftarbarang', compact('barang'));
    }


    public function show(tm_barang_inventaris $br_kode)
    {
        $barang = tm_barang_inventaris::findOrFail($br_kode);
        return view('barang.show', compact('barang'));
    }

    public function create()
    {
        $jenis = tr_jenis_barang::all();
        return view('barang.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        // Ambil tahun saat ini
        $tahun = now()->format('Y');

        // Ambil barang terakhir yang dibuat di tahun yang sama
        $lastBarang = tm_barang_inventaris::whereYear('br_tgl_entry', $tahun)
            ->orderBy('br_kode', 'desc')
            ->first();

        // Tentukan nomor urut
        $noUrut = 1;
        if ($lastBarang) {
            // Ambil nomor urut dari kode barang terakhir
            $lastNoUrut = (int)substr($lastBarang->br_kode, -3); // Mengambil 3 digit terakhir dari kode barang
            $noUrut = $lastNoUrut + 1;
        }

        // Format nomor urut dengan 3 digit
        $noUrutFormatted = str_pad($noUrut, 3, '0', STR_PAD_LEFT);

        // Buat kode barang baru dengan format INV+TAHUN+NO_URUT
        $brKode = 'INV' . $tahun . $noUrutFormatted;

        // Validasi input dari form
        $request->validate([
            'br_nama' => 'required|max:50',
            'br_tgl_terima' => 'required|date',
            // 'br_status' => 'required|string|max:2',
        ]);

        // Menyimpan data barang baru
        tm_barang_inventaris::create([
            'br_kode' => $brKode,
            'jns_brg_kode' => $request->br_jns_brg,
            'user_id' => Auth::id(),
            'br_nama' => $request->br_nama,
            'br_tgl_terima' => $request->br_tgl_terima,
            'br_tgl_entry' => now(),
            'br_status' => 1,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit(tm_barang_inventaris $barang)
    {
        return view('barang.edit', compact('barang', 'jenis'));
    }

    // Mengupdate data barang
    public function update(Request $request, $br_kode)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'br_kode' => 'required|string',
            'br_nama' => 'required|string|max:50',
            'br_tgl_terima' => 'required|date',
            'br_tgl_entry' => 'required|date',
            'br_status' => 'required|string',
        ]);

        // Temukan barang berdasarkan ID
        $barang = tm_barang_inventaris::findOrFail($br_kode);

        // Update data barang
        $barang->update([
            'br_kode' => $validated['br_kode'],
            'br_nama' => $validated['br_nama'],
            'br_tgl_terima' => $validated['br_tgl_terima'],
            'br_tgl_entry' => $validated['br_tgl_entry'],
            'br_status' => $validated['br_status'],
        ]);

        // Redirect ke halaman daftar barang dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy(tm_barang_inventaris $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
