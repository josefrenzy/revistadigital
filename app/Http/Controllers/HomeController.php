<?php

namespace App\Http\Controllers;

use App\Models\Capsula;
use App\Models\Edicion;
use App\Models\Flash;
use App\Models\Post;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $posts = Post::all();
            $flashs = Flash::all();
            $capsulas = Capsula::all();
            $ediciones = Edicion::all();
            $tabla = DB::table('posts')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.id', 'posts.titulo', 'users.name', 'posts.status')
                ->paginate(5);
            return view('dashboard')
                ->with('tabla', $tabla)
                ->with('posts', $posts)
                ->with('flashs', $flashs)
                ->with('capsulas', $capsulas)
                ->with('ediciones', $ediciones);
        }
    }
}
