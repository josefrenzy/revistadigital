<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lector extends Model
{
    use HasFactory;
    protected $table = 'lectores';

    public $timestamps = false;

    protected $fillable = ['nombre', 'nombre_empresa', 'email','password','status'];
}
