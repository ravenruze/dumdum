<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Booking</title>
</head>
<body>
    <h1>Form Booking Sapi</h1>

    {{-- Info sapi yang dipilih --}}
    <p>Kode Sapi : {{ $sapi->kode_sapi }}</p>
    <p>Jenis     : {{ $sapi->jenis_sapi }}</p>
    <p>Bobot     : {{ $sapi->bobot }} kg</p>
    <p>Harga     : Rp{{ number_format($sapi->harga_jual, 0, ',', '.') }}</p>

    {{-- Form data pembeli --}}
    <form action="" method="POST">
        @csrf
        <div>
            <label>Nama Pembeli:</label>
            <input type="text" name="nama" required>
        </div>
        <div>
            <label>No HP:</label>
            <input type="text" name="no_hp" required>
        </div>
        <div>
            <label>Alamat:</label>
            <textarea name="alamat" required></textarea>
        </div>
        <button type="submit">Booking Sapi</button>
    </form>

    <a href="{{ route('sapi.index') }}">← Kembali ke Katalog</a>
</body>
</html>