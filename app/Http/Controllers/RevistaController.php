<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Edicion;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class RevistaController extends Controller
{
    public function index()
    {
        $user = Auth::check();
        if ($user) {
            $last_edicion = DB::select('select * from ediciones order by id desc limit 1');
            $posts_row_one = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id from posts  
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            where posts.visibility=1 and ediciones.nombre = ? and posts.scope = 1
            order by posts.created_at desc limit 1', [$last_edicion[0]->nombre]);
            $posts_row_two = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id from posts  
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            where posts.visibility=2 and ediciones.nombre = ? and posts.scope = 1
            order by posts.created_at desc limit 1', [$last_edicion[0]->nombre]);
            $posts_row_three = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id from posts  
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            where posts.visibility=3 and ediciones.nombre = ? and posts.scope = 1
            order by posts.created_at desc limit 1', [$last_edicion[0]->nombre]);
            $flash = DB::select('select * from flash order by created_at desc limit 1');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
                from posts as p 
                inner join abstract as a order by id desc limit 1');
            $cat = DB::select('select * from categorias order by id desc limit 3'); //
            $nombreEdicion = DB::select('select * from ediciones order by id desc limit 1');
            $categories = Category::all();
            $ediciones = Edicion::all();
            $pub_rel = DB::select('select * from posts 
            inner join abstract
            on posts.abstract_id = abstract.id
            where posts.categorias_id = 1 order by created_at desc limit 3');
            return view('main.revista')
                ->with('art', $art)
                ->with('cat', $cat)
                ->with('flash', $flash)
                ->with('pub_rel', $pub_rel)
                ->with('posts_row_one', $posts_row_one)
                ->with('posts_row_two', $posts_row_two)
                ->with('posts_row_three', $posts_row_three)
                ->with('capsulas', $capsulas)
                ->with('ediciones', $ediciones)
                ->with('categories', $categories)
                ->with('nombreEdicion', $nombreEdicion);
        } else {
            $last_edicion = DB::select('select * from ediciones order by id desc limit 1');
            // dd($last_edicion);
            $posts_row_one = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id from posts  
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            where posts.visibility=1 and ediciones.nombre = ? and posts.scope = 0
            order by posts.created_at desc limit 1', [$last_edicion[0]->nombre]);
            $posts_row_two = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id from posts 
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            where posts.visibility=2 and ediciones.nombre = ? and posts.scope = 0
            order by posts.created_at desc limit 1', [$last_edicion[0]->nombre]);
            $posts_row_three = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id from posts 
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            where posts.visibility=3 and ediciones.nombre = ? and posts.scope = 0
            order by posts.created_at desc limit 1', [$last_edicion[0]->nombre]);
            $flash = DB::select('select * from flash order by created_at desc limit 1');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
                from posts as p 
                inner join abstract as a order by id desc limit 1');
            $cat = DB::select('select * from categorias order by id desc limit 3'); //
            $nombreEdicion = DB::select('select * from ediciones order by id desc limit 1');
            $categories = Category::all();
            $ediciones = Edicion::all();
            $pub_rel = DB::select('select * from posts 
            inner join abstract
            on posts.abstract_id = abstract.id
            where posts.categorias_id = 1 order by created_at desc limit 3');
            return view('guest.index')
                ->with('art', $art)
                ->with('cat', $cat)
                ->with('flash', $flash)
                ->with('pub_rel', $pub_rel)
                ->with('posts_row_one', $posts_row_one)
                ->with('posts_row_two', $posts_row_two)
                ->with('posts_row_three', $posts_row_three)
                ->with('capsulas', $capsulas)
                ->with('ediciones', $ediciones)
                ->with('categories', $categories)
                ->with('nombreEdicion', $nombreEdicion);
        }
    }
    public function show($id)
    {
        $user = Auth::check();
        if ($user) {
            $latest = DB::select('select * from abstract order by id desc limit 2');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
            from posts as p 
            inner join abstract as a order by id desc limit 1');
            $categories = Category::all();
            $post = DB::select('select * from posts 
            inner join users on posts.user_id=users.id
            where posts.id = ?', [$id]);
            $pub_rel = DB::select('select * from posts 
            inner join abstract
            on posts.abstract_id = abstract.id
            where posts.categorias_id = ? order by created_at desc limit 3', [$post[0]->categorias_id]);
            return view('main.show')
                ->with('art', $art)
                ->with('post', $post)
                ->with('latest', $latest)
                ->with('pub_rel', $pub_rel)
                ->with('capsulas', $capsulas)
                ->with('categories', $categories);
        } else {
            $latest = DB::select('select * from abstract order by id desc limit 2');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
            from posts as p 
            inner join abstract as a order by id desc limit 1');
            $categories = Category::all();
            $post = DB::select('select * from posts 
            inner join users on posts.user_id=users.id
            where posts.id = ?', [$id]);
            $pub_rel = DB::select('select * from posts 
            inner join abstract
            on posts.abstract_id = abstract.id
            where posts.categorias_id = ? order by created_at desc limit 3', [$post[0]->categorias_id]);
            return view('main.show')
                ->with('art', $art)
                ->with('post', $post)
                ->with('latest', $latest)
                ->with('pub_rel', $pub_rel)
                ->with('capsulas', $capsulas)
                ->with('categories', $categories);
        }
    }
}
