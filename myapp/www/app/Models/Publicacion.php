<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    //relacion muchos a muchos
    protected $table = "publicaciones";

    protected $fillable = [
        'descripcion', 'user_id', 'carrera_id', 'imagen'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function coordinador(){

    	return $this->belongsTo(Coordinador::class);
    }

    public function carrera(){

    	return $this->belongsTo(Carrera::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
