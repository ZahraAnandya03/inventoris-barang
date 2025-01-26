<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jenis Barang</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Import SweetAlert2 -->
    @include('barang.style')
    
    <style>
        /* Gaya Umum */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 960px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h2.text-center {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

/* Alert Success */
.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}

/* Form Styling */
.form-container {
    margin-top: 20px;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-weight: bold;
    font-size: 14px;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ced4da;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

.btn-block {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border-radius: 5px;
    font-weight: bold;
}

/* Responsif */
@media (max-width: 767px) {
    .container {
        margin: 20px;
        padding: 15px;
    }
    .form-container {
        padding: 15px;
    }
}
        
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Inventaris Apps</h3>
        <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a>
        <a href="#barang-inventaris" data-bs-toggle="collapse"><i class="fas fa-boxes"></i> Barang Inventaris</a>
        <div id="barang-inventaris" class="collapse show">
            <a href="{{ route('barang.index') }}" class="ms-3"><i class="fas fa-list"></i> Daftar Barang</a>
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
        <h1 class="mb-4">Daftar Jenis Barang</h1>
        <div class="card">
            <div class="card-body">

        <!-- Alert Success -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    
        <!-- Button Tambah Jenis Barang -->
        <a href="{{ route('jenis.create') }}" class="btn btn-primary mb-4">Tambah Jenis Barang</a>
    
        <!-- Tabel Daftar Jenis Barang -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="bg-primary text-white">no</th>
                    <th class="bg-primary text-white">Kode Jenis Barang</th>
                    <th class="bg-primary text-white">Nama Jenis Barang</th>
                    <th class="bg-primary text-white">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jenis as $index => $jeni)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $jeni->jns_brg_kode }}</td>
                        <td>{{ $jeni->jns_brg_nama }}</td>
    
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-danger btn-sm btn-action"
                                    onclick="confirmDelete('{{ $jeni->jns_brg_kode }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                        
                                <button type="button" class="btn btn-primary btn-sm btn-action"
                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                    onclick="onEdit('{{ $jeni->jns_brg_kode }}', '{{ $jeni->jns_brg_nama }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </td>                                       
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Jenis Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editKode" class="form-label">Kode Jenis Barang</label>
                        <input type="text" class="form-control" id="editKode" name="jns_brg_kode" required readonly>
                    </div>

                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama Jenis Barang</label>
                        <input type="text" class="form-control" id="editNama" name="jns_brg_nama" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/app.js') }}"></script>

<script>
            // Fungsi konfirmasi penghapusan dengan SweetAlert2
            function confirmDelete(jns_brg_kode) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data barang ini akan dihapus dan tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim form penghapusan setelah konfirmasi
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('jenis.destroy', '') }}/' + jns_brg_kode;
                    
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
        function onEdit(jns_brg_kode, jns_brg_nama) {
            console.log("Kode:", jns_brg_kode);
            console.log("Nama:", jns_brg_nama);

            // Pastikan nilai input dalam modal terisi
            document.getElementById('editKode').value = jns_brg_kode;
            document.getElementById('editNama').value = jns_brg_nama;

            // Perbarui action form edit
            let form = document.getElementById('editForm');
            form.setAttribute('action', '{{ url("jenis") }}/' + jns_brg_kode);
        }



</script>

</body>
</html>
