<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Penjualan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Rekap Penjualan</h1>

    {{-- DATE PICKER --}}
    <form method="GET" action="{{ route('laporan.index') }}">
        <label>Dari:</label>
        <input type="date" name="dari" value="{{ $dari }}">
        <label>Sampai:</label>
        <input type="date" name="sampai" value="{{ $sampai }}">
        <button type="submit">Filter</button>
        <a href="{{ route('laporan.index', ['semua' => true]) }}"> Tampilkan Semua Data</a>
    </form>

    {{-- RINGKASAN SESUAI FILTER --}}
    <h2>{{ $semuaData ? 'Ringkasan Semua Data' : 'Ringkasan ' . $dari . ' s/d ' . $sampai }}</h2>
    <p>Sapi Terjual  : {{ $sapiTerjualFilter }} ekor</p>
    <p>Pemasukan     : Rp{{ number_format($pemasukanFilter, 0, ',', '.') }}</p>

    {{-- PIE CHART --}}
    <h2>Komposisi Stok Sapi</h2>
    <div style="max-width: 300px;">
        <canvas id="pieChart"></canvas>
    </div>
    <script>
        new Chart(document.getElementById('pieChart'), {
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

    {{-- BAR CHART OMSET --}}
    <h2>
        Omset {{ $semuaData ? 'Total' : $dari . ' s/d ' . $sampai }}
        @if(!$semuaData)
            — <a href="{{ route('laporan.index', ['semua' => true]) }}">Total</a>
        @endif
    </h2>
    <div style="max-width: 600px;">
        <canvas id="barChart"></canvas>
    </div>
    <script>
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($labelHari) !!},
                datasets: [{
                    label: 'Omset (Rp)',
                    data: {!! json_encode($dataOmset) !!},
                    backgroundColor: '#4c9b77',
                }]
            },
            options: {
                scales: {
                    y: {
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>

    {{-- REKAP KESELURUHAN --}}
    <hr style="margin: 30px 0;">
    <h2>Rekap Keseluruhan</h2>
    <p>Total Sapi Terjual  : {{ $totalTerjual }} ekor</p>
    <p>Total Pemasukan     : Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
    <p>Sisa Stok           : {{ $totalTersedia + $totalDipesan }} ekor</p>

    {{-- TABEL DETAIL PENJUALAN --}}
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
                <td colspan="4" style="text-align:center;">Belum ada penjualan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- LAPORAN STOK AKHIR --}}
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
                <td colspan="4" style="text-align:center;">Tidak ada stok tersedia.</td>
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sapiDipesan as $pesanan)
            <tr>
                <td>#{{ $pesanan->sapi->kode_sapi }}</td>
                <td>{{ $pesanan->sapi->jenis_sapi }}</td>
                <td>Rp{{ number_format($pesanan->sapi->harga_jual, 0, ',', '.') }}</td>
                <td>{{ $pesanan->pembeli->nama }}</td>
                <td>
                    @if($pesanan->status_pembayaran == 'Lunas')
                        <span style="color:green;">LUNAS</span>
                    @else
                        <span style="color:red;">BELUM LUNAS</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('pesanan.show', $pesanan->id) }}">Lihat Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;">Tidak ada sapi dipesan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>
</body>
</html>