@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">content_paste</i>
                            </div>
                            <p class="card-category">Artículos</p>
                            <h3 class="card-title">{{ $posts->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person</i>
                            </div>
                            <p class="card-category">Flash</p>
                            <h3 class="card-title">{{ $flashs->count() }}</h3>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person</i>
                            </div>
                            <p class="card-category">Capsulas</p>
                            <h3 class="card-title">{{ $capsulas->count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person</i>
                            </div>
                            <p class="card-category">Ediciones</p>
                            <h3 class="card-title">{{ $ediciones->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Lista de Artículos</h4>
                            <div class="col-12 text-right">
                                <a style="background-color: #4caf50" href="{{ route('posts.create') }}"
                                    class="btn btn-sm btn-primary">Agregar Artículo</a>
                            </div>
                        </div>
                        {{-- </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Titulo
                                        </th>
                                        <th>
                                            Autor
                                        </th>
                                        <th>
                                            Estatus
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </thead>
                                    <tbody>
                                        @if ($tabla->count() != 0)
                                            @foreach ($tabla as $post)
                                                <tr>
                                                    <td>
                                                        {{ $post->id }}
                                                    </td>
                                                    <td>
                                                        {{ $post->titulo }}
                                                    </td>
                                                    <td>
                                                        {{ $post->name }}
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" checked data-toggle="toggle" data-size="xs">
                                                    </td>
                                                    <td>
                                                        <a rel="tooltip" class="btn btn-success btn-link"
                                                            href="{{ route('posts.edit', $post->id) }}"
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
                                                                <h5 class="modal-title" id="exampleModalLabel">Eliminacion
                                                                    de usuario</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Estas Seguro de que deseas eliminar este registro
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('posts.destroy', $post->id) }}"
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
                                        @endif
                                    </tbody>
                                </table>
                                <span>{{ $tabla->links() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            md.initDashboardPageCharts();
        });
    </script>
@endpush
