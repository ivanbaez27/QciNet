<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class DatapostController extends Controller
{
    //
    public function publicacioncompu(){
        
        $data = Post::all(); // Recupera los datos desde el modelo
        

        return response()->json($data);


    }
}
