<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tambah Sapi</h1>
    <div class="alert alert-danger"> 
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
    <form action="{{route('sapi.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('post')
    <div>
        <label>Kode Sapi:</label>
        <input type="text" name="kode_sapi" required>
    </div>

    <div>
        <label>Jenis Sapi:</label>
        <input type="text" name="jenis_sapi" required>
    </div>

    <div>
        <label>Bobot (kg):</label>
        <input type="number" name="bobot" required>
    </div>

    <div>
        <label>Harga Jual:</label>
        <input type="number" name="harga_jual" required>
    </div>

    <div>
        <label>Status:</label>
        <select name="status">
            <option value="Tersedia">Tersedia</option>
            <option value="Booking">Booking</option>
            <option value="Terjual">Terjual</option>
        </select>
    </div>

    <div>
        <label>Foto:</label>
        <input type="file" name="foto_path" accept="image/*">
    </div>

    <button type="submit">Simpan Sapi</button>
</form>
    </form>
</body>
</html>