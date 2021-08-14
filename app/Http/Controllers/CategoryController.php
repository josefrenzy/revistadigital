<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;


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
            $categories = Category::orderByDesc('id')
                ->paginate(5);
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
        $user = Auth::check();
        if ($user) {
            $categorias = DB::table('posts')
                ->join('categorias', 'posts.categorias_id', '=', 'categorias.id')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('categorias.nombre', '=', $nombre)
                ->select('posts.id', 'posts.titulo', 'categorias.nombre', 'abstract.descripcion', 'abstract.img_abstract')
                ->paginate(5, ['*'], 'categorias');
            $latest = DB::select('select * from abstract order by id desc limit 2');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
            from posts as p 
            inner join abstract as a order by id desc limit 1');
            $ultimas_publicaciones = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('posts.scope', '=', '1')
                ->select('abstract.img_abstract', 'posts.titulo', 'abstract.descripcion', 'posts.id')
                ->paginate(3, ['*'], 'ultimas_publicaciones');
            $categories = Category::all();
            $publicidad = DB::table('publicidad')
                ->get();
            return view('main.categorias')
                ->with('nombre', $nombre)
                ->with('categorias', $categorias)
                ->with('art', $art)
                ->with('ultimas_publicaciones', $ultimas_publicaciones)
                ->with('latest', $latest)
                ->with('capsulas', $capsulas)
                ->with('categories', $categories)
                ->with('publicidad', $publicidad);
        } else {
            $categorias = DB::table('posts')
                ->join('categorias', 'posts.categorias_id', '=', 'categorias.id')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('categorias.nombre', '=', $nombre)
                ->select('posts.id', 'posts.titulo', 'categorias.nombre', 'abstract.descripcion', 'abstract.img_abstract')
                ->paginate(5, ['*'], 'categorias');
            $latest = DB::select('select * from abstract order by id desc limit 2');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
            from posts as p 
            inner join abstract as a order by id desc limit 1');
            $ultimas_publicaciones = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('posts.scope', '=', '0')
                ->select('abstract.img_abstract', 'posts.titulo', 'abstract.descripcion', 'posts.id')
                ->paginate(3, ['*'], 'ultimas_publicaciones');
            $categories = Category::all();
            $publicidad = DB::table('publicidad')
                ->get();
            return view('main.categorias')
                ->with('nombre', $nombre)
                ->with('categorias', $categorias)
                ->with('art', $art)
                ->with('ultimas_publicaciones', $ultimas_publicaciones)
                ->with('latest', $latest)
                ->with('capsulas', $capsulas)
                ->with('categories', $categories)
                ->with('publicidad', $publicidad);
        }
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
            try {
                Category::destroy($id);
                return back()
                    ->with('success', 'Categoria eliminado correctamente.');
            } catch (Exception $e) {
                return back()->withError($e->getMessage())->withInput();
            }
        }
    }
}
