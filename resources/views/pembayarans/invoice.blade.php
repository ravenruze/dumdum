<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 13px; color: #222; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { font-size: 22px; margin-bottom: 5px; }
        .header p { color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 8px 10px; border: 1px solid #ddd; }
        th { background: #f0f0f0; }
        .total-row { font-weight: bold; }
        .footer { margin-top: 40px; text-align: center; color: #888; font-size: 11px; }
        .status { 
            display: inline-block; 
            padding: 4px 10px; 
            border-radius: 4px;
            font-weight: bold;
        }
        .lunas { background: #d4edda; color: #155724; }
        .belum { background: #fff3cd; color: #856404; }
    </style>
</head>
<body>

    <div class="header">
        <h1>ISTANA QURBAN</h1>
        <p>Invoice Pembayaran</p>
        <p>Tanggal Cetak: {{ now()->format('d M Y') }}</p>
    </div>

    <table>
        <tr>
            <td><strong>Nama Pembeli</strong></td>
            <td>{{ $pesanan->pembeli->nama }}</td>
        </tr>
        <tr>
            <td><strong>No HP</strong></td>
            <td>{{ $pesanan->pembeli->no_hp }}</td>
        </tr>
        <tr>
            <td><strong>Alamat</strong></td>
            <td>{{ $pesanan->pembeli->alamat }}</td>
        </tr>
        <tr>
            <td><strong>Kode Sapi</strong></td>
            <td>#{{ $pesanan->sapi->kode_sapi }}</td>
        </tr>
        <tr>
            <td><strong>Harga Sapi</strong></td>
            <td>Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h3 style="margin-top: 25px;">Riwayat Pembayaran</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Jumlah Bayar</th>
                <th>Sisa Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan->pembayarans as $pembayaran)
            <tr>
                <td>{{ $pembayaran->tanggal_transaksi }}</td>
                <td>{{ $pembayaran->tipe }}</td>
                <td>Rp{{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($pembayaran->sisa_bayar, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="2">Total Dibayar</td>
                <td>Rp{{ number_format($totalDibayar, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($sisaBayar, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 20px;">
        Status: 
        <span class="status {{ $pesanan->status_pembayaran == 'Lunas' ? 'lunas' : 'belum' }}">
            {{ $pesanan->status_pembayaran == 'Lunas' ? '✅ LUNAS' : '⚠️ BELUM LUNAS' }}
        </span>
    </p>

    <div class="footer">
        <p>Dokumen ini dicetak otomatis oleh Sistem Istana Qurban</p>
        <p>Terima kasih atas kepercayaan Anda</p>
    </div>

</body>
</html>