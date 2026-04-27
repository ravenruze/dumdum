<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SapiController extends Controller
{
    public function index(){
        return view('sapis.index');
    }

    public function create(){
        return view('sapis.create');
    }
}
