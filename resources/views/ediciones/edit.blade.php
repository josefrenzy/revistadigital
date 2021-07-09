@extends('layouts.app',['class' => 'off-canvas-sidebar', 'activePage' => 'ediciones.index', 'title' => __('Create Edición')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('ediciones.update', $ediciones['id'])}}" class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Agregar nueva Edición') }}</h4>
                            </div>
                            <div class="card-body ">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    <img src="images/{{ Session::get('image') }}">
                                @endif
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="nombre">{{ __('Nombre') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="nombre" id="nombre"
                                                placeholder="{{ __('Nombre') }}" value="{{$ediciones->nombre}}" required />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="descripcion">{{ __('Descripción') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <textarea class="form-control" style="height:50px" name="descripcion"
                                                placeholder="Agrega contenido">{{$ediciones->descripcion}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="estatus" class="col-sm-2 col-form-label">{{__('Estatus')}}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="status" id="status">
                                                <option value="">--selecciona una </option>
                                                <option value="0">inactivo</option>
                                                <option value="1" default>activo</option>
                                            </select>
                                            <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                crossorigin="anonymous">
                                            </script>
                                            <script>
                                                //Esta es la función que una vez se cargue el documento será gatillada.
                                                $(function() {
                                                    $("#status").val({{$ediciones -> status}})
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Editar') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection