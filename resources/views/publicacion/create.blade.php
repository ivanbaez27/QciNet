@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ url('/publicacion') }}" method="post" enctype="multipart/form-data">
	@csrf
	@include('publicacion.form', ['modo' =>'Crear'])
	
	
</form>
</div>
@endsection

