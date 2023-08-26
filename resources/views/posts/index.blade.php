@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            {{-- Main section --}}
            <main class="main col-md-8 px-2 py-3">

                @forelse($posts as $post)
                    @if($post->major_id == auth()->user()->major_id)
                    
                            @php
                                $state=false;
                                
                            @endphp

                            <div class="card mx-auto custom-card mb-5" id="prova">
                                <!-- Card Header -->
                                <div class="card-header d-flex justify-content-between align-items-center bg-white pl-3 pr-1 py-2">
                                    <div class="d-flex align-items-center">
                                        <a href="/profile/{{$post->user->username}}" style="width: 32px; height: 32px;">
                                            <img src="{{ asset($post->user->profile->getProfileImage()) }}" class="rounded-circle w-100">
                                        </a>
                                        <a href="/profile/{{$post->user->username}}" class="my-0 ml-3 text-dark text-decoration-none">
                                            {{ $post->user->name }}
                                        </a>
                                    </div>
                                    <div class="card-dots">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-link text-muted" data-toggle="modal" data-target="#post{{$post->id}}">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>

                                        <!-- Dots Modal -->
                                        <div class="modal fade" id="post{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <ul class="list-group">
                                                    @can('delete', $post)
                                                        <form action="{{url()->action('PostsController@destroy', $post->id)}}" method="POST">
                                                            @csrf
                                                            @method("DELETE")
                                                            <li class="btn btn-danger list-group-item">
                                                                <button class="btn" type="submit">Eliminar</button>
                                                                </li>
                                                        </form>
                                                    @endcan
                                                    <a href="/p/{{ $post->id }}"><li class="btn list-group-item">Ir a la publicación</li></a>
                                                    <a href="#"><li class="btn list-group-item" data-dismiss="modal">Cancelar</li></a>
                                                </ul>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Image -->
                                <div class="js-post" ondblclick="showLike(this, 'like_{{ $post->id }}')">
                                    <i class="fa fa-heart"></i>
                                    <img class="card-img" src="{{ asset('storage').'/'.$post->image }}" alt="post image" style="max-height: 767px">
                                </div>

                                <!-- Card Body -->
                                <div class="card-body px-3 py-2">

                                    <div class="d-flex flex-row">
                                        <form method="POST" action="{{url()->action('LikeController@update2', ['like'=>$post->id])}}">
                                            @csrf
                                            @if (true)
                                                <input id="inputid" name="update" type="hidden" value="1">
                                            @else
                                                <input id="inputid" name="update" type="hidden" value="0">
                                            @endif

                                            @if($post->like->isEmpty())
                                                <button type="submit" class="btn pl-0">
                                                    <i class="far fa-heart fa-2x"></i>
                                                </button>
                                            @else

                                                @foreach($post->like as $likes)

                                                    @if($likes->user_id==Auth::User()->id && $likes->State==true)
                                                        @php
                                                            $state=true;
                                                        @endphp
                                                    @endif

                                                @endforeach

                                                @if($state)
                                                    <button type="submit" class="btn pl-0">
                                                        <i class="fas fa-heart fa-2x" style="color:red"></i>
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn pl-0">
                                                        <i class="far fa-heart fa-2x"></i>
                                                    </button>
                                                @endif

                                            @endif

                                            <a href="/p/{{ $post->id }}" class="btn pl-0">
                                                <i class="far fa-comment fa-2x"></i>
                                            </a>

                                            <!-- Share Button trigger modal -->
                                            

                                            <!-- Share Modal -->
                                        

                                        </form>
                                    </div>
                                    <div class="flex-row">

                                        <!-- Likes -->
                                        @if (count($post->like->where('State',true)) > 0)
                                            <h6 class="card-title">
                                                <strong>{{ count($post->like->where('State',true)) }} likes</strong>
                                            </h6>
                                        @endif

                                        {{-- Post Caption --}}
                                        <p class="card-text mb-1">
                                            <a href="/profile/{{$post->user->username}}" class="my-0 text-dark text-decoration-none">
                                                <strong>{{ $post->user->name }}</strong>
                                            </a>
                                            {{ $post->caption }}
                                        </p>

                                        <!-- Comment -->
                                        <div class="comments">
                                            @if (count($post->comments) > 0)
                                                <a href="/p/{{ $post->id }}" class="text-muted">Ver todos los comentarios</a>
                                            @endif
                                            @foreach ($post->comments->sortByDesc("created_at")->take(2) as $comment)
                                                <p class="mb-1"><strong>{{ $comment->user->name }}</strong>  {{ $comment->body }}</p>
                                            @endforeach
                                        </div>

                                        <!-- Created At  -->
                                        <p class="card-text text-muted">{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                                <!-- Card Footer -->
                                <div class="card-footer p-0">
                                    <!-- Add Comment -->
                                    <form action="{{ action('CommentController@store') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-0  text-muted">
                                            <div class="input-group is-invalid">
                                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                                <textarea class="form-control" id="body" name='body' rows="1" cols="1" placeholder="Agregar comentario..."></textarea>
                                                <div class="input-group-append">
                                                    <button class="btn btn-md btn-outline-info" type="submit">Publicar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        
                    @endif
                    @empty

                        <div class="d-flex justify-content-center p-3 py-5 border bg-white">
                            <div class="card border-0 text-center">
                                <img src="{{asset('img/nopost.png')}}" class="card-img-top" alt="..." style="max-width: 330px">
                                <div class="card-body ">
                                    <h3>No hay publicaciones</h3>
                                    <p class="card-text text-muted">No pudimos encontrar ninguna publicacion.</p>
                                </div>
                            </div>
                        </div>

                @endforelse

                {{-- <example-component></example-component> --}} <!-- Testin Infinite scrooling with vue -->

            </main>

            {{-- Aside Section --}}
            <aside class="aside col-md-4 py-3">
                <div class="position-fixed">

                    <!-- User Info -->
                    <div class="d-flex align-items-center mb-3">
                        <a href="/profile/{{Auth::user()->username}}" style="width: 56px; height: 56px;">
                            <img src="{{ asset(Auth::user()->profile->getProfileImage()) }}" class="rounded-circle w-100">
                        </a>
                        <div class='d-flex flex-column pl-3'>
                            <a href="/profile/{{Auth::user()->username}}" class='h6 m-0 text-dark text-decoration-none' >
                                <strong>{{ auth()->user()->username }}</strong>
                            </a>
                            <small class="text-muted ">{{ auth()->user()->name }}</small>
                        </div>
                    </div>

                    <!-- Suggestions -->
                   

                   

                </div>
            </aside>

        </div>
    </div>

@endsection


@section('exscript')
    <script>
        function copyToClipboard(id) {
            var copyText = document.getElementById(id);
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
        }

        function showLike(e, id) {
            console.log("Like: ", id);
            var heart = e.firstChild;
            heart.classList.add('fade');
            setTimeout(() => {
                heart.classList.remove('fade');
            }, 2000);
        }

    </script>

    {{-- <script>

        document.addEventListener('submit', function(e){
            e.preventDefault()
            console.log('script run... ');
            var btn = e.submitter;
            console.log(btn.name)

            if (btn.name === 'liked'){
                btn.classList.toggle('text-danger');
                btn.value = !(btn.value == 'true');
            }

        })

            " action="{{url()->action('PostsController@updatelikes', ['post'=>$post->id])}}">
            url =  http://localhost:8000/p/{post}
            (async () => {
                const rawResponse = await fetch('http://localhost:8000/p/', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({a: 1, b: 'Textual content'})
                });
                const content = await rawResponse.json();

                console.log(content);
            })();

    </script> --}}
@endsection





