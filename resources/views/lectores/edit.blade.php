{@extends('layouts.app',['class' => 'off-canvas-sidebar', 'activePage' => 'lectores', 'title' => __('Create lector')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('lectores.update', $lector['id']) }}" class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Editar Categoria') }}</h4>
                            </div>
                            <div class="card-body ">
                                @include('flash-message')
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="nombre">{{ __('Nombre') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="nombre" id="nombre"
                                                placeholder="{{ __('Nombre') }}" value="{{ $lector['nombre'] }}"
                                                required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="nombre">{{ __('Empresa') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="nombre_empresa" id="nombre"
                                                placeholder="{{ __('Empresa') }}"
                                                value="{{ $lector['nombre_empresa'] }}" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                name="email" id="input-email" type="email"
                                                placeholder="{{ __('Email') }}" value="{{ $lector['email'] }}"
                                                required />
                                            @if ($errors->has('email'))
                                                <span id="email-error" class="error text-danger"
                                                    for="input-email">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <label class="col-sm-2 col-form-label" for="nombre">{{ __('Contraseña') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="password" id="nombre"
                                                placeholder="{{ __('Contraseña') }}" value="{{ $lector['password'] }}"
                                                disabled />
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                            </div>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="{{ __('Password...') }}">
                                        </div>
                                        @if ($errors->has('password'))
                                            <div id="password-error" class="error text-danger pl-3" for="password"
                                                style="display: block;">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="estatus" class="col-sm-2 col-form-label">{{ __('Estatus') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="status" id="status">
                                                <option value="">-- selecciona una opción --</option>
                                                <option value="1">activo</option>
                                                <option value="0">inactivo</option>
                                            </select>
                                            <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                                                        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                                                        crossorigin="anonymous">
                                            </script>
                                            <script>
                                                $(function() {
                                                    $("#status").val({{ $lector->status }})
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Editar Lector') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- <script>
        lector = {{ $lector['status'] }}
        if(lector == 1) document.getElementById("active").setAttribute("selected","selected")
        else document.getElementById("inactive").setAttribute("selected","selected")
    </script> --}}
@endsection
