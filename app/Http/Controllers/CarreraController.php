<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;
use Vinkla\Hashids\Facades\Hashids;

class CarreraController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:Ver carreras');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['carreras'] = Carrera::paginate(5);
        return view('carrera.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('carrera.create');
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

        $campos = [
            'nombre_carrera' => 'required | string | max:50',
            'codigo' => 'required | string | min:6 | max:10',
        ];
        $mensaje = [

            'required' => 'El :attribute es requerido'

        ];

        $this->validate($request, $campos, $mensaje);

        $datosCarrera = request()->except('_token');
        Carrera::insert($datosCarrera);
        //return response()->json($datosCarrera);
        return redirect('carrera')->with('mensaje', '¡Carrera agregada con éxito!');
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
    public function edit($id)
    {
        //
        $id = Hashids::decode($id);
        $carrera = Carrera::findOrFail($id[0]);
        return view ('carrera.edit', compact('carrera'));
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

        $campos = [
            'nombre_carrera' => 'required | string | max:50',
            
        ];
        $mensaje = [

            'required' => 'El :attribute es requerido'

        ];

        $this->validate($request, $campos, $mensaje);

        $id = Hashids::decode($id);
        $datosCarrera = request()->except(['_token', '_method']);
        Carrera::where('id','=', $id)->update($datosCarrera);
        $carrera = Carrera::findOrFail($id[0]);
        //return view ('carrera.edit', compact('carrera'));
        return redirect('carrera')->with('mensaje', '¡Carrera modificada!');
        
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
        Carrera::destroy($id[0]);
        return redirect('carrera')->with('mensaje', '¡Carrera borrada!');
    }
}
