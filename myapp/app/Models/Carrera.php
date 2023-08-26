<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    //

	public function coordinador(){

        return $this->hasOne(Coordinador::class);
    }

    public function estudiantes(){

        return $this->hasMany(Estudiante::class);
    }

    public function posts(){
    	return $this->hasMany(Post::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
