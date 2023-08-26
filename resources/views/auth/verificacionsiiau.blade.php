@extends('layouts.app')


@section('content')
            <div class="container">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li>
                            QciNet - Red Universitaria
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    
                </div>
            </div>
        </nav>
     
        <main class="py-4">
            @yield('content')
        </main>
        
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
        
                    
                    {!! Form::open(['route' => ['select.role', $data]]) !!}
                    @csrf 
                        <div class="card-header">{{ __('VERIFICA TU CUENTA DE SIIAU') }} </div>
                        <div class="card-body">  
                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">Código SIIAU: </label>
    
                                <div class="col-md-6">
                                    <input id="code" type="text" class="form-control"  name="code" value="{{ old('code') }}" required autocomplete="code" autofocus size="
                                    9" maxlength="9">
    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nip" class="col-md-4 col-form-label text-md-right">NIP: </label>
    
                                <div class="col-md-6">
                                    <input id="nip" type="password" class="form-control"  name="nip" value="{{ old('nip') }}" required autocomplete="nip" autofocus size="10" maxlength="10">
    
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                        
                                {!! Form::submit('Siguiente', ['class' => 'btn btn-primary mt-2']) !!}
                            </div>
                        </div>
                    
                        
                        
                    {!! Form::close() !!}  
                </div>
            </div>
        </div>
    </div>
    
@endsection




