@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ url('/majors') }}" method="post" enctype="multipart/form-data">
	@csrf
	@include('carrera.form', ['modo' =>'Crear'])
		
</form>
</div>
@endsection