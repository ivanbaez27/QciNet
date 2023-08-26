@extends('layouts.app')

@section('content')
<div class="container">

<form action=" {{ url('/users/'.Hashids::encode($usuario->id)) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH')}}
    @include('users.form', ['modo'=> 'Editar'])

</form>
</div>
@endsection