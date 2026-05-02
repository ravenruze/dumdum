<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit</h1>
    <div class="alert alert-danger"> 
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
<form action="{{route('sapi.update', ['sapi' => $sapi->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div>
        <label>Kode Sapi:</label>
        <input type="text" name="kode_sapi" value= "{{$sapi -> kode_sapi}}" required >
    </div>

    <div>
        <label>Jenis Sapi:</label>
        <input type="text" name="jenis_sapi" value= "{{$sapi -> jenis_sapi}}" required>
    </div>

    <div>
        <label>Bobot (kg):</label>
        <input type="number" name="bobot" value= "{{$sapi -> bobot}}" required>
    </div>

    <div>
        <label>Harga Jual:</label>
        <input type="number" name="harga_jual" value= "{{$sapi -> harga_jual}}" required>
    </div>

    <div>
        <label>Foto:</label>
        <input type="file" name="foto_path" accept="image/*">
    </div>

    <button type="submit">Update Sapi</button>
</form>
</body>
</html>