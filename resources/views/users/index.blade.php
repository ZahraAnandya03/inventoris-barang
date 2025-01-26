<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
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
            <a href="{{ route('barang.index')}}" class="ms-3"><i class="fas fa-list"></i> Daftar Barang</a>
            <a href="{{ route('barang.create') }}" class="ms-3"><i class="fas fa-plus-circle"></i> Penerimaan Barang</a>
        </div>
        <a href="#peminjaman-barang" data-bs-toggle="collapse"><i class="fas fa-exchange-alt"></i> Peminjaman Barang</a>
        <div id="peminjaman-barang" class="collapse">
            <a href="{{ route('peminjaman.index')}}" class="ms-3"><i class="fas fa-file-alt"></i> Daftar Peminjaman</a>
            <a href="{{ route('pengembalian.index')}}" class="ms-3"><i class="fas fa-undo"></i> Pengembalian Barang</a>
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
        <h2 class="mb-4">Daftar Pengguna</h2>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Pengguna</a>
        
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Hak Akses</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->user_nama }}</td>
                    <td>{{ $user->user_hak }}</td>
                    <td>{{ $user->user_sts }}</td>
                    <td>
                        <!-- Tombol Hapus -->
                        <button type="button" class="btn btn-sm btn-danger"
                            onclick="confirmDelete('{{ $user->user_id }}')">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Tombol Edit -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editModal"
                            onclick="onEdit('{{ $user->user_id }}')">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <script>
        // Fungsi konfirmasi penghapusan dengan SweetAlert2
        function confirmDelete(pb_id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data peminjaman ini akan dihapus dan tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('peminjaman.destroy', '') }}/' + pb_id;

                    var csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    var methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        //fungsi edit
        function onEdit(pb_id, user_id, nama_siswa, no_siswa, tgl_peminjaman, harus_kembali_tgl, status) {
            // Menyisipkan data yang diterima ke dalam modal
            document.getElementById('editPbId').value = pb_id;
            document.getElementById('editNamaSiswa').value = nama_siswa;
            document.getElementById('editNoSiswa').value = no_siswa;
            document.getElementById('editTanggalPeminjaman').value = tgl_peminjaman;
            document.getElementById('editHarusKembali').value = harus_kembali_tgl;
            document.getElementById('editStatus').value = status;

            // Memperbarui action form edit untuk memanggil update sesuai ID
            let form = document.getElementById('editForm');
            form.setAttribute('action', '{{ url('peminjaman') }}/' + pb_id);
        }
    </script>
</body>
</html>
