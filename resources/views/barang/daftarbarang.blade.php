<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Import SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @include('barang.style')
</head> 
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Inventaris Apps</h3>
        <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a>
        <a href="#barang-inventaris" data-bs-toggle="collapse"><i class="fas fa-boxes"></i> Barang Inventaris</a>
        <div id="barang-inventaris" class="collapse show">
            <a href="{{route('barang.index')}}" class="ms-3"><i class="fas fa-list"></i> Daftar Barang</a>
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


    <!-- Content -->
    <div class="content">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h1 class="mb-4">Daftar Barang</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data History Barang</h5>
        
                <!-- Menu Tab -->
                {{-- <ul class="nav nav-tabs" id="activityTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="masuk-tab" data-bs-toggle="tab" data-bs-target="#masuk" type="button" role="tab" aria-controls="masuk" aria-selected="true">
                            Barang Masuk
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="keluar-tab" data-bs-toggle="tab" data-bs-target="#keluar" type="button" role="tab" aria-controls="keluar" aria-selected="false">
                            Barang Keluar
                        </button>
                    </li>
                </ul> --}}

                <!-- Isi Tab -->
                <div class="tab-content mt-4" id="activityTabContent">
                    <!-- Tab Barang Masuk -->
                    <div class="tab-pane fade show active" id="masuk" role="tabpanel" aria-labelledby="masuk-tab">
                        <table class="table table-bordered table-hover mt-3">
                            <thead class="table" style="background-color: #2563eb; color:#f8fafc">
                                <tr>
                                    <th>Kode</th>
                                    <th>Jenis Barang</th>
                                    <th>User Id</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal Terima</th>
                                    <th>Tanggal Entry</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $index => $barang)
                                <tr>
                                    <td>{{ $barang->br_kode }}</td>
                                    <td>{{ $barang->jenisBarang->jns_brg_nama }}</td>
                                    <td>{{ $barang->user_id }}</td>
                                    <td>{{ $barang->br_nama }}</td>
                                    <td>{{ $barang->br_tgl_terima }}</td>
                                    <td>{{ $barang->br_tgl_entry }}</td>
                                    <td>{{ $barang->br_status == 1 ? 'Aktif' : 'Tidak Aktif '}}</td>
                                    <td class="d-flex">
                                        <!-- Tombol Hapus -->
                                        <button type="button" class="btn btn-danger btn-sm me-2" onclick="confirmDelete('{{ $barang->br_kode }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
    
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                            onclick="onEdit('{{ $barang->br_kode }}', '{{ $barang->br_nama }}', '{{ $barang->br_tgl_terima }}', '{{ $barang->br_tgl_entry }}', '{{ $barang->br_status }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Tab Barang Keluar -->
                    {{-- <div class="tab-pane fade" id="keluar" role="tabpanel" aria-labelledby="keluar-tab">
                        <table class="table table-bordered table-hover mt-3">
                            <thead class="table" style="background-color: #2563eb; color:#f8fafc">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Aktivitas</th>
                                    <th>Tanggal</th>
                                    <th>Pengguna</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Contoh data statis Barang Keluar -->
                                <tr>
                                    <td>1</td>
                                    <td>Printer Canon</td>
                                    <td>Keluar</td>
                                    <td>2025-01-12</td>
                                    <td>User B</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> --}}
                </div>
            </div>
        </div>    
    </div>

    <!-- Modal Edit Barang -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="br_kode" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" id="br_kode" name="br_kode" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="br_nama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="br_nama" name="br_nama">
                        </div>
                        <div class="mb-3">
                            <label for="br_tgl_terima" class="form-label">Tanggal Terima</label>
                            <input type="date" class="form-control" id="br_tgl_terima" name="br_tgl_terima">
                        </div>
                        <div class="mb-3">
                            <label for="br_tgl_entry" class="form-label">Tanggal Entry</label>
                            <input type="date" class="form-control" id="br_tgl_entry" name="br_tgl_entry">
                        </div>
                        <div class="mb-3">
                            <label for="br_status" class="form-label">Status</label>
                            <select class="form-control" id="br_status" name="br_status">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>                                      
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Sistem Inventaris Barang. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi konfirmasi penghapusan dengan SweetAlert2
        function confirmDelete(br_kode) {
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
                    form.action = '{{ route('barang.destroy', '') }}/' + br_kode;
                    
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
            function onEdit(br_kode, br_nama, br_tgl_terima, br_tgl_entry, br_status) {
            console.log("Kode:", br_kode);
            console.log("Nama:", br_nama);
            console.log("Tanggal Terima:", br_tgl_terima);
            console.log("Tanggal Entry:", br_tgl_entry);
            console.log("Status:", br_status);

            // Pastikan input diisi dengan nilai yang benar
            document.getElementById('br_kode').value = br_kode ?? '';
            document.getElementById('br_nama').value = br_nama ?? '';
            document.getElementById('br_tgl_terima').value = br_tgl_terima ?? '';
            document.getElementById('br_tgl_entry').value = br_tgl_entry ?? '';
            document.getElementById('br_status').value = br_status ?? '1'; // Default ke 'Aktif'

            // Ubah action form agar sesuai dengan route update
            let form = document.getElementById('editForm');
            form.setAttribute('action', '{{ route("barang.update", "") }}/' + br_kode);
        }


    </script>
</body>
</html>
