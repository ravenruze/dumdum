<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;

class SapiController extends Controller
{
    public function index(){
        $sapis = Sapi::all();
        return view('sapis.index', ['sapis' => $sapis]);
        
    }

    public function create(){
        return view('sapis.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
        'kode_sapi'  => 'required',
        'jenis_sapi' => 'required',
        'bobot'      => 'required|numeric',
        'harga_jual' => 'required|numeric',
        'status'     => 'required',
        'foto_path'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // PROSES FOTO:
    if ($request->hasFile('foto_path')) {
        // 1. Simpan file fisiknya ke storage/app/public/sapi_images
        $path = $request->file('foto_path')->store('sapi_images', 'public');
        
        // 2. Timpa isi 'foto_path' dengan alamat string-nya saja
        $validatedData['foto_path'] = $path;
    }

    // SIMPAN KE DATABASE (Isinya sekarang sudah aman karena string semua)
    Sapi::create($validatedData);

    return redirect()->route('sapi.index');
    }
}
