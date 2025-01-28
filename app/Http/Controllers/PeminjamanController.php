<?php

namespace App\Http\Controllers;

use App\Models\td_peminjaman_barang;
use Illuminate\Http\Request;
use App\Models\tm_peminjaman;
use App\Models\tm_barang_inventaris;
use App\Models\TdPeminjamanBarang;
use App\Models\tm_pengembalian;
use App\Models\TmPengembalian;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Tampilkan daftar peminjaman.
     */
    public function index()
    {
        $data['peminjamans'] = tm_peminjaman::with('pengembalian')->get();
        $data['belumKembali'] = td_peminjaman_barang::where('pdb_sts', 1)->get();
        return view('peminjaman.index', $data);
    }

    /**
     * Tampilkan form tambah peminjaman.
     */
    public function create()
    {
        return view('peminjaman.create');
    }

    /**
     * Simpan data peminjaman ke database.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'pb_nama_siswa' => 'required',
            'pb_no_siswa' => 'required',
            'pb_tgl' => 'required|date',
            'pb_harus_kembali_tgl' => 'required|date',
            // 'pb_stat' => 'required',
        ]);

        // Ambil tahun dan bulan saat ini
        $tahun = now()->format('Y');
        $bulan = now()->format('m'); // Format bulan 2 digit

        // Ambil peminjaman terakhir yang dibuat pada bulan dan tahun yang sama
        $lastPeminjaman = tm_peminjaman::whereYear('pb_tgl', $tahun)
            ->whereMonth('pb_tgl', $bulan)
            ->orderBy('pb_id', 'desc')
            ->first();

        $noUrut = 1;
        if ($lastPeminjaman) {
            // Ambil nomor urut dari ID transaksi peminjaman terakhir
            $lastNoUrut = (int)substr($lastPeminjaman->pb_id, -3);
            $noUrut = $lastNoUrut + 1;
        }

        // Format nomor urut dengan 3 digit
        $noUrutFormatted = str_pad($noUrut, 3, '0', STR_PAD_LEFT);

        // Buat ID transaksi dengan format PJ+TAHUN+BULAN+NO_URUT
        $pbId = 'PJ' . $tahun . $bulan . $noUrutFormatted;

        // Menyimpan data peminjaman baru
        tm_peminjaman::create([
            'pb_id' => $pbId,
            'user_id' => Auth::id(),
            'pb_nama_siswa' => $request->pb_nama_siswa,
            'pb_no_siswa' => $request->pb_no_siswa,
            'pb_tgl' => $request->pb_tgl,
            'pb_harus_kembali_tgl' => $request->pb_harus_kembali_tgl,
            'pb_stat' => 1,
        ]);

        // Arahkan user ke halaman pilih barang setelah data peminjaman disimpan
        return redirect()->route('peminjaman.pilihBarang', ['pb_id' => $pbId]);
    }

    /**
     * Tampilkan form pilih barang untuk peminjaman.
     */
    public function pilihBarang($pb_id)
    {
        $peminjaman = tm_peminjaman::findOrFail($pb_id);

        // Ambil barang yang tersedia (tidak dipinjam)
        $barangTersedia = tm_barang_inventaris::whereDoesntHave('peminjamanBarang', function ($q) {
            $q->where('pdb_sts', 1);
        })->orWhereDoesntHave('peminjamanBarang')->get();
        // dd($barangTersedia);

        return view('peminjaman.pilih_barang', compact('peminjaman', 'barangTersedia'));
    }

    public function simpanBarang(Request $request, $pb_id)
    {
        // dd($request->all());
        $dataterakhir = td_peminjaman_barang::orderBy('created_at', 'desc')->first();
        if ($dataterakhir == null) {
            $pbid = $request->pb_id . 001;
        } else {
            $pbid = (substr($dataterakhir->pb_id, 2) + 1);
        }

        foreach ($request->barang_ids as $id) {
            td_peminjaman_barang::create([
                'pbd_id' => 'PJ' . $pbid,
                'pb_id' => $request->pb_id,
                'br_kode' => $id,
                'pdb_tgl' => date('Y-m-d'),
                'pdb_sts' => 1,
            ]);
            $pbid++;
        }

        tm_peminjaman::where('pb_id', $request->pb_id)->update(['pb_stat' => 1]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disimpan.');
    }

    // Fungsi untuk generate pbd_id
    private function generatePbdId()
    {
        // Gunakan logika Anda untuk generate pbd_id (misalnya menggunakan timestamp)
        return 'PBD' . time(); // Contoh menggunakan timestamp sebagai ID
    }

    public function barangBelumKembali()
    {
        // Ambil data barang yang masih dipinjam (status '01')
        $barangBelumKembali = td_peminjaman_barang::where('pdb_sts', '01')
            ->with(['barang', 'peminjaman']) // Relasi ke tabel barang dan peminjaman
            ->get();

        return view('peminjaman.barang_belum_kembali', compact('barangBelumKembali'));
    }

    public function pengembalian(Request $request, $pb_id)
    {
        // Validasi input
        $request->validate([
            'kembali_tgl' => 'required|date',
        ]);

        // Temukan peminjaman berdasarkan pb_id
        $peminjaman = tm_peminjaman::findOrFail($pb_id);

        // Cek jika semua barang sudah dikembalikan
        $tdPeminjamanBarang = td_peminjaman_barang::where('pb_id', $pb_id)->where('pdb_sts', '01')->get();

        if ($tdPeminjamanBarang->isEmpty()) {
            return redirect()->route('peminjaman.index')->with('error', 'Tidak ada barang yang dipinjam untuk dikembalikan.');
        }

        // Update status pengembalian untuk setiap barang
        foreach ($tdPeminjamanBarang as $barang) {
            // Perbarui status barang menjadi "kembali"
            tm_barang_inventaris::where('br_kode', $barang->br_kode)->update(['br_status' => 'tersedia']);

            // Perbarui status peminjaman barang menjadi selesai
            $barang->update(['pdb_sts' => '02']); // Status '02' berarti sudah dikembalikan
        }

        // Simpan data pengembalian
        tm_pengembalian::create([
            'pb_id' => $pb_id,
            'kembali_tgl' => $request->kembali_tgl,
            'kembali_sts' => 1, // status pengembalian sukses
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Barang berhasil dikembalikan!');
    }


    /**
     * Tampilkan form edit peminjaman.
     */
    public function edit($id)
    {
        $peminjaman = tm_peminjaman::findOrFail($id);
        return view('peminjaman.edit', compact('peminjaman'));
    }

    /**
     * Update data peminjaman di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pb_tgl' => 'required|date',
            'pb_no_siswa' => 'required|max:20',
            'pb_nama_siswa' => 'required|max:100',
            'pb_harus_kembali_tgl' => 'required|date',
            'pb_stat' => 'required|in:01,02',
        ]);

        $peminjaman = tm_peminjaman::findOrFail($id);
        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    /**
     * Hapus data peminjaman dari database.
     */
    public function destroy($id)
    {
        $peminjaman = tm_peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
