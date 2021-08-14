<?php

namespace App\Http\Controllers;

use App\Models\Publicidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PublicidadController extends Controller
{
    public function index()
    {
        $publicidad = Publicidad::paginate(5);
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
    public function store(Request $request)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            // dd($request);
            $request->validate([
                'status' => 'required',
                'img_publicidad' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $imageName = time() . '.' . $request->img_publicidad->extension();

            $request->img_publicidad->move(public_path('images/publicidad'), $imageName);

            Publicidad::create([
                'status' => $request->input('status'),
                'img_publicidad' => $imageName
            ]);
            return back()
                ->with('success', 'Capsula creada correctamente.');
        }
    }
    public function edit($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $publicidad = Publicidad::findOrFail($id);
            return view('publicidad.edit')
                ->with('publicidad', $publicidad);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            if ($request->img_publicidad == null) {
                Publicidad::where('id', $id)
                    ->update([
                        'status' => $request->input('status'),
                    ]);
                return back()
                    ->with('success', 'Publicidad editado correctamente.');
            } else {
                $request->validate([
                    'status' => 'required',
                    'img_publicidad' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                $imageName = time() . '.' . $request->img_publicidad->extension();

                $request->img_publicidad->move(public_path('images/publicidad'), $imageName);
                Publicidad::where('id', $id)
                    ->update([
                        'status' => $request->input('status'),
                        'img_publicidad' => $imageName
                    ]);
                return back()
                    ->with('success', 'Publicidad editado correctamente.');
            }
        }
    }
    public function destroy($id){
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $user = Publicidad::find($id);
            $user->delete();
            return back()
                    ->with('success', 'Usuario eliminado correctamente.');
        }
    }
}