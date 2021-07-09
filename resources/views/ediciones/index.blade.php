@extends('layouts.app', ['activePage' => 'ediciones', 'titlePage' => __('Ediciones')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Ediciones</h4>
                            <div class="col-12 text-right">
                                <a style="background-color: #4caf50" href="{{ route('ediciones.create') }}"
                                    class="btn btn-sm btn-primary">Agregar Edición</a>
                            </div>
                            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            Descripción
                                        </th>
                                        <th>
                                            Estatus
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($ediciones as $edicion)
                                            <tr>
                                                <td>
                                                    {{ $edicion->id }}
                                                </td>
                                                <td>
                                                    {{ $edicion->nombre }}
                                                </td>
                                                <td>
                                                    {{ $edicion->descripcion }}
                                                </td>
                                                <td>
                                                    @if ($edicion->status == 1)
                                                        <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            data-size="xs" checked value="{{ $edicion['status'] }}">
                                                    @else

                                                        <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            value="{{ $edicion['status'] }}" data-size="xs">
                                                    @endif
                                                </td>
                                                <td>
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ route('ediciones.edit', $edicion->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
