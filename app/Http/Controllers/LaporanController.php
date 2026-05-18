<?php

namespace App\Http\Controllers;

use App\Models\Sapi;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // ── RINGKASAN HARI INI ──
        // Ambil dari tabel pembayarans, filter tanggal hari ini
        $sapiterjualHariIni = Pesanan::whereDate('updated_at', today())
                                ->where('status_pembayaran', 'Lunas')
                                ->count();

        $pemasukanHariIni = Pembayaran::whereDate('tanggal_transaksi', today())
                                ->sum('jumlah_bayar');

        // ── PIE CHART ──
        // Hitung jumlah sapi per status → dikirim ke view sebagai angka
        $totalTersedia = Sapi::where('status', 'Tersedia')->count();
        $totalDipesan  = Sapi::where('status', 'Booking')->count();
        $totalTerjual  = Sapi::where('status', 'Terjual')->count();

        // ── REKAP KESELURUHAN ──
        // Total semua pembayaran yang masuk
        $totalPemasukan = Pembayaran::sum('jumlah_bayar');

        // ── TABEL DETAIL PENJUALAN ──
        // Ambil pesanan yang sudah Lunas, sekalian bawa data pembeli + sapi + pembayaran
        $penjualans = Pesanan::with(['pembeli', 'sapi', 'pembayarans'])
                        ->where('status_pembayaran', 'Lunas')
                        ->get();

        // ── LAPORAN STOK AKHIR ──
        // Sapi yang masih Tersedia
        $sapiTersedia = Sapi::where('status', 'Tersedia')->get();

        // Sapi yang Dipesan + nama pembelinya
        $sapiDipesan = Pesanan::with(['pembeli', 'sapi'])
                        ->where('status', 'Booking')
                        ->get();

        return view('laporans.index', compact(
            'sapiterjualHariIni',
            'pemasukanHariIni',
            'totalTersedia',
            'totalDipesan',
            'totalTerjual',
            'totalPemasukan',
            'penjualans',
            'sapiTersedia',
            'sapiDipesan'
        ));
    }
}