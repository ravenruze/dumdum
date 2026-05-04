<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Sapi - Istana Qurban</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f6fa;
            color: #222;
        }

        /* --- NAVBAR --- */
        .navbar {
            background-color: #d1e7dd; 
            padding: 12px 4%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 1000;
            color: #1e4d2b;
            text-transform: uppercase;
            font-size: 18px;
        }

        .navbar-brand img {
            height: 45px;
            width: auto;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links a {
            text-decoration: none;
            color: #444;
            font-weight: 800;
            font-size: 14px;
        }

        .nav-links a.active {
            color: #1e4d2b;
            border-bottom: 2px solid #1e4d2b;
            padding-bottom: 5px;
        }

        /* --- LAYOUT --- */
        .container {
            width: 95%;
            margin: 20px auto;
        }

        h1 {
            margin-bottom: 15px;
            font-size: 28px;
            font-weight: 800;    
            color: #1e4d2b;      
        }

        .top-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn-add {
            text-decoration: none;
            background: #4c9b77;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .card {
            background: #fdfdfd;
            border: 1px solid #e0e0e0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card-image {
            width: 100%;
            height: 160px;
            background: #eee;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .card-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .id-text {
            font-size: 18px;
            font-weight: 600;
            color: #000;
        }

        .status-badge {
            padding: 4px 10px;
            font-size: 11px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
        }

        .status-available { background-color: #38b2ac; }
        .status-booking { background-color: #f6ad55; }
        .status-sold { background-color: #e53e3e; }

        .card-description {
            font-size: 16px;
            font-weight: 500;
            color: #000;
            margin-bottom: 15px;
        }

        .price-text {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin-bottom: 12px;
        }

        /* --- ACTIONS (Tombol) --- */
        .actions {
            display: flex;
            gap: 5px;
            flex-wrap: wrap; 
        }

        .btn-minimal {
            background: #e0e0e0;
            border: 1px solid #ccc;
            color: #333;
            padding: 6px 12px;
            font-size: 11px;
            font-weight: bold;
            text-decoration: none;
            text-transform: uppercase;
            cursor: pointer;
            text-align: center;
            min-width: 60px; 
        }

        .btn-minimal:hover {
            background: #d5d5d5;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="navbar-brand">
        <img src="{{ asset('img/logo-istana-qurban.png') }}" alt="Logo Istana Qurban"> 
        <span>Istana Qurban</span>
    </div>
    <div class="nav-links">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="#" class="active">Katalog Sapi</a>
        <a href="#">Registrasi & Booking</a>
        <a href="#">Transaksi</a>
        <a href="#">Laporan</a>
    </div>
    <div class="user-profile">👤</div>
</nav>

<div class="container">

    <h1>Katalog Sapi</h1>

    <div class="top-bar">
        <a href="{{ route('sapi.create') }}" class="btn-add">+ TAMBAH SAPI</a>
    </div>

    <div class="grid">
        @foreach($sapis as $sapi)
            <div class="card">
                <div class="card-image">
                    @if($sapi->foto_path)
                        <img src="{{ asset('storage/' . $sapi->foto_path) }}" alt="Foto Sapi">
                    @else
                        <div style="height:100%; display:flex; align-items:center; justify-content:center; color:#999; font-size: 12px;">No Image</div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="card-header-row">
                        <div class="id-text">#{{ $sapi->kode_sapi }}</div>
                        <span class="status-badge 
                            @if($sapi->status == 'Tersedia') status-available 
                            @elseif($sapi->status == 'Booking') status-booking 
                            @else status-sold 
                            @endif">
                            @if($sapi->status == 'Tersedia') AVAILABLE
                            @elseif($sapi->status == 'Terjual') SOLD
                            @else {{ strtoupper($sapi->status) }}
                            @endif
                        </span>
                    </div>

                    <div class="card-description">
                        {{ $sapi->jenis_sapi }} • {{ $sapi->bobot }} kg
                    </div>

                    <div class="price-text">
                        RP{{ number_format($sapi->harga_jual, 0, ',', '.') }}
                    </div>

                    <div class="actions">
                        <a href="{{ route('sapi.edit', $sapi->id) }}" class="btn-minimal">EDIT</a>
                        
                        <form method="POST" action="{{ route('sapi.destroy', $sapi->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-minimal" onclick="return confirm('Hapus data?')">
                                HAPUS
                            </button>
                        </form>
                        
                    
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>