@extends('layouts.app', ['activePage' => 'publicidad', 'titlePage' => __('Publicidad')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Lista de Capsulas</h4>
                            <div class="col-12 text-right">
                                <a style="background-color: #4caf50" href="{{ route('publicidad.create') }}"
                                    class="btn btn-sm btn-primary">Agregar Publicidad</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        
                                        <th>
                                            Titulo Capsula
                                        </th>
                                        <th>
                                            Estatus
                                        </th>
                                        <th>
                                            Creacion
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($publicidad as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->img_publicidad }}
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        Activo
                                                        {{-- <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            data-size="xs" checked value="{{ $item['status'] }}"> --}}
                                                    @else
                                                        Inactivo
                                                        {{-- <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            value="{{ $item['status'] }}" data-size="xs"> --}}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $item->created_at }}
                                                </td>
                                                <td>
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ route('publicidad.edit', $item->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-link"
                                                        data-toggle="modal" data-target="#exampleModal">
                                                        <i class="material-icons">clear</i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Eliminacion de
                                                                usuario</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Estas Seguro de que deseas eliminar este registro
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('publicidad.destroy', $item->id) }}"
                                                                method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" type="submit">
                                                                    Eliminar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <span>{{ $publicidad->links() }}</span>
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
