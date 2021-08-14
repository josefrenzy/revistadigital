<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Edicion;
use App\Models\Abstracto;
use Exception;

class PostController extends Controller
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
            $posts = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.id', 'posts.titulo', 'users.name', 'posts.status')
                ->orderByDesc('id')
                ->paginate(5);
            return view('post.index')
                ->with('posts', $posts);
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
            $categories = Category::all();
            $ediciones = Edicion::all();
            $id = User::all();
            return view('post.create')
                ->with('user_id', $id)
                ->with('categories', $categories)
                ->with('ediciones', $ediciones);
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
                'img_portada' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'img_abstract' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $nombreAbstract = $request->input('titulo');
            $descripcion = $request->input('descripcion');
            $imageNameAbstract = time() . '-' . $request->slug . '_abstract' . '.' . $request->img_abstract->extension();

            // se le pasa como nombre el slug para hacerlo unique e irrepetible y asi poder sacar el 
            DB::table('abstract')->insert([
                'nombre' => $nombreAbstract,
                'descripcion' => $descripcion,
                'img_abstract' => $imageNameAbstract,
            ]);


            $imageNamePortada = time() . '-' . $request->slug . '_portada' . '.' . $request->img_portada->extension();

            $request->img_abstract->move(public_path('images/abstract'), $imageNameAbstract);

            $request->img_portada->move(public_path('images/portada'), $imageNamePortada);

            $id = DB::getPdo()->lastInsertId();
            try {
                DB::table('posts')->insert([
                    'user_id' => $request->input('user_id'),
                    'cuerpo' => $request->input('cuerpo'),
                    'titulo' => $request->input('titulo'),
                    'slug' => $request->input('slug'),
                    'visitas' => 0,
                    'img_portada' => $imageNamePortada,
                    'status' => $request->input('status'),
                    'scope' => $request->input('scope'),
                    'visibility' => $request->input('visibility'),
                    'categorias_id' => $request->input('categorias_id'),
                    'ediciones_id' => $request->input('ediciones_id'),
                    'abstract_id' => $id,
                    'tipo_post' => $request->input('tipo_post'),
                ]);
                return back()
                    ->with('success', 'Artículo creado correctamente.');
            } catch (Exception $e) {
                return back()->withError($e->getMessage())->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $articulo = Post::find($id);
            return redirect('posts')
                ->with('post', $articulo)
                ->with('success', 'Artículo creado correctamente.');
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
            $post = Post::find($id);
            $abstract = Abstracto::find($post->abstract_id);
            $categories = Category::all();
            $ediciones = Edicion::all();
            $user_id = User::all();
            return view('post.edit')
                ->with('abstract', $abstract)
                ->with('user_id', $user_id)
                ->with('post', $post)
                ->with('categories', $categories)
                ->with('ediciones', $ediciones);
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
            if ($request->img_abstract == null || $request->img_portada == null) {
                $id_abstracto = DB::select('select posts.abstract_id from posts
                inner join abstract on posts.abstract_id = abstract.id where posts.id = ?', [$id]);
                Abstracto::where('id', $id_abstracto[0]->abstract_id)->update([
                    'nombre' => $request->input('nombre'),
                    'descripcion' => $request->input('descripcion'),
                ]);
                Post::where('id', $id)
                    ->update([
                        'user_id' => $request->input('user_id'),
                        'cuerpo' => $request->input('cuerpo'),
                        'titulo' => $request->input('titulo'),
                        'slug' => $request->input('slug'),
                        'status' => $request->input('status'),
                        'scope' => $request->input('scope'),
                        'visibility' => $request->input('visibility'),
                        'categorias_id' => $request->input('categorias_id'),
                        'ediciones_id' => $request->input('ediciones_id'),
                        'abstract_id' => $id_abstracto[0]->abstract_id,
                    ]);
                return back()
                    ->with('success', 'Artículo editado correctamente.');
            } else {
                $id_abstracto = DB::select('select posts.abstract_id from posts
                    inner join abstract on posts.abstract_id = abstract.id where posts.id = ?', [$id]);
                $request->validate([
                    'img_portada' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'img_abstract' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $nombreAbstract = $request->input('titulo');
                $descripcion = $request->input('descripcion');
                $imageNameAbstract = time() . '-' . $request->slug . '_abstract' . '.' . $request->img_abstract->extension();
                // se le pasa como nombre el slug para hacerlo unique e irrepetible y asi poder sacar el 
                Abstracto::where('id', $id_abstracto[0]->abstract_id)->update([
                    'nombre' => $nombreAbstract,
                    'descripcion' => $descripcion,
                    'img_abstract' => $imageNameAbstract,
                ]);
                $imageNamePortada = time() . '-' . $request->slug . '_portada' . '.' . $request->img_portada->extension();

                $request->img_abstract->move(public_path('images/abstract'), $imageNameAbstract);

                $request->img_portada->move(public_path('images/portada'), $imageNamePortada);
                $id_abstracto = DB::select('select posts.abstract_id from posts inner join abstract on posts.abstract_id = abstract.id where posts.id = ?', [$id]);
                Post::where('id', $id)
                    ->update([
                        'user_id' => $request->input('user_id'),
                        'cuerpo' => $request->input('cuerpo'),
                        'titulo' => $request->input('titulo'),
                        'slug' => $request->input('slug'),
                        'visitas' => 0,
                        'img_portada' => $imageNamePortada,
                        'status' => $request->input('status'),
                        'scope' => $request->input('scope'),
                        'visibility' => $request->input('visibility'),
                        'categorias_id' => $request->input('categorias_id'),
                        'ediciones_id' => $request->input('ediciones_id'),
                        'abstract_id' => $id_abstracto[0]->abstract_id,
                    ]);
                return back()
                    ->with('success', 'Artículo editado correctamente.');
            }
        }
    }
    public function search(Request $request)
    {
        if (auth()->user()) {
            $search = $request->input('search');
            $ultimas_publicaciones = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('posts.scope', '=', '1')
                ->select('abstract.img_abstract', 'posts.titulo', 'abstract.descripcion', 'posts.id')
                ->paginate(3, ['*'], 'ultimas_publicaciones');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $categories = Category::all();
            $posts = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->join('categorias', 'posts.categorias_id', '=', 'categorias.id')
                ->where('titulo', 'LIKE', "%$search%")
                ->select('posts.id', 'posts.titulo', 'categorias.nombre', 'abstract.descripcion', 'abstract.img_abstract')
                ->paginate(5);
            $publicidad = DB::table('publicidad')
                ->get();
            return view('main.search', compact('posts'))
                ->with('ultimas_publicaciones', $ultimas_publicaciones)
                ->with('capsulas', $capsulas)
                ->with('categories', $categories)
                ->with('publicidad', $publicidad)
                ->with('search', $search);
        } else {
            $search = $request->input('search');
            $ultimas_publicaciones = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('posts.scope', '=', '0')
                ->select('abstract.img_abstract', 'posts.titulo', 'abstract.descripcion', 'posts.id')
                ->paginate(3, ['*'], 'ultimas_publicaciones');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $categories = Category::all();
            $posts = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->join('categorias', 'posts.categorias_id', '=', 'categorias.id')
                ->where('titulo', 'LIKE', "%$search%")
                ->select('posts.id', 'posts.titulo', 'categorias.nombre', 'abstract.descripcion', 'abstract.img_abstract')
                ->paginate(5);
            $publicidad = DB::table('publicidad')
                ->get();
            return view('main.search', compact('posts'))
                ->with('ultimas_publicaciones', $ultimas_publicaciones)
                ->with('capsulas', $capsulas)
                ->with('categories', $categories)
                ->with('publicidad', $publicidad)
                ->with('search', $search);
        }
    }
    public function destroy($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $user = Post::find($id);
            $user->delete();
            return back()
                ->with('success', 'Lector eliminado correctamente.');
        }
    }
}
