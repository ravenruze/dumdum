<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Sapi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .alert {
            background: #ffe5e5;
            color: #a10000;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-top: 12px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        input:focus, select:focus {
            border-color: #4a90e2;
            outline: none;
        }

        .btn {
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background: #218838;
        }

        .img-preview {
            margin-top: 10px;
        }

        .img-preview img {
            width: 150px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Data Sapi</h1>

    {{-- Error --}}
    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sapi.update', $sapi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Kode Sapi</label>
        <input type="text" name="kode_sapi" value="{{ old('kode_sapi', $sapi->kode_sapi) }}" required>

        <label>Jenis Sapi</label>
        <input type="text" name="jenis_sapi" value="{{ old('jenis_sapi', $sapi->jenis_sapi) }}" required>

        <label>Bobot (kg)</label>
        <input type="number" name="bobot" value="{{ old('bobot', $sapi->bobot) }}" required>

        <label>Harga Jual</label>
        <input type="number" name="harga_jual" value="{{ old('harga_jual', $sapi->harga_jual) }}" required>

        <label>Status</label>
        <select name="status" required>
            <option value="Tersedia" {{ old('status', $sapi->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="Booking" {{ old('status', $sapi->status) == 'Booking' ? 'selected' : '' }}>Booking</option>
            <option value="Terjual" {{ old('status', $sapi->status) == 'Terjual' ? 'selected' : '' }}>Terjual</option>
        </select>

        <label>Foto</label>
        <input type="file" name="foto_path" accept="image/*">

        @if ($sapi->foto_path)
            <div class="img-preview">
                <p>Foto saat ini:</p>
                <img src="{{ asset('storage/' . $sapi->foto_path) }}" alt="foto sapi">
            </div>
        @endif

        <button type="submit" class="btn">Update Sapi</button>
    </form>

</div>

</body>
</html>