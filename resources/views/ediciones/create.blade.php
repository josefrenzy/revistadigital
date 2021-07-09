@extends('layouts.app',['class' => 'off-canvas-sidebar', 'activePage' => 'ediciones.index', 'title' => __('Create
Edición')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('ediciones.store') }}" class="form-horizontal">
                        @csrf
                        @method('post')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Agregar nueva Edición') }}</h4>
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
                                    <label class="col-sm-2 col-form-label" for="descripcion">{{ __('Descripción') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <textarea class="form-control" style="height:50px" name="descripcion"
                                                placeholder="Agrega contenido"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="estatus" class="col-sm-2 col-form-label">{{ __('Estatus') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="status" id="status">
                                                <option>-- selecciona una opcion --</option>
                                                <option value="0">inactivo</option>
                                                <option value="1" default>activo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Crear Edición') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
