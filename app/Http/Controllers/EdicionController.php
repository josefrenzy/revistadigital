<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Edicion;
use App\Models\Category;
use Exception;


use Illuminate\Support\Facades\DB;

class EdicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ediciones = Edicion::orderByDesc('id')
            ->paginate(5);
        return view('ediciones.index')
            ->with('ediciones', $ediciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('ediciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Edicion::create($request->all());
        return back() //redirect()->route('ediciones.index')
            ->with('success', 'Edición creada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nombre)
    {
        $user_auth = Auth::check();
        if ($user_auth) {
            // dd($user_auth);
            $ediciones = DB::table('posts')
                ->join('ediciones', 'posts.ediciones_id', '=', 'ediciones.id')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('ediciones.nombre', '=', $nombre)
                ->select('posts.id', 'posts.titulo', 'ediciones.nombre', 'abstract.descripcion', 'abstract.img_abstract')
                ->paginate(5);
            $latest = DB::select('select * from abstract order by id desc limit 2');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
            from posts as p 
            inner join abstract as a order by id desc limit 1');
            $ultimas_publicaciones = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('posts.scope', '=', '1')
                ->select('abstract.img_abstract', 'posts.titulo', 'posts.cuerpo', 'posts.id', 'posts.scope')
                ->paginate(3, ['*'], 'ultimas_publicaciones');
            $categories = Category::all();
            return view('ediciones.show')
                ->with('nombre', $nombre)
                ->with('ediciones', $ediciones)
                ->with('art', $art)
                ->with('ultimas_publicaciones', $ultimas_publicaciones)
                ->with('latest', $latest)
                ->with('capsulas', $capsulas)
                ->with('categories', $categories);
        } else {
            $ediciones = DB::table('posts')
                ->join('ediciones', 'posts.ediciones_id', '=', 'ediciones.id')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('ediciones.nombre', '=', $nombre)
                ->where('posts.scope',0)
                ->select('posts.id', 'posts.titulo', 'ediciones.nombre', 'abstract.descripcion', 'abstract.img_abstract', 'posts.scope')
                ->paginate(5);
            $latest = DB::select('select * from abstract order by id desc limit 2');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
            from posts as p 
            inner join abstract as a order by id desc limit 1');
            $ultimas_publicaciones = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('posts.scope', '=', '0')
                ->select('abstract.img_abstract', 'posts.titulo', 'posts.cuerpo', 'posts.id')
                ->paginate(3, ['*'], 'ultimas_publicaciones');
            $categories = Category::all();
            return view('ediciones.show')
                ->with('nombre', $nombre)
                ->with('ediciones', $ediciones)
                ->with('art', $art)
                ->with('ultimas_publicaciones', $ultimas_publicaciones)
                ->with('latest', $latest)
                ->with('capsulas', $capsulas)
                ->with('categories', $categories);
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
        $ediciones = Edicion::findOrFail($id);
        return view('ediciones.edit')
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
        $data =  $request->except('_token', '_method');
        Edicion::where('id', $id)
            ->update($data);
        return back()
            ->with('success', 'Edicion modificada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Edicion::destroy($id);
            return back()
                ->with('success', 'Edicion eliminado correctamente.');
        } catch (Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        
    }
}
