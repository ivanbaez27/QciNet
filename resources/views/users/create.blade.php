@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ url('/users') }}" method="post" enctype="multipart/form-data">
	@csrf
	@include('users.form', ['modo' =>'Crear'])
	
	
</form>
</div>
@endsection