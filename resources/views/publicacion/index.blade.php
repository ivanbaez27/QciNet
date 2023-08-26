@extends('home.index')

@section('content')
    
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('mensaje')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    @endif
   
   

    
    @if(auth()->user()->roles()->where('name', '=', 'Coordinador')->exists())
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <article class="post">
                <div class="interaction">
                    <a href="#" class="create buttonpost buttonpost1">¿Qué hay para hoy, {{ auth()->user()->name }}?</a>
                </div>
            </article>
            

        </div>
    </section>
    @endif

    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>¿Qué nuevas hay?...</h3></header>
            @if(!$publicaciones->isEmpty())
            
            
                @foreach($publicaciones as $publicacion)
                    @if($publicacion->carrera_id == auth()->user()->id_carrera)
                        <article class="post" data-postid="{{ $publicacion->id }}">
                            <div>

                                <p>{{ $publicacion->descripcion }}</p>
                            </div>
                            <div>
                                @if(isset($publicacion->imagen))
                                    <img src="{{ asset('storage/app/public/uploads').'/'.$publicacion->imagen }}" width="526px" height="526px">
                                @endif
                            </div>
                            <div class="info">
                                Publicado por {{ $publicacion->user->name }} on {{ $publicacion->created_at }}
                            </div>
                            <div class="interaction">
                                <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $publicacion->id)->first() ? Auth::user()->likes()->where('post_id', $publicacion->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                                <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $publicacion->id)->first() ? Auth::user()->likes()->where('post_id', $publicacion->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
                                @if(Auth::user()->id == $publicacion->user_id)
                                    |
                                    <a href="#" class="edit">Editar</a> |
                                    
                                    <a href="{{ route('publicacion.delete', ['id' => $publicacion->id]) }}">Borrar</a>    
                                @endif
                            </div>
                        </article>
                        
    
                    @endif
                @endforeach

                        
            @else
                <p>Aun no hay publicaciones realizadas, sé el primero en publicar algo.</p>
            @endif
        </div>
        
    </section>

        <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal" >
            <div class="modal-dialog">
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                 
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="post-body">Editar Post</label>
                                <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="post-body">Agrega a tu publicación</label>
                                
                                        <input id="post-image" type="file" name="post-image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" id="modal-save">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="create-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/publicacion') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="post-body">Crear Post</label>
                                <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="post-image">Agrega a tu publicación</label>
                                    
                                
                                    <input id="post-image" type="file" name="post-image"  accept="audio/*|video/*|video/x-m4v|video/webm|video/x-ms-wmv|video/x-msvideo|video/3gpp|video/flv|video/x-flv|video/mp4|video/quicktime|video/mpeg|video/ogv|.ts|.mkv|image/*|image/heic|image/heif">

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <input type="submit" class="btn btn-primary"></button>
                            </div>  
                        </form>  
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
          
    <script>
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('edit') }}';
        var urlLike = '{{ route('like') }}';
        var urlCreate = '{{ route('create') }}';
       
    </script>
@endsection