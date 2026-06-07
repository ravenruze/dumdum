@extends('layout.app')
@section('title', 'Dashboard - Istana Qurban')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    .dash-wrapper {
        padding: 32px 20px;
    }

    header {
        background: #1e4d2b;
        color: white;
        padding: 32px 36px;
        border-radius: 4px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .header-icon {
        width: 52px;
        height: 52px;
        background: rgba(255,255,255,0.15);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    header h1 {
        font-size: 1.6rem;
        font-weight: 700;
        letter-spacing: -0.3px;
        margin-bottom: 4px;
        color: white;
    }

    header p {
        font-size: 0.88rem;
        opacity: 0.75;
        color: white;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat {
        background: white;
        border-radius: 4px;
        padding: 20px 24px;
        border: 0.5px solid #e0e0e0;
        position: relative;
        overflow: hidden;
    }

    .stat::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 3px;
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .stat-lbl {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #95a5a6;
        font-weight: 700;
    }

    .stat-icon {
        width: 30px; height: 30px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 5px;
        color: #2d3436;
    }

    .stat-sub { font-size: 12px; color: #b2bec3; }

    .available::before { background: #27ae60; }
    .booked::before    { background: #f39c12; }
    .sold::before      { background: #e74c3c; }

    .available .stat-icon { background: #f0faf4; color: #27ae60; }
    .booked .stat-icon    { background: #fdf8ee; color: #f39c12; }
    .sold .stat-icon      { background: #fdf1f1; color: #e74c3c; }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .menu-card {
        background: white;
        border-radius: 4px;
        padding: 22px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        border: 0.5px solid #e0e0e0;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        color: inherit;
    }

    .menu-card:hover {
        border-color: #1e4d2b;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30,77,43,0.08);
    }

    .menu-icon {
        width: 48px; height: 48px;
        background: #eaf7ef;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1e4d2b;
        font-size: 20px;
        flex-shrink: 0;
    }

    .menu-text h3 { font-size: 0.95rem; font-weight: 600; color: #1e4d2b; margin-bottom: 3px; }
    .menu-text p  { font-size: 0.82rem; color: #95a5a6; }

    @media (max-width: 700px) {
        .stats, .menu-grid { grid-template-columns: 1fr; }
    }

        .container {
        max-width: 1200px !important;
        padding: 0 40px !important;
    }
</style>

<div class="dash-wrapper">

    <header>
        <div class="header-icon">
            <i class="ti ti-building-store" style="color:white;font-size:24px"></i>
        </div>
        <div>
            <h1>Istana Qurban</h1>
            <p>Sistem Pencatatan & Manajemen Penjualan Sapi</p>
        </div>
    </header>

    <div class="stats">
        <div class="stat available">
            <div class="stat-top">
                <div class="stat-lbl">Tersedia</div>
                <div class="stat-icon"><i class="ti ti-circle-check"></i></div>
            </div>
            <div class="stat-value">{{ $totalTersedia }}</div>
            <div class="stat-sub">dari {{ $totalTersedia + $totalTerjual + $totalDipesan }} ekor</div>
        </div>
        <div class="stat booked">
            <div class="stat-top">
                <div class="stat-lbl">Dipesan</div>
                <div class="stat-icon"><i class="ti ti-clock"></i></div>
            </div>
            <div class="stat-value">{{ $totalDipesan }}</div>
            <div class="stat-sub">dari {{ $totalTersedia + $totalTerjual + $totalDipesan }} ekor</div>
        </div>
        <div class="stat sold">
            <div class="stat-top">
                <div class="stat-lbl">Terjual</div>
                <div class="stat-icon"><i class="ti ti-tag"></i></div>
            </div>
            <div class="stat-value">{{ $totalTerjual }}</div>
            <div class="stat-sub">dari {{ $totalTersedia + $totalTerjual + $totalDipesan }} ekor</div>
        </div>
    </div>

    <div class="menu-grid">
        <a href="{{ route('sapi.index') }}" class="menu-card">
            <div class="menu-icon"><i class="ti ti-cow"></i></div>
            <div class="menu-text">
                <h3>Katalog Sapi</h3>
                <p>Lihat dan kelola data sapi qurban</p>
            </div>
        </a>
        <a href="{{ route('pesanan.index') }}" class="menu-card">
            <div class="menu-icon"><i class="ti ti-clipboard-list"></i></div>
            <div class="menu-text">
                <h3>Registrasi & Booking</h3>
                <p>Pencatatan data pemesanan sapi</p>
            </div>
        </a>
        <a href="{{ route('pembayaran.index') }}" class="menu-card">
            <div class="menu-icon"><i class="ti ti-receipt"></i></div>
            <div class="menu-text">
                <h3>Transaksi</h3>
                <p>Monitoring pembayaran pelanggan</p>
            </div>
        </a>
        <a href="{{ route('laporan.index') }}" class="menu-card">
            <div class="menu-icon"><i class="ti ti-chart-bar"></i></div>
            <div class="menu-text">
                <h3>Laporan</h3>
                <p>Ringkasan transaksi dan laporan</p>
            </div>
        </a>
    </div>
</div>

@endsection