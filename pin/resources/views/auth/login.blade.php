@extends('layouts.auth')

@section('content')

     <div class="session-panel">
      <div class="session">
          <div class="session-content">
            <div class="card card-block form-layout">
              <form method="POST" action="{{ route('login') }}" id="validate">
                @csrf
                <div class="text-xs-center m-b-3">
                  <img src="{{ asset('images/logo-vitacode-400.png') }}" height="80" alt="" class="m-b-1"/>
                  <h5>
                    Bienvenido!
                  </h5>
                  <p class="text-muted">
                    Inicia Sesion para continuar
                  </p>
                </div>
                <fieldset class="form-group">
                  <label for="username">
                    Ingresa tu Email
                  </label>
                  <input  class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="username" required autofocus/>
                  @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                  @endif
                </fieldset>
                <fieldset class="form-group">
                  <label for="password">
                    Enter your password
                  </label>
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg" id="password" name="password" required/>
                  @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                     </span>
                 @endif
                </fieldset>
                <label class="custom-control custom-checkbox m-b-1">
                  <input type="checkbox" name="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description">Recordar</span>
                </label>
                <button class="btn btn-primary btn-block btn-lg" type="submit">
                  Login
                </button>
                
               
              </form>
            </div>
          </div>
          <footer class="text-xs-center p-y-1">
            <p>
              <a href="{{ route('password.request') }}">
                Contraseña olvidada?
              </a>
              &nbsp;&nbsp;·&nbsp;&nbsp;
              <a href="{{ route('register')}}">
                Registrarse
              </a>
            </p>
          </footer>
        </div>

     </div>

@endsection
