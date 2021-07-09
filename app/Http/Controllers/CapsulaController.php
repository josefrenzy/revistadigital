<?php

namespace App\Http\Controllers;

use App\Models\Capsula;
use Illuminate\Http\Request;

class CapsulaController extends Controller
{
    public function index()
    {
        $capsula = Capsula::paginate(5);
        return view('capsula.index')
            ->with('capsula', $capsula);
    }

    public function create()
    {
        return view('capsula.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'status' => 'required',
            'img_capsula' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imageName = time() . '-' . $request->nombre . '.' . $request->img_capsula->extension();

        $request->img_capsula->move(public_path('images'), $imageName);

         Capsula::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'status' => $request->input('status'),
            'img_capsula' => $imageName
        ]);
        return back()
            ->with('success', 'Capsula creada correctamente.');
    }


    public function edit($id)
    {
        $capsula = Capsula::findOrFail($id);
        return view('capsula.edit')
            ->with('capsula', $capsula);
    }
    public function update(Request $request, $id)
    {
        if ($request->img_capsula == null) {
            Capsula::where('id', $id)
                ->update([
                    'nombre' => $request->input('nombre'),
                    'descripcion' => $request->input('descripcion'),
                    'status' => $request->input('status'),
                ]);
            return back()
                ->with('success', 'Producto editado correctamente.');
        } else {
            $request->validate([
                // 'nombre' => 'required',
                // 'descripcion' => 'required',
                // 'status' => 'required',
                'img_capsula' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $imageName = time() . '-' . $request->nombre . '.' . $request->img_capsula->extension();

            $request->img_capsula->move(public_path('images'), $imageName);
            Capsula::where('id', $id)
                ->update([
                    'nombre' => $request->input('nombre'),
                    'descripcion' => $request->input('descripcion'),
                    'status' => $request->input('status'),
                    'img_capsula' => $imageName
                ]);
            return back()
                ->with('success', 'Producto editado correctamente.');
        }
    }
}
