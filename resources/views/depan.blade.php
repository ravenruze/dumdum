<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .card {
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Sistem Pencatatan Istana Qurban</h1>

    <div class="container">
       <div class="card" onclick="window.location.href='{{ route('sapi.index') }}'">
        Katalog Sapi
    </div>
        <div class="card">Registrasi dan Booking</div>
        <div class="card">Pembayaran dan Keuangan</div>
        <div class="card">Rekap Penjualan</div>
    </div>

   <div style="display: flex; gap: 20px; max-width: 600px; margin: 20px auto 0;">
    <div class="card" style="flex: 1;">
        <p style="color: #888; margin: 0;">Sapi Tersedia</p>
        <p style="font-size: 1.8rem; font-weight: bold; color: green; margin: 8px 0;">{{ $totalTersedia }}</p>
        <p style="color: #aaa; margin: 0; font-size: 0.9rem;">dari {{ $totalTersedia + $totalTerjual + $totalDipesan }} ekor</p>
    </div>
    <div class="card" style="flex: 1;">
        <p style="color: #888; margin: 0;">Sapi Dipesan</p>
        <p style="font-size: 1.8rem; font-weight: bold; color: orange; margin: 8px 0;">{{ $totalDipesan }}</p>
        <p style="color: #aaa; margin: 0; font-size: 0.9rem;">dari {{ $totalTersedia + $totalTerjual + $totalDipesan }} ekor</p>
    </div>
    <div class="card" style="flex: 1;">
        <p style="color: #888; margin: 0;">Sapi Terjual</p>
        <p style="font-size: 1.8rem; font-weight: bold; color: red; margin: 8px 0;">{{ $totalTerjual }}</p>
        <p style="color: #aaa; margin: 0; font-size: 0.9rem;">dari {{ $totalTersedia + $totalTerjual + $totalDipesan }} ekor</p>
    </div>
</div>
</body>
</html>