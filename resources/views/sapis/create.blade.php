<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sapi</title>

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
            background: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background: #0069d9;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Tambah Data Sapi</h1>

    {{-- Error Handling --}}
    @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sapi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Kode Sapi</label>
        <input type="text" name="kode_sapi" required>

        <label>Jenis Sapi</label>
        <input type="text" name="jenis_sapi" required>

        <label>Bobot (kg)</label>
        <input type="number" name="bobot" required>

        <label>Harga Jual</label>
        <input type="number" name="harga_jual" required>

        <label>Status</label>
        <select name="status">
            <option value="Tersedia">Tersedia</option>
            <option value="Booking">Booking</option>
            <option value="Terjual">Terjual</option>
        </select>

        <label>Foto</label>
        <input type="file" name="foto_path" accept="image/*">

        <button type="submit" class="btn">Simpan Sapi</button>

    </form>

</div>

</body>
</html>