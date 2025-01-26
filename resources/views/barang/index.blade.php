<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Inventaris Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Import SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @include('barang.style')

    <style>
        .card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}

.card-gradient {
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    color: white;
}

.text-primary {
    color: #2563eb;
}

.text-success {
    color: #16a34a;
}

.text-danger {
    color: #dc2626;
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
            <a href="{{ route('users.index') }}" class="ms-3"><i class="fas fa-file"></i> Daftar Pengguna</a>
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
        <h1 class="mb-4">Dashboard</h1>
        <h4 class="mb-4">Inventaris App</h4>
    
        <!-- Grid Layout untuk Card -->
        <div class="row">
            <!-- Total Barang -->
            <div class="col-md-4">
                <div class="card p-3 card-gradient">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-box fa-3x me-3"></i>
                        <div>
                            <h5>Total Barang</h5>
                            <h2>120</h2>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Barang Dipinjam -->
            <div class="col-md-4">
                <div class="card p-3 card-gradient">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exchange-alt fa-3x me-3"></i>
                        <div>
                            <h5>Barang Dipinjam</h5>
                            <h2>30</h2>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Barang Belum Kembali -->
            <div class="col-md-4">
                <div class="card p-3 card-gradient">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock fa-3x me-3"></i>
                        <div>
                            <h5>Belum Kembali</h5>
                            <h2>10</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    <!-- Grafik Statistik -->
                    <div class="row mt-5">
                        <div class="col-md-8 offset-md-2">
                            <div class="card p-4">
                                <h5 class="text-center">Statistik Inventaris</h5>
                                <canvas id="inventoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
    </div>    


    <footer>
        <p>&copy; 2025 Sistem Inventaris Barang. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('inventoryChart').getContext('2d');
            var inventoryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Total Barang', 'Barang Dipinjam', 'Belum Kembali'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [120, 30, 10], // Sesuaikan dengan data dari backend
                        backgroundColor: ['#2563eb', '#f59e0b', '#dc2626'],
                        borderColor: ['#1e40af', '#d97706', '#b91c1c'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    
</body>
</html>
