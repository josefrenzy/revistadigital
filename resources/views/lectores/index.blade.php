@extends('layouts.app', ['activePage' => 'lectores', 'titlePage' => __('Lectores')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Lectores</h4>
                            <div class="col-12 text-right">
                                <a style="background-color: #4caf50" href="{{ route('lectores.create') }}"
                                    class="btn btn-sm btn-primary">Agregar Lector</a>
                            </div>
                            {{-- <p class="card-lector"> Here is a subtitle for this table</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Nombre completo
                                        </th>
                                        <th>
                                            Empesa
                                        </th>
                                        <th>
                                            Correo electronico
                                        </th>
                                        <th>
                                            Estatus
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($lectores as $lector)
                                            <tr>
                                                <td>
                                                    {{ $lector->id }}
                                                </td>
                                                <td>
                                                    {{ $lector->nombre }}
                                                </td>
                                                <td>
                                                    {{ $lector->nombre_empresa }}
                                                </td>
                                                <td>
                                                    {{ $lector->email }}
                                                </td>
                                                <td>
                                                    @if ($lector->status == 1)
                                                        <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            data-size="xs" checked value="{{ $lector['status'] }}">
                                                    @else

                                                        <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            value="{{ $lector['status'] }}" data-size="xs">
                                                    @endif
                                                </td>
                                                <td>
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('lectores.edit', $lector->id) }}"
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
    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $(".toggle-status").change(function() {
            console.log($(".toggle-status"))
        })

    </script>

@endsection
