<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function create(Pesanan $pesanan)
    {
        // Hitung total yang sudah dibayar
        $totalDibayar = $pesanan->pembayarans->sum('jumlah_bayar');
        
        // Hitung sisa bayar
        $sisaBayar = $pesanan->sapi->harga_jual - $totalDibayar;

        return view('pembayarans.create', compact('pesanan', 'totalDibayar', 'sisaBayar'));
    }
}