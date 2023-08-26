<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Vinkla\Hashids\Facades\Hashids;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Ver usuarios')->only('index');
        //$this->middleware('can:Editar usuarios')->only('update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['usuarios']= User::paginate(5);
        return view ('users.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        return view('admin.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hashid = Hashids::decode($id);
        $user = User::findOrFail($hashid[0]);
        
    
       return view ('users.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Hashids::decode($id);
        $usuario = User::findOrFail($id[0]);
        return view ('users.edit', compact('usuario'));
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
        
        $id = Hashids::decode($id);
        $datos = request()->except(['_token', '_method']);
        $datos['password'] = Hash::make($datos['password']);
      
        if($request->hasFile('image'))
        {
             
            $usuario = User::findOrFail($id);
            
            
            Storage::delete('public/'.$datos['image']);
            
            
            $datos['image'] = $request->file('image')->store('uploads', 'public');
        }
        
        User::where('id','=',$id)->update($datos);
        $usuario = User::findOrFail($id[0]);
        
        return view ('users.edit', compact('usuario'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $id = Hashids::decode($id);
        $user = User::findOrFail($id[0]);
        if($user->image != 'default_avatar.jpg'){
            if(Storage::delete('public/'.$user->image))
            {
                User::destroy($id[0]);
            }
        }
        else{
            User::destroy($id[0]);
        }
        return redirect('users')->with('mensaje', '¡Usuario borrado!');
        
    }
}
