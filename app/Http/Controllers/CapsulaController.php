<?php

namespace App\Http\Controllers;
use app\Enums\UserType;
use App\Models\Capsula;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CapsulaController extends Controller
{
    public function index()
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $capsula = Capsula::orderByDesc('id')
                ->paginate(5);
            return view('capsula.index')
                ->with('capsula', $capsula);
        }
    }

    public function create()
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            return view('capsula.create');
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
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
    }


    public function edit($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $capsula = Capsula::findOrFail($id);
            return view('capsula.edit')
                ->with('capsula', $capsula);
        }
    }
    public function update(Request $request, $id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
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
    }

    public function show($id)
    {
        if (auth()->user()) {
            $capsula = Capsula::find($id);
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $categories = Category::all();
            $ultimas_publicaciones = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('posts.scope', '=', '1')
                ->select('abstract.img_abstract', 'posts.titulo', 'posts.cuerpo', 'posts.id')
                ->paginate(3, ['*'], 'ultimas_publicaciones');
            return view('capsula.show')
                ->with('ultimas_publicaciones', $ultimas_publicaciones)
                ->with('capsula', $capsula)
                ->with('capsulas', $capsulas)
                ->with('categories', $categories);
        } else {
            $capsula = Capsula::find($id);
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $categories = Category::all();
            $ultimas_publicaciones = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('posts.scope', '=', '0')
                ->select('abstract.img_abstract', 'posts.titulo', 'posts.cuerpo', 'posts.id')
                ->paginate(3, ['*'], 'ultimas_publicaciones');
            return view('capsula.show')
                ->with('ultimas_publicaciones', $ultimas_publicaciones)
                ->with('capsula', $capsula)
                ->with('capsulas', $capsulas)
                ->with('categories', $categories);
        }
    }

    public function destroy($id){
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $user = Capsula::find($id);
            $user->delete();
            return back()
                    ->with('success', 'Usuario eliminado correctamente.');
        }
    }
}
