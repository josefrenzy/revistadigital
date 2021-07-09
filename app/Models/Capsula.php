<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capsula extends Model
{
    use HasFactory;
    protected $table = 'capsula';
    protected $fillable = ['nombre', 'descripcion', 'status','img_capsula'];
    public $timestamps = false;
}
