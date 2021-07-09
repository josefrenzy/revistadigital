@extends('layouts.app', ['activePage' => 'flash', 'titlePage' => __('Crear Flash')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Lista de Flash</h4>
                            <div class="col-12 text-right">
                                <a style="background-color: #4caf50" href="{{ route('flash.create') }}"
                                    class="btn btn-sm btn-primary">Agregar Flash</a>
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
                                            Estatus
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($flash as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->id }}
                                                </td>
                                                <td>
                                                    {{ $item->titulo }}
                                                </td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            data-size="xs" checked value="{{ $item['status'] }}">
                                                    @else

                                                        <input class="toggle-status" type="checkbox" data-toggle="toggle"
                                                            value="{{ $item['status'] }}" data-size="xs">
                                                    @endif
                                                </td>
                                                <td>
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ route('flash.edit', $item->id) }}"
                                                        data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <span>{{$flash->links()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
