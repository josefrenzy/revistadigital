<?php

namespace App\Http\Controllers;

use App\Models\Flash;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FlashController extends Controller
{
    public function index()
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $flash = Flash::paginate(5);
            return view('flash.index')
                ->with('flash', $flash);
        }
    }
    public function create()
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $categories = Category::all();
            return view('flash.create')
                ->with('categories', $categories);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $request->validate([
                'img_portada' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageNamePortada = time() . '_portada' . '.' . $request->img_portada->extension();

            $request->img_portada->move(public_path('images/flash'), $imageNamePortada);
            DB::table('flash')->insert([
                'cuerpo' => $request->input('cuerpo'),
                'titulo' => $request->input('titulo'),
                'slug' => $request->input('slug'),
                'visitas' => 0,
                'img_portada' => $imageNamePortada,
                'status' => $request->input('status'),
                'categorias_id' => $request->input('categorias_id'),
                'position' => $request->input('position'),
                // 'tipo_post' => $request->input('tipo_post'),
            ]);
            return back()
                ->with('success', 'Artículo creado correctamente.');
        }
    }

    public function edit($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $flash = Flash::find($id);
            $categories = Category::all();
            return view('flash.edit')
                ->with('flash', $flash)
                ->with('categories', $categories);
        }
    }

    public function show($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $user = Auth::check();
            if ($user) {
                $latest = DB::select('select * from abstract order by id desc limit 2');
                $capsulas = DB::select('select * from capsula order by id desc limit 2');
                $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
            from posts as p 
            inner join abstract as a order by id desc limit 1');
                $categories = Category::all();
                $post = DB::select('select * from flash 
            where id = ?', [$id]);
                // $pub_rel = DB::select('select * from posts 
                // inner join abstract
                // on posts.abstract_id = abstract.id
                // where posts.categorias_id = ? order by created_at desc limit 3', [$post[0]->categorias_id]);
                return view('flash.show')
                    ->with('art', $art)
                    ->with('post', $post)
                    ->with('latest', $latest)
                    // ->with('pub_rel', $pub_rel)
                    ->with('capsulas', $capsulas)
                    ->with('categories', $categories);
            } else {
                $latest = DB::select('select * from abstract order by id desc limit 2');
                $capsulas = DB::select('select * from capsula order by id desc limit 2');
                $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
            from posts as p 
            inner join abstract as a order by id desc limit 1');
                $categories = Category::all();
                $post = DB::select('select * from flash 
            where id = ?', [$id]);
                // $pub_rel = DB::select('select * from posts 
                // inner join abstract
                // on posts.abstract_id = abstract.id
                // where posts.categorias_id = ? order by created_at desc limit 3', [$post[0]->categorias_id]);
                return view('flash.show')
                    ->with('art', $art)
                    ->with('post', $post)
                    ->with('latest', $latest)
                    // ->with('pub_rel', $pub_rel)
                    ->with('capsulas', $capsulas)
                    ->with('categories', $categories);
            }
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            // $flash = Flash::find($id);
            if ($request->img_portada == null) {
                Flash::where('id', $id)
                    ->update([
                        'cuerpo' => $request->input('cuerpo'),
                        'titulo' => $request->input('titulo'),
                        'slug' => $request->input('slug'),
                        'visitas' => 0,
                        'status' => $request->input('status'),
                        'categorias_id' => $request->input('categorias_id'),
                        'position' => $request->input('position'),
                        // 'tipo_post' => $request->input('tipo_post'),
                    ]);
                return back()
                    ->with('success', 'Artículo editado correctamente.');
            } else {
                $request->validate([
                    'img_portada' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $imageNamePortada = time() . '_portada' . '.' . $request->img_portada->extension();

                $request->img_portada->move(public_path('images/flash'), $imageNamePortada);
                Flash::where('id', $id)
                    ->update([
                        'cuerpo' => $request->input('cuerpo'),
                        'titulo' => $request->input('titulo'),
                        'slug' => $request->input('slug'),
                        'visitas' => 0,
                        'img_portada' => $imageNamePortada,
                        'status' => $request->input('status'),
                        'categorias_id' => $request->input('categorias_id'),
                        'position' => $request->input('position'),
                        // 'tipo_post' => $request->input('tipo_post'),
                    ]);
                return back()
                    ->with('success', 'Artículo editado correctamente.');
            }
        }
    }
    public function destroy($id){
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $user = Flash::find($id);
            $user->delete();
            return back()
                    ->with('success', 'Lector eliminado correctamente.');
        }
    }
}
