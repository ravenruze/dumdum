<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan</title>
</head>
<body>
    <h1>Daftar Pesanan</h1>

    @if(session()->has('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nama Pembeli</th>
                <th>No HP</th>
                <th>Kode Sapi</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $pesanan)
            <tr>
                <td>{{ $pesanan->pembeli->nama }}</td>
                <td>{{ $pesanan->pembeli->no_hp }}</td>
                <td>{{ $pesanan->sapi->kode_sapi }}</td>
                <td>Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</td>
                <td>{{ $pesanan->status }}</td>
                <td>
                    <a href="{{ route('pesanan.show', $pesanan->id) }}">Lihat Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>
</body>
</html>