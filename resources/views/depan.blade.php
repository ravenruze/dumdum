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

    <h1>Selamat Datang di Pencatatan Istana Qurban!</h1>

    <div class="container">
        <div class="card">Katalog Sapi</div>
        <div class="card">Registrasi dan Booking</div>
        <div class="card">Pembayaran dan Keuangan</div>
        <div class="card">Rekap Penjualan</div>
    </div>

</body>
</html>