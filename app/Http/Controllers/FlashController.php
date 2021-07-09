<?php

namespace App\Http\Controllers;

use App\Models\Flash;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FlashController extends Controller
{
    public function index()
    {
        $flash = Flash::paginate(5);
        return view('flash.index')
            ->with('flash', $flash);
    }
    public function create()
    {
        $categories = Category::all();
        return view('flash.create')
            ->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'img_portada' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageNamePortada = time() . '-' . $request->slug . '_portada' . '.' . $request->img_portada->extension();
        $request->img_portada->move(public_path('images'), $imageNamePortada);

        DB::table('flash')->insert([
            // 'user_id' => $request->input('user_id'),
            'cuerpo' => $request->input('cuerpo'),
            'titulo' => $request->input('titulo'),
            'slug' => $request->input('slug'),
            'visitas' => 0,
            'img_portada' => $imageNamePortada,
            'status' => $request->input('status'),
            'categorias_id' => $request->input('categorias_id'),
            // 'ediciones_id' => $request->input('ediciones_id'),
            'tipo_post' => $request->input('tipo_post'),
        ]);
        return back() //redirect('posts')
            ->with('success', 'Artículo creado correctamente.');
    }

    public function edit($id)
    {
        $flash = Flash::find($id);
        $categories = Category::all();
        return view('flash.edit')
            ->with('flash', $flash)
            ->with('categories', $categories);
    }

    public function update(Request $request, $id)
    {
        // $data =  $request->except('_token', '_method');
        $flash = Flash::find($id);
        if ($request->img_portada == null) {
            Flash::where('id', $id)
                ->update([
                    'cuerpo' => $request->input('cuerpo'),
                    'titulo' => $request->input('titulo'),
                    'slug' => $request->input('slug'),
                    'visitas' => 0,
                    'status' => $request->input('status'),
                    'categorias_id' => $request->input('categorias_id'),
                    'tipo_post' => $request->input('tipo_post'),
                ]);
            return back() //redirect()->route('home')
                ->with('success', 'Artículo editado correctamente.');
        } else {
            // dd($request->img_portada);
            $request->validate([
                'img_portada' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageNamePortada = time() . '-' . $request->slug . '_portada' . '.' . $request->img_portada->extension();

            $request->img_portada->move(public_path('images'), $imageNamePortada);
            Flash::where('id', $id)
                ->update([
                    'cuerpo' => $request->input('cuerpo'),
                    'titulo' => $request->input('titulo'),
                    'slug' => $request->input('slug'),
                    'visitas' => 0,
                    'img_portada' => $imageNamePortada,
                    'status' => $request->input('status'),
                    'categorias_id' => $request->input('categorias_id'),
                    'tipo_post' => $request->input('tipo_post'),
                ]);
            return back() //redirect()->route('home')
                ->with('success', 'Artículo editado correctamente.');
        }
    }
}
