<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>
</head>
<body>
    <h1>Detail Pesanan</h1>

    <h3>Informasi Pembeli</h3>
    <p>Nama   : {{ $pesanan->pembeli->nama }}</p>
    <p>No HP  : {{ $pesanan->pembeli->no_hp }}</p>
    <p>Alamat : {{ $pesanan->pembeli->alamat }}</p>

    <h3>Informasi Sapi</h3>
    @if($pesanan->sapi->foto_path)
        <img src="{{ asset('storage/' . $pesanan->sapi->foto_path) }}" width="200px" alt="Foto Sapi">
    @else
        <p>Tidak ada foto</p>
    @endif
    <p>Kode Sapi : {{ $pesanan->sapi->kode_sapi }}</p>
    <p>Jenis     : {{ $pesanan->sapi->jenis_sapi }}</p>
    <p>Bobot     : {{ $pesanan->sapi->bobot }} kg</p>
    <p>Harga     : Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</p>

    <h3>Status Pesanan</h3>
    <p>{{ $pesanan->status }}</p>

    <a href="{{ route('pesanan.index') }}">← Kembali ke Daftar Pesanan</a>
</body>
</html>