<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    //
    public function user(){

        return $this->belongsTo(User::class, 'id_user');
    }

   	public function carrera(){

        return $this->belongsTo(Carrera::class);
    }

    public function comentarios(){

    	return $this->belongsToMany(Comentario::class);
    }
}
