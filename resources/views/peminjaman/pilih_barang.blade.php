<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Import SweetAlert2 -->
    @include('barang.style')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Inventaris Apps</h3>
        <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a>
        <a href="#barang-inventaris" data-bs-toggle="collapse"><i class="fas fa-boxes"></i> Barang Inventaris</a>
        <div id="barang-inventaris" class="collapse show">
            <a href="{{ route('barang.index') }}" class="ms-3"><i class="fas fa-list"></i> Daftar Barang</a>
            <a href="{{ route('barang.create') }}" class="ms-3"><i class="fas fa-plus-circle"></i> Penerimaan
                Barang</a>
        </div>
        <a href="#peminjaman-barang" data-bs-toggle="collapse"><i class="fas fa-exchange-alt"></i> Peminjaman Barang</a>
        <div id="peminjaman-barang" class="collapse">
            <a href="{{ route('peminjaman.index') }}" class="ms-3"><i class="fas fa-file-alt"></i> Daftar
                Peminjaman</a>
            <a href="{{ route('pengembalian.index') }}" class="ms-3"><i class="fas fa-undo"></i> Pengembalian
                Barang</a>
            <a href="#barang-belum-kembali" class="ms-3"><i class="fas fa-file-alt"></i> Barang Belum Kembali</a>
        </div>
        <a href="#laporan" data-bs-toggle="collapse"><i class="fas fa-folder-open"></i> Laporan</a>
        <div id="laporan" class="collapse">
            <a href="#laporan-daftar-barang" class="ms-3"><i class="fas fa-folder"></i> Laporan Daftar Barang</a>
            <a href="#laporan-pengembalian-barang" class="ms-3"><i class="fas fa-file"></i> Laporan Pengembalian</a>
            <a href="#laporan-status-barang" class="ms-3"><i class="fas fa-file"></i> Laporan Status Barang</a>
        </div>
        <a href="#referensi" data-bs-toggle="collapse"><i class="fas fa-chart-bar"></i> Referensi</a>
        <div id="referensi" class="collapse">
            <a href="{{ route('jenis.index') }}" class="ms-3"><i class="fas fa-plus"></i> Daftar Jenis Barang</a>
            <a href="#daftar-pengguna" class="ms-3"><i class="fas fa-file"></i> Daftar Pengguna</a>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar d-flex justify-content-between align-items-center">
        <div class="breadcrumb-container">
            <ol class="breadcrumb">
                <h4>Selamat Datang, {{ Auth::user()->user_nama }} </h4>
            </ol>
        </div>
        <div class="d-flex align-items-center gap-3">
            <!-- Search Bar -->
            <div class="search-box">
                <input type="text" class="form-control form-control-sm" placeholder="Cari...">
            </div>

            <!-- Notification Icon -->
            <div class="notification-icon position-relative">
                <i class="fa fa-bell" style="font-size: 24px; cursor: pointer;"></i>
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle">
                    3
                </span>
            </div>

            <!-- User Info -->
            <div class="user-info d-flex align-items-center gap-2">
                <i class="fa fa-user-circle" style="font-size: 40px;"></i>
                <button class="btn btn-outline-danger btn-sm"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container">
            <h2>Pilih Barang untuk Peminjaman #{{ $peminjaman->pb_id }}</h2>
            <form action="{{ route('peminjaman.simpanBarang', $peminjaman->pb_id) }}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Pilih</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangTersedia as $barang)
                        <tr>
                            <td><input type="checkbox" name="barang_ids[]" value="{{ $barang->br_kode }}"></td>
                            <td>{{ $barang->br_kode }}</td>
                            <td>{{ $barang->br_nama }}</td>
                            <td>{{ $barang->br_status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
            </form>
        </div>
    </div>
</body>
</html>
