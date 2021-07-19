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
                                        {{-- <th>
                                            Empresa
                                        </th> --}}
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
                                        @foreach ($lectores as $item)
                                            @if ($item->type == 2)
                                                <tr>
                                                    <td>
                                                        {{ $item->name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->email }}
                                                    </td>
                                                    <td>
                                                        {{ $item->created_at }}
                                                    </td>
                                                    <td>
                                                        {{-- @if ($item->type == 0)
                                                    Administrador
                                                @endif
                                                @if ($item->type == 1)
                                                    Redactor
                                                @endif --}}
                                                        @if ($item->type == 2)
                                                            Lector
                                                        @endif
                                                    </td>
                                                    <td class="td-actions text-right">
                                                        <a rel="tooltip" class="btn btn-success btn-link"
                                                            href="{{ route('user.edit', $item->id) }}"
                                                            data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                        {{-- <a rel="tooltip" class="btn btn-danger btn-link" id="delete-user"
                                                    href="{{ route('user.show', $item->id) }}" data-original-title=""
                                                    title="">
                                                    <i class="material-icons">clear</i>
                                                    <div class="ripple-container"></div>
                                                </a> --}}
                                                    </td>
                                                </tr>
                                            @endif
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
