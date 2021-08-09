@extends('layouts.app', ['activePage' => 'categories', 'titlePage' => __('Categorias')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Categorias</h4>
                            <div class="col-12 text-right">
                                <a style="background-color: #4caf50" href="{{ route('categories.create') }}"
                                    class="btn btn-sm btn-primary">Agregar Categoria</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @include('flash-message')
                                <table class="table">
                                    <thead class=" text-primary">
                                        {{-- <th>
                                            ID
                                        </th> --}}
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Descripción
                                        </th>
                                        {{-- <th>
                                            Estatus
                                        </th> --}}
                                        <th>
                                            Opciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                {{-- <td>
                                                    {{ $category->id }}
                                                </td> --}}
                                                <td>
                                                    {{ $category->nombre }}
                                                </td>
                                                <td>
                                                    {{ $category->descripcion }}
                                                </td>
                                                {{-- <td>
                                                    @if ($category->status == 1)
                                                        <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            data-size="xs" checked value="{{ $category['status'] }}">
                                                    @else

                                                        <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            value="{{ $category['status'] }}" data-size="xs">
                                                    @endif
                                                </td> --}}
                                                <td>
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ route('categories.edit', $category->id) }}"
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
                                                            <form
                                                                action="{{ route('categories.destroy', $category->id) }}"
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
                                <span>{{ $categories->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
