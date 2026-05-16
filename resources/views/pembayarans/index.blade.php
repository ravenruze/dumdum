<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pembayaran</title>
</head>
<body>
    <h1>Daftar Pembayaran</h1>

    @if(session()->has('success'))
        <div>{{ session('success') }}</div>
    @endif

    @foreach($pesanans as $pesanan)
    <div style="margin-bottom: 30px; border: 1px solid #ccc; padding: 15px;">
        
        
        <h3>{{ $pesanan->pembeli->nama }} — Sapi #{{ $pesanan->sapi->kode_sapi }}</h3>
        <p>Harga Sapi: Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</p>
        <p>Status Pembayaran: 
            @if($pesanan->status_pembayaran == 'Lunas')
                <span style="color: green; font-weight: bold;">LUNAS</span>
            @else
                <span style="color: red; font-weight: bold;">BELUM LUNAS</span>
            @endif
        </p>

        <table style="width:100%; margin-top:10px;">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Jumlah Bayar</th>
                    <th>Sisa Bayar</th>
                    <th>Bukti</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan->pembayarans as $pembayaran)
                <tr>
                    <td>{{ $pembayaran->tanggal_transaksi }}</td>
                    <td>{{ $pembayaran->tipe }}</td>
                    <td>Rp{{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($pembayaran->sisa_bayar, 0, ',', '.') }}</td>
                    <td>
                        @if($pembayaran->foto_bukti)
                            <a href="{{ asset('storage/' . $pembayaran->foto_bukti) }}" target="_blank">Lihat Foto</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    @endforeach

    <a href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>
</body>
</html>