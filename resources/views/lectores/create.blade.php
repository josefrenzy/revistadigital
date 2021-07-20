{@extends('layouts.app',['class' => 'off-canvas-sidebar', 'activePage' => 'lectores', 'title' => __('Crear Lector')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('users.store') }}" class="form-horizontal">
                        @csrf
                        @method('post')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Agregar Lector') }}</h4>
                            </div>
                            <div class="card-body ">
                                @include('flash-message')
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="name">{{ __('Nombre') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="name" id="name"
                                                placeholder="{{ __('Nombre') }}" value="" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="name">{{ __('Role') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="type" id="type">
                                                <option value="">-- Selecciona un valor --</option>
                                                <option value="0">Administrador</option>
                                                <option value="1">Redactor</option>
                                                <option value="2" selected>Lector</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="bmd-form-group{{ $errors->has('type') ? ' has-danger' : '' }} mt-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">

                                        </div>
                                        <select class="form-control" name="type" id="type">
                                            <option value="">-- Selecciona un valor --</option>
                                            <option value="0">Administrador</option>
                                            <option value="1">Redactor</option>
                                            <option value="2">Lector</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('type'))
                                        <div id="email-error" class="error text-danger pl-3" for="email"
                                            style="display: block;">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </div>
                                    @endif
                                </div> --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                name="email" id="input-email" type="email" placeholder="{{ __('Email') }}"
                                                value="" required />
                                            @if ($errors->has('email'))
                                                <span id="email-error" class="error text-danger"
                                                    for="input-email">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
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
                                </div> --}}
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="password">{{ __('Contraseña') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" type="text" id="password" name="password"
                                                placeholder="{{ __('Contraseña') }}" value="revista123"/>
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
