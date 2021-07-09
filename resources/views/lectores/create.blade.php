{@extends('layouts.app',['class' => 'off-canvas-sidebar', 'activePage' => 'lectores', 'title' => __('Crear Lector')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('lectores.store') }}" class="form-horizontal">
                        @csrf
                        @method('post')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Agregar Lector') }}</h4>
                            </div>
                            <div class="card-body ">
                                @include('flash-message')
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="nombre">{{ __('Nombre') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="nombre" id="nombre"
                                                placeholder="{{ __('Nombre') }}" value="" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="nombre">{{ __('Empresa') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="nombre_empresa" id="nombre"
                                                placeholder="{{ __('Empresa') }}" value="" required />
                                            {{-- @if ($errors->has('old_password')) --}}
                                            {{-- <span id="name-error" class="error text-danger" --}}
                                                {{-- for="title">{{ $errors->first('old_password') }}</span> --}}
                                            {{-- @endif --}}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="" required />
                                        @if ($errors->has('email'))
                                            <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="estatus" class="col-sm-2 col-form-label">{{__('Estatus')}}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="status" id="status">
                                            <option value="" >-- selecciona una opción --</option>
                                                <option value="1">activo</option>
                                                <option value="0" default>inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="nombre">{{ __('Contraseña') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text"  id="nombre"
                                                placeholder="{{ __('Contraseña') }}" value="Por defecto es: revista@123"  disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Crear Lector') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection