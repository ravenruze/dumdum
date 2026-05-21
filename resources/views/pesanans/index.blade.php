@extends('layout.app')
@section('title', 'Daftar Pesanan - Istana Qurban')
@section('content')

    <style>

        .container {
            width: 95%;
            margin:  20px auto;
        }

        h1 {
            color: #1e4d2b;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* --- ALERT SUCCESS --- */
        .alert-success {
            background: #d1e7dd;
            color: #1e4d2b;
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #4c9b77;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        /* --- TABLE STYLING --- */
        .table-container {
            background: #fff;
            border-radius: 8px;
            overflow-x: auto; /* PERUBAHAN: Mengaktifkan scroll horizontal jika layar sempit */
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: 1px solid #ddd;
            -webkit-overflow-scrolling: touch; /* Mengaluskan scroll di perangkat iOS */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            background-color: #fff;
            min-width: 600px; /* PERUBAHAN: Menjaga struktur kolom agar tidak terlalu berhimpitan di HP */
        }

        thead {
            background-color: #4c9b77; 
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 12px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            color: #444;
            opacity: 1 !important; 
        }

        tr:hover td {
            background-color: #f2f2f2;
        }

        /* --- STATUS BADGE --- */
        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
            white-space: nowrap; /* TAMBAHAN: Biar teks status tidak pecah jadi 2 baris di mobile */
        }

        .status-booking { background: #e53e3e; color: white; }
        .status-lunas { background: #4bd18e; color: white; }
        .status-batal { background: #e53e3e; color: white; }

        /* --- BUTTONS --- */
        .btn-detail {
            text-decoration: none;
            background: #f8f9fa;
            color: #1e4d2b;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            border: 1px solid #ccc;
            display: inline-block;
            white-space: nowrap; /* TAMBAHAN: Biar tombol aksi tetap sejajar rapi */
        }

        .btn-detail:hover {
            background: #4c9b77;
            color: white;
            border-color: #4c9b77;
        }

        .btn-back {
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
            color: #666;
            font-weight: bold;
            font-size: 13px;
        }

        .btn-back:hover {
            color: #1e4d2b;
        }

        /* --- RESPONSIVE CSS QUERY UNTUK MOBILE VIA MEDIA --- */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 0 10px;
                box-sizing: border-box;
            }

            h1 {
                font-size: 22px; /* Mengecilkan ukuran judul agar muat di screen kecil */
                margin-bottom: 15px;
            }

            th, td {
                padding: 12px 10px; /* Sedikit mempersempit padding biar hemat ruang */
                font-size: 13px;
            }
        }
    </style>

<div class="container">
    <h1>Daftar Pesanan</h1>

    @if(session()->has('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama Pembeli</th>
                    <th>No HP</th>
                    <th>Kode Sapi</th>
                    <th>Harga Jual</th>
                    <th>Status Pembayaran</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanans as $pesanan)
                <tr>
                    <td style="font-weight: bold;">{{ $pesanan->pembeli->nama }}</td>
                    <td>{{ $pesanan->pembeli->no_hp }}</td>
                    <td><code style="background: #eee; padding: 2px 5px; border-radius: 3px;">#{{ $pesanan->sapi->kode_sapi }}</code></td>
                    <td style="font-weight: bold;">Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge 
                            @if($pesanan->status_pembayaran == 'Lunas') status-lunas 
                            @else status-booking 
                            @endif">
                            @if($pesanan->status_pembayaran == 'Lunas') LUNAS
                            @else BELUM LUNAS
                            @endif
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('pesanan.show', $pesanan->id) }}" class="btn-detail">LIHAT DETAIL</a>
                    </td>
                </tr>
                @endforeach

                @if($pesanans->isEmpty())
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: #999;">Belum ada pesanan masuk.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>

@endsection