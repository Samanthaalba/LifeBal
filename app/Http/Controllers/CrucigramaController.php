<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palabra;

class CrucigramaController extends Controller
{
    public function index()
    {
        $palabras = Palabra::all();
        return view('/juegos/crucigrama', compact('palabras'));
    }
}

