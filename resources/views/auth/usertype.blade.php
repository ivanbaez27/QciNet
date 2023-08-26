@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
        
                
                    {!! Form::model($user, ['route' => ['store.role', ['user' => $user]], 'method' => 'POST']) !!}
                    @csrf 
                    {{ method_field('PATCH')}}
                    
                    <div class="card-body">  
                        <input id="id_carrera" name="id_carrera" value= " {{ $carrera }} " readonly>
                        <input id="carrerra_nombre" name="carrera_nombre" value= " {{ $nombre_carrera }} " readonly>
                            
                        
                            
                        
                        @if($coordinador_existente)
                            <div class="card-header">{{ __('BIENVENIDO '.strtoupper($user->name). ' DE LA CARRERA DE '.$nombre_carrera) }} </div>
                            <div class="card-body">  
                                <select id="id_rol" name="id_rol">
                                    <option value="-1"> -- Selecciona una opción --</option>
                                        @foreach($roles as $rol)
                                        <div class="form-group row mb-0">
                                            
                                            @if($rol->name != 'Admin' & $rol->name != 'Coordinador')
                                                
                                                <option value="{{ $rol->id }}"> {{$rol->id}} {{ $rol->name }}</option>
                                                
                                            @endif
                                        </div>       
                                        @endforeach
                                </select>

                                <div class="col-md-6 offset-md-4">
                                            
                                    {!! Form::submit('Siguiente', ['class' => 'btn btn-primary mt-2']) !!}
                                </div>  
                            </div> 
                        @else 
                            <div class="card-header">{{ __('¿ERES ESTUDIANTE O COORDINADOR DE LA CARRERA DE'.' '. $nombre_carrera.'?') }} </div>
                            <div class="card-body">  
                                <select id="id_rol" name="id_rol">
                                    <option value="1"> -- Selecciona una opción --</option>
                                        @foreach($roles as $rol)
                                            <div class="form-group row mb-0">
                                                
                                                @if($rol->name != 'Admin')
                                                    
                                                    <option value="{{ $rol->id }}"> {{$rol->id}} {{ $rol->name }}</option>
                                                    
                                                @endif
                                            </div>       
                                        @endforeach
                                </select>

                                <div class="col-md-6 offset-md-4">
                                            
                                    {!! Form::submit('Siguiente', ['class' => 'btn btn-primary mt-2']) !!}
                                </div>  
                            </div> 
                        @endif

                       
                        
                       
                                   
                          
                    {!! Form::close() !!}  
                </div>
            </div>
        </div>
    </div>
    
@endsection




