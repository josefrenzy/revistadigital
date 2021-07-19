@extends('layouts.app', ['activePage' => 'user', 'titlePage' => __('Usuarios')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Lista de Usuarios</h4>
                            {{-- <p class="card-category"> Here you can manage users</p> --}}
                            <div class="col-12 text-right">
                                <a style="background-color: #4caf50" href="{{ route('user.create') }}"
                                    class="btn btn-sm btn-primary">Agregar Usuario</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <div class="row">
                                <div class="col-12 text-right">
                                    <a href="#" class="btn btn-sm btn-primary">Agregar Usuario</a>
                                </div>
                            </div> --}}
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                                Creation date
                                            </th>
                                            <th>
                                                Role
                                            </th>
                                            <th class="text-right">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
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
                                                    @if ($item->type == 0)
                                                        Administrador
                                                    @endif
                                                    @if ($item->type == 1)
                                                        Redactor
                                                    @endif
                                                </td>
                                                <td class="td-actions text-right">
                                                    <a rel="tooltip" class="btn btn-success btn-link"
                                                        href="{{ route('user.edit', $item->id) }}" data-original-title=""
                                                        title="">
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
                                        @endforeach
                                    </tbody>
                                </table>
                                <span>{{ $users->links() }}</span>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#delete-user').click(function(e) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                console.log(result)
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
@endsection
