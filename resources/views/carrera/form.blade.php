<h1> {{ $modo }} carrera</h1>

@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
                
            @endforeach
        </ul>


    </div>

@endif

<div class="form-group row">
    <label for="nombre_carrera" class="col-md-4 col-form-label text-md-right"> Nombre de la carrera </label>
    <div class="col-md-6">
	    <input type="text" name="nombre_carrera" class="form-control" value=" {{ isset($carrera->nombre_carrera)? $carrera->nombre_carrera : old('nombre_carrera')}}" id="nombre_carrera">
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <input type="submit" value=" {{$modo}} datos">
    </div>
</div>