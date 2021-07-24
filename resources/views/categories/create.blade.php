{@extends('layouts.app',['class' => 'off-canvas-sidebar', 'activePage' => 'categories', 'title' => __('Create
Category')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('categories.store') }}" class="form-horizontal"
                        enctype="multipart/form-data" onsubmit="return validarImagen();">
                        @csrf
                        @method('post')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Agregar nueva Categoria') }}</h4>
                            </div>
                            <div class="card-body ">
                                @include('flash-message')
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="nombre">{{ __('Nombre') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="nombre" id="nombre"
                                                placeholder="{{ __('Nombre') }}" value="" required />
                                            {{-- @if ($errors->has('old_password')) --}}
                                            {{-- <span id="name-error" class="error text-danger" --}}
                                            {{-- for="title">{{ $errors->first('old_password') }}</span> --}}
                                            {{-- @endif --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="descripcion">{{ __('Cuerpo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            {{-- <strong>Description:</strong> --}}
                                            <textarea class="form-control" style="height:50px" name="descripcion"
                                                placeholder="Agrega contenido"></textarea>
                                            {{-- <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required /> --}}
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
                                                    id="file">
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
                                            <img src="" id="preview" class="img-thumbnail" style="max-width:50%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="estatus" class="col-sm-2 col-form-label">{{ __('Estatus') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="status" id="status">
                                                <option>-- selecciona una opcion --</option>
                                                <option value="0">inactivo</option>
                                                <option value="1" default>activo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Crear Categoria') }}</button>
                            </div>
                        </div>
                    </form>
                    <script>
                        function validarImagen() {
                            var fileSize = $('#imagen')[0].files[0].size;
                            var siezekiloByte = parseInt(fileSize / 1024);
                            if (siezekiloByte > $('#imagen').attr('size')) {
                                alert("Imagen muy grande");
                                return false;
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            console.log(fileName)
        });

        $(document).on("click", ".browse", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            var fileSize = e.target.files[0].size;
            if (fileSize > 200000) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'la imagen no puede pesar mas de 2mb',
                })
                e.preventDefault();
            } else {

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
