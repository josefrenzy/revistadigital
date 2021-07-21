<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $categories = Category::all();
            return view('categories.index')
                ->with('categories', $categories);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            return view('categories.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $request->validate([
                'img_categorias' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $nombre = $request->input('nombre');
            $status = $request->input('status');
            $descripcion = $request->input('descripcion');
            $imageName = time() . '-' . $request->input('nombre') . '.' . $request->img_categorias->extension();
            $request->img_categorias->move(public_path('images/categorias'), $imageName);
            DB::table('categorias')->insert([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'status' => $status,
                'img_categorias' => $imageName,
            ]);
            return back()
                ->with('success', 'Producto creado correctamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nombre)
    {
        $categorias = DB::table('posts')
            ->join('categorias', 'posts.categorias_id', '=', 'categorias.id')
            ->where('categorias.nombre', '=', $nombre)
            ->select('posts.id', 'posts.titulo', 'categorias.nombre',)
            ->get();
        $latest = DB::select('select * from abstract order by id desc limit 2');
        $capsulas = DB::select('select * from capsula order by id desc limit 2');
        $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
        from posts as p 
        inner join abstract as a order by id desc limit 1');
        $ultimas_publicaciones = DB::select('select abstract.img_abstract,posts.titulo, posts.cuerpo, posts.id from posts
            inner join abstract on posts.abstract_id = abstract.id 
            order by created_at desc');
        $categories = Category::all();
        return view('main.categorias')
            ->with('nombre', $nombre)
            ->with('categorias', $categorias)
            ->with('art', $art)
            ->with('ultimas_publicaciones', $ultimas_publicaciones)
            ->with('latest', $latest)
            ->with('capsulas', $capsulas)
            ->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $category = Category::findOrFail($id);
            return view('categories.edit')
                ->with('category', $category);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            if ($request->img_categorias == null) {
                Category::where('id', $id)
                    ->update([
                        'nombre' => $request->input('nombre'),
                        'descripcion' => $request->input('descripcion'),
                        'status' => $request->input('status'),
                    ]);
                return back()
                    ->with('success', 'Categoria editado correctamente.');
            } else {
                $request->validate([
                    'img_categorias' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                $imageName = time() . '-' . $request->nombre . '.' . $request->img_categorias->extension();

                $request->img_categorias->move(public_path('images/categorias'), $imageName);
                Category::where('id', $id)
                    ->update([
                        'nombre' => $request->input('nombre'),
                        'descripcion' => $request->input('descripcion'),
                        'status' => $request->input('status'),
                        'img_categorias' => $imageName
                    ]);
                return back()
                    ->with('success', 'Categoria editado correctamente.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            Category::destroy($id);
            return redirect('categories.index')
                ->with('success', 'Categoria eliminado correctamente.');
        }
    }
}
