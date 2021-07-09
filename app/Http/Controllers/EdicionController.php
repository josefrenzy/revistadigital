<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edicion;
use App\Models\Category;

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
        $ediciones = Edicion::all();
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
        $ediciones = DB::table('posts')
            ->join('ediciones', 'posts.ediciones_id', '=', 'ediciones.id')
            ->where('ediciones.nombre','=',$nombre)
            ->select('posts.id','posts.titulo','ediciones.nombre',)
            ->get();
        $latest = DB::select('select * from abstract order by id desc limit 2');
        $capsulas = DB::select('select * from capsula order by id desc limit 2');
        $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
            from posts as p 
            inner join abstract as a order by id desc limit 1');
        // $post = DB::select('select * from posts 
        //     inner join users on posts.user_id=users.id
        //     where posts.id = ?', [$id]);
        $pub_rel = DB::select('select * from posts 
            inner join abstract
            on posts.abstract_id = abstract.id order by created_at desc limit 3');
        $categories = Category::all();
        return view('ediciones.show')
            ->with('nombre', $nombre)
            ->with('ediciones', $ediciones)
            ->with('art', $art)
            ->with('pub_rel', $pub_rel)
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
        Edicion::destroy($id);
        return redirect('ediciones.index')
            ->with('success', 'Categoria eliminado correctamente.');
    }
}
