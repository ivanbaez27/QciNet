<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\Comentario;
use App\Models\User;
use App\Models\Carrera;
use App\Models\Like;
use DB;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
       /* $this->validate($request, [
            'descripcion' => 'required|max:1000'
        ]);
     Publicacion::insert([
        'descripcion' => $request['descripcion'],
        'user_id' => auth()->id
       ]);
        
        return redirect()->route('home.index')->with(['message' => $message]);*/
        echo auth()->id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

       
        $publicaciones = Publicacion::all();
        $comentarios = Comentario::all();
        $usuarios = User::all();
        $publicacion = request()->except('_token');
        $user = Auth::user();
        $id_carrera = $user['id_carrera'];
      
        
        if($request->hasFile('post-image'))
        {
            
            $publicacion['post-image'] = $request->file('post-image')->store('uploads', 'public');
            
                
            Publicacion::create([
                
                'descripcion' => $publicacion['post-body'],
                'imagen' => $publicacion['post-image'],
                'user_id' => auth()->id(),
                'carrera_id' => $id_carrera

            ]);
        }
        else{
            Publicacion::create([
                
                'descripcion' => $publicacion['post-body'],
                'user_id' => auth()->id(),
                'carrera_id' => $id_carrera
                
            ]);
        }
        
       
        
        return redirect('home')->with(['publicaciones' => $publicaciones, 'comentarios' => $comentarios, 'usuarios' => $usuarios, 'id_carrera' => $id_carrera]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
    
    }

    public function editPost(Request $request)
    {
        //
       dd($request);
        $this->validate($request, [
            'post' => 'required'
        ]);
        $post = Publicacion::find($request['postId']);
        
        if (Auth::user()->id != $post->user_id) {
            return redirect()->back();
        }
        $post->descripcion = $request['post-body'];
        
        $post->update();
        $publicaciones = Publicacion::orderBy('created_at', 'desc')->get();            
        return redirect('home')->with(['publicaciones' => $publicaciones]);
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $publicacion = request()->except('_token');
        if($request->hasFile('post-image'))
        {
            
            if($publicacion['post-image'] != 'default_avatar.jpg'){
               Storage::delete('public/'.$publicacion['post-image']);
            }
            
            $publicacion['post-image'] = $request->file('imagen')->store('uploads', 'public');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function getDeletePost($id)
    {
        $publicacion = Publicacion::where('id', $id)->first();
        if (Auth::user()->id != $publicacion->user_id) {
            
            return redirect()->back();
        }
        Publicacion::destroy($id);
        $publicaciones = Publicacion::all();
      
        return redirect('home')->with(['publicaciones' => $publicaciones, 'message' => 'Successfully deleted!']);
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Publicacion::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('id', $post_id)->first();
        
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
}
