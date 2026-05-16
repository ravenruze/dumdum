<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Pembayaran</title>
</head>
<body>
    <h1>Input Pembayaran</h1>

    <p>Pembeli        : {{ $pesanan->pembeli->nama }}</p>
    <p>Sapi           : #{{ $pesanan->sapi->kode_sapi }}</p>
    <p>Harga          : Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</p>
    <p>Sudah Dibayar  : Rp{{ number_format($totalDibayar, 0, ',', '.') }}</p>
    <p>Sisa Bayar     : Rp{{ number_format($sisaBayar, 0, ',', '.') }}</p>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('pembayaran.store', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Jumlah Bayar:</label>
            <input type="number" name="jumlah_bayar" value="{{ old('jumlah_bayar') }}" required>
        </div>
        <div>
            <label>Foto Bukti Transfer:</label>
            <input type="file" name="foto_bukti" accept="image/*">
        </div>
        <button type="submit">Simpan Pembayaran</button>
    </form>

    <a href="{{ route('pesanan.show', $pesanan->id) }}">← Kembali ke Detail Pesanan</a>
</body>
</html>