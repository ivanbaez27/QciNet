<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-header">{{ $modo }} Publicación</div>

                <div class="card-body">


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
                    <label for="imagen" class="col-md-4 col-form-label text-md-right">Imagen</label>

                    <div class="col-md-6">
                        @if(isset($publicacion->imagen))
                        <img src="{{ asset('storage').'/'.$publicacion->imagen}}" width="526px" height="526px">
                        @endif
                        <input id="imagen" type="file" name="imagen">

                    </div>
                </div>

                <div class="form-group row">
                    <input id="titulo" type="text" name="titulo" placeholder="Asunto de la publicación">
                    
                </div>

                <div class="form-group row">
                    
                    <textarea id="descripcion" type="textarea" name="descripcion" rows="10" cols="100" placeholder="¿Qué tienes por decir?"></textarea>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <input type="submit" value=" {{$modo}} publicación">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


