@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nombre_usuario') ? ' has-error' : '' }}">
                            <label for="nombre_usuario" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre_usuario" type="text" class="form-control" name="nombre_usuario" value="" placeholder="Ingrese nombre" required autofocus>

                                @if ($errors->has('nombre_usuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre_usuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('apellido_usuario') ? ' has-error' : '' }}">
                            <label for="apellido_usuario" class="col-md-4 control-label">Apellido</label>

                            <div class="col-md-6">
                                <input id="apellido_usuario" type="text" class="form-control" name="apellido_usuario" value="" placeholder="Ingrese apellido" required>

                                @if ($errors->has('apellido_usuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellido_usuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo institucional</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" placeholder="Ingrese mail" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Ingrese contraseña" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repita contraseña" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tipo_usuario') ? ' has-error' : '' }}">
                            <label for="tipo_usuario" class="col-md-4 control-label">Tipo de usuario</label>
                            <div class="col-md-6 selectContainer">
                                <select class="form-control" name="tipo_usuario" id="tipo_usuario">
                                    <option value="7">Super Admin </option>                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
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
