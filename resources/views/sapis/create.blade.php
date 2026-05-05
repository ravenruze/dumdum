<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sapi - Istana Qurban</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f6fa;
            color: #222;
            padding: 40px 20px;
        }

        .container {
            background: #efefef; 
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            position: relative;
        }

        .modal-title {
            color: #4c9b77; 
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .alert {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
            border: 1px solid #f5c6cb;
        }

        /* Layout Baris Horizontal */
        .f-row { 
            display: flex; 
            align-items: center; 
            margin-bottom: 12px; 
        }

        .f-row label { 
            width: 110px; 
            font-size: 13px; 
            font-weight: bold;
            color: #333;
        }

        .f-input { 
            flex: 1; 
            padding: 8px; 
            border: 1px solid #ccc; 
            font-size: 13px; 
            outline: none; 
            border-radius: 4px; 
            background: #fff;
        }

        .f-input:focus {
            border-color: #4c9b77;
        }

        /* Box Preview Placeholder */
        .photo-placeholder {
            width: 100%;
            height: 150px;
            background: #fff;
            border: 1px solid #ccc;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            color: #ddd;
            font-size: 50px;
        }

        .btn-simpan {
            background: #d1e7dd;
            border: 1px solid #4c9b77;
            color: #1e4d2b;
            padding: 12px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            text-transform: uppercase;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .btn-simpan:hover {
            background: #4c9b77;
            color: white;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            font-size: 12px;
            color: #666;
            font-weight: bold;
        }

        .section-label {
            font-size: 12px; 
            font-weight: bold; 
            display: block; 
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="modal-title">Tambah Data Sapi</h2>

    {{-- Error Handling --}}
    @if ($errors->any())
        <div class="alert">
            <ul style="margin-left: 15px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sapi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="section-label">Preview Foto :</label>
        <div class="photo-placeholder">
            <span>📷</span>
        </div>

        <label class="section-label">Upload Foto :</label>
        <input type="file" name="foto_path" accept="image/*" style="font-size:11px; margin-bottom:20px; width: 100%;">

        <div class="f-row">
            <label>Kode :</label>
            <input type="text" name="kode_sapi" class="f-input" placeholder="#SP-000" value="{{ old('kode_sapi') }}" required>
        </div>

        <div class="f-row">
            <label>Berat (kg) :</label>
            <input type="number" name="bobot" class="f-input" placeholder="0" value="{{ old('bobot') }}" required>
        </div>

        <div class="f-row">
            <label>Jenis :</label>
            <input type="text" name="jenis_sapi" class="f-input" placeholder="Contoh: Limousin" value="{{ old('jenis_sapi') }}" required>
        </div>

        <div class="f-row">
            <label>Harga :</label>
            <input type="number" name="harga_jual" class="f-input" placeholder="Rp." value="{{ old('harga_jual') }}" required>
        </div>


        <button type="submit" class="btn-simpan">Simpan Sapi</button>
        <a href="{{ route('sapi.index') }}" class="btn-back">KEMBALI KE KATALOG</a>
    </form>
</div>

</body>
</html>