@extends('layout.app')
@section('title', 'Katalog Sapi - Istana Qurban')
@section('content')

    <style>

        /* --- LAYOUT --- */

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .card {
            background: #fdfdfd;
            border: 1px solid #e0e0e0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .card-image {
            width: 100%;
            height: 160px;
            background: #eee;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .card-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .id-text {
            font-size: 18px;
            font-weight: 600;
            color: #000;
        }

        .status-badge {
            padding: 4px 10px;
            font-size: 11px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
        }

        .status-available { background-color: #38b2ac; }
        .status-booking { background-color: #f6ad55; }
        .status-sold { background-color: #e53e3e; }

        .card-description {
            font-size: 16px;
            font-weight: 500;
            color: #000;
            margin-bottom: 15px;
        }

        .price-text {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            margin-bottom: 12px;
        }

        /* --- ACTIONS (Tombol) --- */
        .actions {
            display: flex;
            gap: 5px;
            flex-wrap: wrap; 
        }

        .btn-minimal {
            background: #e0e0e0;
            border: 1px solid #ccc;
            color: #333;
            padding: 6px 12px;
            font-size: 11px;
            font-weight: bold;
            text-decoration: none;
            text-transform: uppercase;
            cursor: pointer;
            text-align: center;
            min-width: 60px; 
        }

        .btn-minimal:hover {
            background: #d5d5d5;
        }

        form {
            display: inline;
        }
        
        .active-filter {
            background: #1e4d2b;
            color: white;
            border-color: #1e4d2b;
        }

        .container {
            max-width: 100%;
            width: 100%;
            padding: 0 20px;
        }

        nav[aria-label="Pagination Navigation"] svg {
            width: 14px;
            height: 14px;
        }

        nav[aria-label="Pagination Navigation"] a,
        nav[aria-label="Pagination Navigation"] span {
            padding: 6px 10px;
            font-size: 12px;
            border: 1px solid #ccc;
            background: #e0e0e0;
            color: #333;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        nav[aria-label="Pagination Navigation"] span[aria-current="page"] {
            background: #1e4d2b;
            color: white;
            border-color: #1e4d2b;
        }
            </style>

<div class="container">

    <h1 class="garis-bawah-judul">KATALOG SAPI</h1>

    <div class="top-bar">
        <a href="{{ route('sapi.create') }}" class="btn-add">+ TAMBAH SAPI</a>
    </div>

    <div style="display: flex; gap: 8px; margin-bottom: 20px;">
        <a href="{{ route('sapi.index') }}" 
        class="btn-minimal {{ !request('filter') ? 'active-filter' : '' }}">SEMUA</a>
        <a href="{{ route('sapi.index', ['filter' => 'Tersedia']) }}" 
        class="btn-minimal {{ request('filter') == 'Tersedia' ? 'active-filter' : '' }}">AVAILABLE</a>
        <a href="{{ route('sapi.index', ['filter' => 'Booking']) }}" 
        class="btn-minimal {{ request('filter') == 'Booking' ? 'active-filter' : '' }}">BOOKING</a>
        <a href="{{ route('sapi.index', ['filter' => 'Terjual']) }}" 
        class="btn-minimal {{ request('filter') == 'Terjual' ? 'active-filter' : '' }}">SOLD</a>
    </div>

    <div class="grid">
        @foreach($sapis as $sapi)
            <div class="card">
                <div class="card-image">
                    @if($sapi->foto_path)
                        <img src="{{ asset('storage/' . $sapi->foto_path) }}" alt="Foto Sapi">
                    @else
                        <div style="height:100%; display:flex; align-items:center; justify-content:center; color:#999; font-size: 12px;">No Image</div>
                    @endif
                </div>

                <div class="card-body">
                    <div class="card-header-row">
                        <div class="id-text">#{{ $sapi->kode_sapi }}</div>
                        <span class="status-badge 
                            @if($sapi->status == 'Tersedia') status-available 
                            @elseif($sapi->status == 'Booking') status-booking 
                            @else status-sold 
                            @endif">
                            @if($sapi->status == 'Tersedia') AVAILABLE
                            @elseif($sapi->status == 'Terjual') SOLD
                            @else {{ strtoupper($sapi->status) }}
                            @endif
                        </span>
                    </div>

                    <div class="card-description">
                        {{ $sapi->jenis_sapi }} • {{ $sapi->bobot }} kg
                    </div>

                    <div class="price-text">
                        RP{{ number_format($sapi->harga_jual, 0, ',', '.') }}
                    </div>

                    <div class="actions">
                        <a href="{{ route('sapi.edit', $sapi->id) }}" class="btn-minimal">EDIT</a>
                        
                         @if($sapi->status == 'Tersedia')
                        <a href="{{ route('pesanan.create', $sapi->id) }}" class="btn-minimal">PESAN</a>
                        @endif
                        <form method="POST" action="{{ route('sapi.destroy', $sapi->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-minimal" onclick="return confirm('Hapus data?')">
                                HAPUS
                            </button>
                        </form>
                        
                    
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div style="margin-top: 20px; display: flex; justify-content: center;">
        {{ $sapis->appends(request()->query())->links() }}
    </div>

</div>

@endsection