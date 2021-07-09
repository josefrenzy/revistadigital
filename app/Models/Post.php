<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'cuerpo',
        'titulo',
        'slug',
        'img_portada',
        'img_abstract',
        'status',
        'categorias_id',
        'ediciones_id',
        'abstract_id',
    ];
}
