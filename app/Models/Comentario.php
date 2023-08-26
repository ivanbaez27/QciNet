<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    //

    public function estudiantes(){

    	return $this->belongsToMany(Estudiante::class);
    }

    public function publicaciones(){

    	return $this->belongsToMany(Publicacion::class);
    }
}
