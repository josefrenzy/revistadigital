<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Edicion;
use App\Models\Abstracto;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $post = DB::table('posts')
        //     ->join('users', 'posts.user_id', '=', 'users.id')
        //     ->get();
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id','=','users.id')
            ->select('posts.id','posts.titulo','users.name','posts.status')
            ->paginate(5);
        return view('post.index')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $ediciones = Edicion::all();
        $id = User::all();
        return view('post.create')
            ->with('user_id', $id)
            ->with('categories', $categories)
            ->with('ediciones', $ediciones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
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

        $request->img_abstract->move(public_path('images'),$imageNameAbstract);

        $request->img_portada->move(public_path('images'),$imageNamePortada);

        $id = DB::getPdo()->lastInsertId();

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
        return back()//redirect('posts')
            ->with('success', 'Artículo creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo = Post::find($id);
        // dd($articulo);
        return redirect('posts')
            ->with('post',$articulo)
            ->with('success', 'Artículo creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $abstract = Abstracto::find($post->abstract_id);
        $categories = Category::all();
        $ediciones = Edicion::all();
        $user_id = User::all();
        return view('post.edit')
            ->with('abstract',$abstract)
            ->with('user_id', $user_id)
            ->with('post', $post)
            ->with('categories', $categories)
            ->with('ediciones', $ediciones);
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
        // dd($request);
        if ($request->abstract == null || $request->abstract == null ) {
            $id_abstracto = DB::select('select posts.abstract_id from posts
            inner join abstract on posts.abstract_id = abstract.id where posts.id = ?', [$id]);
            Abstracto::where('id',$id_abstracto[0]->abstract_id)->update([
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
            return back() //redirect()->route('home')
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
            dd($id_abstracto);
            Abstracto::where('id',)->update([
                'nombre' => $nombreAbstract,
                'descripcion' => $descripcion,
                'img_abstract' => $imageNameAbstract,
            ]);
            $imageNamePortada = time() . '-' . $request->slug . '_portada' . '.' . $request->img_portada->extension();

            $request->img_abstract->move(public_path('images'),$imageNameAbstract);
    
            $request->img_portada->move(public_path('images'),$imageNamePortada);

            $id_abstracto = DB::select('select posts.abstract_id from posts
            inner join abstract on posts.abstract_id = abstract.id where posts.id = ?', [$id]);
            Post::where('id', $id)
                ->update([
                    'user_id' => $request->input('user_id'),
                    'cuerpo' => $request->input('cuerpo'),
                    'titulo' => $request->input('titulo'),
                    'slug' => $request->input('slug'),
                    // 'visitas' => 0,
                    'img_portada' => $imageNamePortada,
                    'status' => $request->input('status'),
                    'scope' => $request->input('scope'),
                    'visibility' => $request->input('visibility'),
                    'categorias_id' => $request->input('categorias_id'),
                    'ediciones_id' => $request->input('ediciones_id'),
                    'abstract_id' => $id_abstracto[0]->abstract_id,
                    // 'cuerpo' => $request->input('cuerpo'),
                    // 'titulo' => $request->input('titulo'),
                    // 'slug' => $request->input('slug'),
                    // 'visitas' => 0,
                    // 'img_portada' => $imageNameAbstract,
                    // 'status' => $request->input('status'),
                    // 'categorias_id' => $request->input('categorias_id'),
                    // 'tipo_post' => $request->input('tipo_post'),
                ]);
            return back()
                ->with('success', 'Artículo editado correctamente.');
        }
    }


}
