<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abstracto extends Model
{
    use HasFactory;
    protected $table = 'abstract';
    protected $fillable = ['nombre', 'descripcion', 'img_abstract'];
    public $timestamps = false;

}
