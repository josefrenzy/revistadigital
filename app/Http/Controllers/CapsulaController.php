<?php

namespace App\Http\Controllers;

use App\Models\Capsula;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // dd($request);
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'status' => 'required',
            'img_capsula' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imageName = time() . '-' . $request->nombre . '.' . $request->img_capsula->extension();

        $request->img_capsula->move(public_path('images/capsulas'), $imageName);

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

    public function show($id)
    {
        $capsula = Capsula::find($id);
        $capsulas = DB::select('select * from capsula order by id desc limit 2');
        $categories = Category::all();
        $pub_rel = DB::select('select * from posts 
            inner join abstract
            on posts.abstract_id = abstract.id
            where posts.categorias_id = 1 order by created_at desc limit 3');
        return view('capsula.show')
            ->with('pub_rel',$pub_rel)
            ->with('capsula', $capsula)
            ->with('capsulas', $capsulas)
            ->with('categories', $categories);

    }
}
