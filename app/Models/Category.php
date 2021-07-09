<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // use HasFactory;
    protected $table = 'categorias';

    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion', 'status'];
}