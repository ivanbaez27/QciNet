@extends('layouts.app')

@section('content')
<div class="container">

<form action=" {{ url('/majors/'.Hashids::encode($carrera->id)) }}" method="post">
    @csrf
    {{ method_field('PATCH')}}
    @include('carrera.form', ['modo'=> 'Editar'])

</form>
</div>
@endsection