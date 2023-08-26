@extends('layouts.app')


@section('content')
<div class="container">

    
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('mensaje')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    @endif
   
   

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Imagen<th>
            <th>Nombre del usuario</th>
            <th>Email</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
        <tr>
            <td> {{ $usuario->id}} </td>
            <td> 
                <img src="{{ asset($usuario->profile->getProfileImage())  }}" width="100px" height="100px">
                
            </td>
            <td>{{ $usuario->name }} </td>
            <td> {{ $usuario->email}}</td>
            <td> 
                
                <form action=" {{ url ('/users/'.$usuario->id) }}" class= "d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input type="submit" onclick="return confirm('¿Estas seguro de borrar este registro?')" value="Borrar">

                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $usuarios->links() !!}
</div>
@endsection