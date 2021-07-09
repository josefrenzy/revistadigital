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
        //
        $categories = Category::all();
        return view('categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
        // Category::create($request->all());
        return back() //redirect()->route('categories.index')
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {   

    //     // $search = Category::findOrFail($id);
    //     // return view('categories')
    //     //     ->with('search',$search);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit')
            ->with('category', $category);
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
        if ($request->img_categorias == null) {
            // dd($request);
            Category::where('id', $id)
                ->update([
                    'nombre' => $request->input('nombre'),
                    'descripcion' => $request->input('descripcion'),
                    'status' => $request->input('status'),
                ]);
            return back()
                ->with('success', 'Categoria editado correctamente.');
        } else {
            // dd($request);
            $request->validate([
                // 'nombre' => 'required',
                // 'descripcion' => 'required',
                // 'status' => 'required',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('categories.index')
            ->with('success', 'Categoria eliminado correctamente.');
    }
}