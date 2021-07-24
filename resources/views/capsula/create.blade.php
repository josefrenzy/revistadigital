{@extends('layouts.app',['class' => 'off-canvas-sidebar', 'activePage' => 'capsula', 'title' => __('Crear Capsula')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('capsula.store') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Agregar Capsula') }}</h4>
                            </div>
                            <div class="card-body ">
                                @include('flash-message')
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="nombre">{{ __('Nombre') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="nombre" id="nombre"
                                                required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="descripcion">{{ __('Cuerpo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="editor">
                                            <textarea class="ckeditor form-control" id="ckeditor"
                                                name="descripcion"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="img_capsula">{{ __('Imagen Capsula') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input type="file" name="img_capsula" class="file" accept="image/*" required>
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
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="">-- selecciona una opción --</option>
                                                <option value="1">activo</option>
                                                <option value="0" default>inactivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Crear Capsula') }}</button>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
        $(document).on("click", ".browse", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });
        CKEDITOR.replace('editor');
        $("form").submit(function(e) {
            var messageLength = CKEDITOR.instances['ckeditor'].getData().replace(/<[^>]*>/gi, '').length;
            if (messageLength >= 500 || messageLength < 100) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Una capsula debe tener un maximo de 500 caracteres y minimo 100',
                })
                // alert('un Flash debe tener un maximo de 1700 caracteres(1 Cuartilla)');
                e.preventDefault();
            }
            if (messageLength === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Una capsula debe tener algo',
                })
                // alert('un Flash debe tener un maximo de 1700 caracteres(1 Cuartilla)');
                e.preventDefault();
            }

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
