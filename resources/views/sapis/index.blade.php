<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Sapi</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f6fa;
            color: #222;
        }

        .container {
            width: 92%;
            margin: 30px auto;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 34px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn-add {
            text-decoration: none;
            background: #2ecc71;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-add:hover {
            background: #27ae60;
        }

        .success-msg {
            background: #d4edda;
            color: #155724;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 22px;
        }

        .card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .card-image {
            width: 100%;
            height: 180px;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            color: #888;
            font-size: 14px;
        }

        .card-body {
            padding: 15px;
        }

        .status {
            display: inline-block;
            background: #f1c40f;
            color: #333;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .card-title {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .card-info {
            margin-bottom: 6px;
            color: #555;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin: 10px 0 14px;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn {
            border: none;
            padding: 8px 14px;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-edit {
            background: #3498db;
            color: white;
        }

        .btn-detail {
            background: #95a5a6;
            color: white;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Katalog Sapi</h1>

    @if(session()->has('success'))
        <div class="success-msg">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">
        <div></div>
        <a href="{{ route('sapi.create') }}" class="btn-add">+ Tambah Sapi</a>
    </div>

    <div class="grid">
        @foreach($sapis as $sapi)
            <div class="card">

                <div class="card-image">
                    @if($sapi->foto_path)
                        <img src="{{ asset('storage/' . $sapi->foto_path) }}" alt="Foto Sapi">
                    @else
                        <span class="no-image">Tidak ada foto</span>
                    @endif
                </div>

                <div class="card-body">

                    <span class="status">{{ $sapi->status }}</span>

                    <div class="card-title">{{ $sapi->kode_sapi }}</div>

                    <div class="card-info">Jenis: {{ $sapi->jenis_sapi }}</div>
                    <div class="card-info">Bobot: {{ $sapi->bobot }} kg</div>

                    <div class="price">
                        Rp{{ number_format($sapi->harga_jual, 0, ',', '.') }}
                    </div>

                    <div class="actions">
                        <a href="{{ route('sapi.edit', $sapi->id) }}" class="btn btn-edit">Edit</a>

                        <form method="POST" action="{{ route('sapi.destroy', ['sapi' => $sapi]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>

</body>
</html>