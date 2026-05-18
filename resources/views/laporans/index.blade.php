<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Penjualan</title>
    {{-- Chart.js untuk pie chart --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Rekap Penjualan</h1>

    {{-- 1. RINGKASAN HARI INI --}}
    <h2>Hari Ini</h2>
    <p>Sapi Terjual  : {{ $sapiterjualHariIni }} ekor</p>
    <p>Pemasukan     : Rp{{ number_format($pemasukanHariIni, 0, ',', '.') }}</p>

    {{-- 2. PIE CHART --}}
    <h2>Komposisi Stok Sapi</h2>
    <canvas id="pieChart" width="300" height="300"></canvas>
    <script>
        const ctx = document.getElementById('pieChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Tersedia', 'Dipesan', 'Terjual'],
                datasets: [{
                    data: [{{ $totalTersedia }}, {{ $totalDipesan }}, {{ $totalTerjual }}],
                    backgroundColor: ['#38b2ac', '#f6ad55', '#e53e3e'],
                }]
            }
        });
    </script>

    {{-- 3. REKAP KESELURUHAN --}}
    <h2>Rekap Keseluruhan</h2>
    <p>Total Sapi Terjual  : {{ $totalTerjual }} ekor</p>
    <p>Total Pemasukan     : Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
    <p>Sisa Stok           : {{ $totalTersedia + $totalDipesan }} ekor</p>

    {{-- 4. TABEL DETAIL PENJUALAN --}}
    <h2>Detail Penjualan</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Kode Sapi</th>
                <th>Nama Pembeli</th>
                <th>Harga Sapi</th>
                <th>Total Dibayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penjualans as $pesanan)
            <tr>
                <td>#{{ $pesanan->sapi->kode_sapi }}</td>
                <td>{{ $pesanan->pembeli->nama }}</td>
                <td>Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($pesanan->pembayarans->sum('jumlah_bayar'), 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Belum ada penjualan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 5. LAPORAN STOK AKHIR --}}
    <h2>Stok Tersedia</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Kode Sapi</th>
                <th>Jenis</th>
                <th>Bobot</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sapiTersedia as $sapi)
            <tr>
                <td>#{{ $sapi->kode_sapi }}</td>
                <td>{{ $sapi->jenis_sapi }}</td>
                <td>{{ $sapi->bobot }} kg</td>
                <td>Rp{{ number_format($sapi->harga_jual, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Tidak ada stok tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Sapi Dipesan</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Kode Sapi</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Nama Pembeli</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sapiDipesan as $pesanan)
            <tr>
                <td>#{{ $pesanan->sapi->kode_sapi }}</td>
                <td>{{ $pesanan->sapi->jenis_sapi }}</td>
                <td>Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</td>
                <td>{{ $pesanan->pembeli->nama }}</td>
                <td>{{ $pesanan->status_pembayaran }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Tidak ada sapi dipesan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>
</body>
</html>