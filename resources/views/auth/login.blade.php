@extends('layouts.app_public', ['title' => 'Iniciar Sesión'])

@section('content')

@php  
    $variables = variables(); 
@endphp

<style type="text/css">
    .card-header{
        border-top: 5px solid  {{ $variables->bg_tema }};
        font-size: 1.2rem;
        font-weight: bold;
    }
    .card-footer a, .input-group-text span{
        color: {{ $variables->bg_tema }};   
    }
</style>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-8 col-11">
            <div class="text-center">
                <img src="{{ asset('img/' . $variables->logo ) }}" alt="2eab" width="250" height="200" >
            </div>
            <div class="card mt-2">
                <div class="card-header text-center">
                    {{ empresa()->nombre_corto }}
                </div>
                <div class="card-body login-card-body p-4">
                    <p class="mb-3 text-center" >Autenticarse para iniciar sesión</p>
                    @if(session('msj'))
                        <script>
                            window.onload = function(){
                              Swal.fire({ 
                                html: "{!! session('msj') !!}",
                                icon: 'info',
                                confirmButtonText: 'Ok!'
                              })
                            }  
                          </script> 
                    @endif

                    <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}

                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                   value="{{ old('username') }}" placeholder="Nombre de usuario" 
                                   required autofocus autocomplete="off">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @if($errors->has('username'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                   placeholder="Contraseña" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-7">
                                <div class="icheck-olive">
                                    <input type="checkbox" name="remember" id="remember">
                                    <label for="remember">Recordarme</label>
                                </div>
                            </div>
                            <div class="col-5">
                                <button type=submit class="btn btn-block btn-tema">
                                    <span class="fas fa-sign-in-alt"></span>
                                    Acceder
                                </button>
                            </div>
                        </div>

                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
