<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sapi;

class PesananController extends Controller
{
    public function create(Sapi $sapi)
    {
        if ($sapi->status !== 'Tersedia') {
            return redirect()->route('sapi.index')->with('error', 'Sapi ini tidak tersedia');
        }

        return view('pesanans.create', compact('sapi')); //sama dengan ['sapi' => $sapi]
    }
}
