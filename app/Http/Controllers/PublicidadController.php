<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Publicidad;
use Illuminate\Support\Facades\Auth;

class PublicidadController extends Controller
{
    public function index()
    {
        $publicidad = Publicidad::all();
        return view('publicidad.index')
            ->with('publicidad', $publicidad); 
    }

    public function show($id)
    {
        $publicidad = Publicidad::findOrFail($id);
        return view('publicidad.show')
            ->with('publicidad', $publicidad); 
    }
    public function create()
    {
        return view('publicidad.create');
    }
}