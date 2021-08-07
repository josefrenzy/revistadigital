{@extends('layouts.app',['class' => 'off-canvas-sidebar', 'activePage' => 'categories', 'title' => __('Create
Category')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('categories.update', $category->id) }}"
                        class="was-validated form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Editar Categoria') }}</h4>
                            </div>
                            <div class="card-body ">
                                @include('flash-message')
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="nombre">{{ __('Nombre') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="nombre" id="nombre"
                                                placeholder="{{ __('Nombre') }}" value="{{ $category['nombre'] }}"
                                                required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="descripcion">{{ __('Cuerpo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <textarea class="form-control" name="descripcion"
                                                placeholder="Agrega contenido">
                                                    {{ $category->descripcion }}
                                                </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="img_categorias">{{ __('Imagen Categoria') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input type="file" name="img_categorias" class="file" accept="image/*">
                                            <div class="input-group my-3">
                                                <input type="text" class="form-control" disabled placeholder="Upload File"
                                                    id="file" value="{{ $category->img_categorias }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="browse btn btn-primary">Browse...</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding: 0 20rem;">
                                    <div class="doc">
                                        <div class="col-sm-12 box">
                                            <img src="{{ asset('images/categorias/' . $category->img_categorias) }}"
                                                id="preview" class="img-thumbnail" style="max-width:50%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="estatus" class="col-sm-2 col-form-label">{{ __('Estatus') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="status" id="status">
                                                <option value="">-- selecciona una opción --</option>
                                                <option id="active" value="1">activo</option>
                                                <option id="inactive" value="2">inactivo</option>
                                            </select>
                                            <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                                                        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                                                        crossorigin="anonymous">
                                            </script>
                                            <script>
                                                $(function() {
                                                    $("#status").val({{ $category->status }})
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Editar Categoria') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous">
    </script>
    <script>
        //Image upload
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });

        $(document).on("click", ".browse", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            console.log(fileName)
        });

        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            var fileSize = e.target.files[0].size;
            if (fileSize > 2000000) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'la imagen no puede pesar mas de 2mb',
                })
                e.preventDefault();
            } else {
                $("#file").val(fileName);
                var reader = new FileReader();
                reader.onload = function(e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("preview").src = e.target.result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endsection
