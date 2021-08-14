<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Edicion;
use App\Models\Publicidad;
use Illuminate\Support\Facades\Auth;

class RevistaController extends Controller
{
    public function index()
    {
        $user = Auth::check();
        if ($user) {
            $last_edicion_final = '';
            $last_edicion = DB::select('select * from ediciones where status = 1 order by id desc limit 1');
            if ($last_edicion != []) {
                $last_edicion_final = $last_edicion[0]->nombre;
            }
            $posts_row_one = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id, ediciones.nombre as edicion_nombre, posts.created_at, categorias.nombre as categoria_nombre from posts
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            inner join categorias on posts.categorias_id = categorias.id
            where posts.visibility=1 and ediciones.nombre = ? and posts.scope = 1 and posts.status=1 and ediciones.status = 1
            order by posts.created_at desc limit 1', [$last_edicion_final]);
            $posts_row_two = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id, ediciones.nombre as edicion_nombre, posts.created_at, categorias.nombre as categoria_nombre from posts
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            inner join categorias on posts.categorias_id = categorias.id
            where posts.visibility=2 and ediciones.nombre = ? and posts.scope = 1 and posts.status=1 and ediciones.status = 1
            order by posts.created_at desc limit 1', [$last_edicion_final]);
            $posts_row_three = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id, ediciones.nombre as edicion_nombre, posts.created_at, categorias.nombre as categoria_nombre from posts
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            inner join categorias on posts.categorias_id = categorias.id
            where posts.visibility=3 and ediciones.nombre = ? and posts.scope = 1 and posts.status=1 and ediciones.status = 1
            order by posts.created_at desc limit 1', [$last_edicion_final]);
            $flash_row_one = DB::select('select * from flash where position = 1 and status=1 limit 1');
            $flash_row_two = DB::select('select * from flash where position = 2 and status=1 limit 1');
            $flash_row_three = DB::select('select * from flash where position = 3 and status=1 limit 1');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
                from posts as p 
                inner join abstract as a order by id desc limit 1');
            $cat = DB::table('categorias')
                ->orderByDesc('id')
                ->paginate(3, ['*'], 'categories');
            $nombreEdicion = DB::select('select * from ediciones 
                where status = 1 order by id desc limit 1');
            $categories = Category::all();
            $ediciones = Edicion::all();
            $ultimas_publicaciones = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('posts.scope', '=', '1')
                ->select('abstract.img_abstract', 'posts.titulo', 'abstract.descripcion', 'posts.id')
                ->paginate(3, ['*'], 'last_pub');
            $publicidad = DB::table('publicidad')
                ->get();
            return view('main.revista')
                ->with('art', $art)
                ->with('cat', $cat)
                ->with('flash_row_one', $flash_row_one)
                ->with('flash_row_two', $flash_row_two)
                ->with('flash_row_three', $flash_row_three)
                ->with('posts_row_one', $posts_row_one)
                ->with('posts_row_two', $posts_row_two)
                ->with('posts_row_three', $posts_row_three)
                ->with('capsulas', $capsulas)
                ->with('ediciones', $ediciones)
                ->with('categories', $categories)
                ->with('publicidad', $publicidad)
                ->with('nombreEdicion', $nombreEdicion)
                ->with('ultimas_publicaciones', $ultimas_publicaciones);
        } else {
            $last_edicion_final = '';
            $last_edicion = DB::select('select * from ediciones where status = 1 order by id desc limit 1');
            if ($last_edicion != []) {
                $last_edicion_final = $last_edicion[0]->nombre;
            }
            $posts_row_one = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract, posts.id as post_id, ediciones.nombre as edicion_nombre, posts.created_at, categorias.nombre as categoria_nombre from posts  
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            inner join categorias on posts.categorias_id = categorias.id
            where posts.visibility=1 and ediciones.nombre = ? and posts.scope = 0 and posts.status=1 and ediciones.status = 1
            order by posts.created_at desc limit 1', [$last_edicion_final]);
            $posts_row_two = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id, ediciones.nombre as edicion_nombre, posts.created_at, categorias.nombre as categoria_nombre from posts 
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            inner join categorias on posts.categorias_id = categorias.id
            where posts.visibility=2 and ediciones.nombre = ? and posts.scope = 0 and posts.status=1 and ediciones.status = 1
            order by posts.created_at desc limit 1', [$last_edicion_final]);
            $posts_row_three = DB::select('select posts.titulo as titulo, abstract.descripcion as descripcion, abstract.img_abstract as img_abstract, posts.id as post_id, ediciones.nombre as edicion_nombre, posts.created_at, categorias.nombre as categoria_nombre from posts 
            inner join abstract on posts.abstract_id = abstract.id
            inner join ediciones on posts.ediciones_id = ediciones.id
            inner join categorias on posts.categorias_id = categorias.id
            where posts.visibility=3 and ediciones.nombre = ? and posts.scope = 0 and posts.status=1 and ediciones.status = 1
            order by posts.created_at desc limit 1', [$last_edicion_final]);
            $flash_row_one = DB::select('select * from flash where position = 1 and status=1 limit 1');
            $flash_row_two = DB::select('select * from flash where position = 2 and status=1 limit 1');
            $flash_row_three = DB::select('select * from flash where position = 3 and status=1 limit 1');
            $capsulas = DB::select('select * from capsula order by id desc limit 2');
            $art = DB::select('select a.nombre, a.descripcion, p.id , a.img_abstract
                from posts as p 
                inner join abstract as a order by id desc limit 1');
            $cat = DB::table('categorias')
                ->orderByDesc('id')
                ->paginate(3, ['*'], 'categories');
            $nombreEdicion = DB::select('select * from ediciones order by id desc limit 1');
            $categories = Category::all();
            $ediciones = Edicion::all();
            $ultimas_publicaciones = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->where('posts.scope', '=', '0')
                ->select('abstract.img_abstract', 'posts.titulo', 'abstract.descripcion', 'posts.id')
                ->paginate(3, ['*'], 'last_pub');
            $pub_rel = DB::select('select * from posts 
                inner join abstract
                on posts.abstract_id = abstract.id
                where posts.categorias_id = 1 order by created_at desc limit 3');
            $publicidad = DB::table('publicidad');
            return view('main.revista')
                ->with('art', $art)
                ->with('cat', $cat)
                ->with('flash_row_one', $flash_row_one)
                ->with('flash_row_two', $flash_row_two)
                ->with('flash_row_three', $flash_row_three)
                ->with('pub_rel', $pub_rel)
                ->with('posts_row_one', $posts_row_one)
                ->with('posts_row_two', $posts_row_two)
                ->with('posts_row_three', $posts_row_three)
                ->with('capsulas', $capsulas)
                ->with('ediciones', $ediciones)
                ->with('categories', $categories)
                ->with('publicidad', $publicidad)
                ->with('nombreEdicion', $nombreEdicion)
                ->with('ultimas_publicaciones', $ultimas_publicaciones);
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
            $pub_rel = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->join('categorias', 'posts.categorias_id', '=', 'categorias.id')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->where('posts.categorias_id', '=', $post[0]->categorias_id)
                ->where('posts.scope', 0)
                ->select('posts.id', 'posts.titulo', 'abstract.descripcion', 'abstract.img_abstract', 'categorias.nombre')
                ->paginate(5, ['*'], 'pub_rel');
            return view('main.show')
                ->with('art', $art)
                ->with('post', $post)
                ->with('latest', $latest)
                ->with('capsulas', $capsulas)
                ->with('pub_rel', $pub_rel)
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
            $pub_rel = DB::table('posts')
                ->join('abstract', 'posts.abstract_id', '=', 'abstract.id')
                ->join('categorias', 'posts.categorias_id', '=', 'categorias.id')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->where('posts.categorias_id', '=', $post[0]->categorias_id)
                ->where('posts.scope', 0)
                ->select('posts.id', 'posts.titulo', 'abstract.descripcion', 'abstract.img_abstract', 'categorias.nombre')
                ->paginate(5, ['*'], 'pub_rel');

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
