<style>
    /* General Styling */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f1f5f9;
        overflow-x: hidden;
        margin: 0;
        padding: 0;
    }

    /* Sidebar Styling */
    .sidebar {
        height: 100vh;
        width: 300px;
        background: #3a63c2;
        color: #fff;
        position: fixed;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
        transition: width 0.3s ease-in-out;
    }

    .sidebar h3 {
        padding: 20px;
        text-align: center;
        background-color: #3D3D3D;
        margin: 0;
        font-size: 1.8rem;
        font-weight: bold;
        letter-spacing: 1px;
        color: #fafafa;
    }

    .sidebar a {
        color: #cbd5e1;
        text-decoration: none;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        font-size: 20px;
        transition: background-color 0.3s, transform 0.2s;
    }

    .sidebar a i {
        margin-right: 15px;
        font-size: 18px;
    }

    .sidebar a:hover {
        background-color: #334155;
        color: #38bdf8;
        transform: translateX(10px);
    }

    .collapse a {
        font-size: 0.9rem;
        margin-left: 20px;
    }

    /* Navbar Styling */
    .navbar {
        background-color: #e2e8f0;
        padding: 10px 30px;
        margin-left: 260px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .breadcrumb {
        margin-bottom: 0;
    }

    .navbar .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .navbar .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover; /* Agar gambar tetap proporsional */
    }
    .navbar .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .navbar .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Content Styling */
    .content {
        margin-left: 260px;
        padding: 30px;
        background-color: #f8fafc;
        min-height: 100vh;
        transition: margin-left 0.3s ease-in-out;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card-gradient {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
    }

    .section-title {
        margin-top: 40px;
        margin-bottom: 20px;
        font-size: 1.5rem;
        font-weight: bold;
        color: #1e293b;
    }

    /* Footer Styling */
    footer {
        margin-left: 260px;
        background-color: #e2e8f0;
        color: black;
        text-align: center;
        padding: 10px;
        position: relative;
        bottom: 0;
    }
/* Sidebar Styling */
.sidebar {
height: 100vh;
width: 260px;
background: #3a63c2;
color: #fff;
position: fixed;
top: 0;
left: 0;
display: flex;
flex-direction: column;
}

/* Header dalam Sidebar */
.sidebar h3 {
padding: 20px;
text-align: center;
background-color: #3a63c2;
margin: 0 10px; /* Memberikan jarak ke kiri-kanan */
font-size: 1.5rem;
color: #ffffff;
border-radius: 5px; /* Membuat sudut lebih halus */
}

/* Link dalam Sidebar */
.sidebar a {
color: #94a3b8;
text-decoration: none;
padding: 15px 20px;
margin: 5px 10px; /* Memberikan jarak antar link */
display: flex;
align-items: center;
font-size: 1rem;
transition: background-color 0.3s, color 0.3s;
border-radius: 5px; /* Membuat sudut tombol lebih halus */
}

.sidebar a i {
margin-right: 15px; /* Ruang antara ikon dan teks */
font-size: 1.2rem; /* Ikon lebih besar */
}

/* Hover effect untuk Link */
.sidebar a:hover {
background-color: #334155;
color: #38bdf8;
}

/* Sub-menu Links */
.sidebar .collapse a {
padding-left: 40px; /* Jarak lebih dalam untuk sub-menu */
font-size: 0.9rem; /* Ukuran lebih kecil untuk sub-menu */
}

/* Sub-menu Links Margin */
.sidebar .collapse a {
margin: 3px 15px; /* Jarak antar sub-menu link */
}
.btn-prima {
background-color: #f31313; /* Warna biru custom */
color: #ffffff;
border: none;
padding: 4px 8px;
box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
transition: all 0.3s ease;
}

.btn-prima:hover {
background-color: #1d4ed8; /* Warna lebih gelap saat hover */
box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
}


</style>