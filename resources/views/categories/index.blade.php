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
                            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Name
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
                                        <tr>
                                            @foreach ($categories as $category)
                                                <td>
                                                    {{ $category -> id }}
                                                </td>
                                                <td>
                                                    {{ $category-> nombre }}
                                                </td>
                                                <td>
                                                    {{ $category -> descripcion }}
                                                </td>
                                                <td>
                                                    @if ($category->status == 1)
                                                        <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            data-size="xs" checked value="{{ $category['status'] }}">
                                                    @else

                                                        <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            value="{{ $category['status'] }}" data-size="xs">
                                                    @endif
                                                    {{-- <input type="checkbox" checked data-toggle="toggle" data-size="xs" value="{{ $category -> status }}"> --}}
                                                </td>
                                                <td>
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{route('categories.edit', $category -> id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    {{-- <a href={{ route('categories.edit', $category -> id) }}
                                                        class="btn btn-warning btn-sm">Editar</a>
                                                    <a href={{ route('categories.destroy', $category -> id) }}
                                                        class="btn btn-danger btn-sm">Eliminar</a> --}}
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
