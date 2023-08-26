<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    //
    protected $table = "coordinadores";

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function user_(){

        return $this->belongsTo(Carrera::class);
    }

    public function publicacion(){

    	return $this->belongsToMany(Publicacion::class);
    }
}
