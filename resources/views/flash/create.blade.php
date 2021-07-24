@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'flash.create', 'title' => __('Material
Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('flash.store') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Crear nuevo Flash') }}</h4>
                            </div>
                            <div class="card-body ">
                                @include('flash-message')
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('Título') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="titulo" id="titulo"
                                                placeholder="{{ __('Titulo') }}" onkeyup="handleEvt(event)" required />
                                            <span id="name-error" class="error text-danger" for="titulo"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="slug">{{ __('Slug (único)') }}</label>
                                    <div class="col-sm-7">
                                        {{-- slug de el articulo --}}
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="slug" id="slug"
                                                placeholder="{{ __('Slug') }}" value="" required />
                                            <span id="name-error" class="error text-danger"
                                                for="slug">{{ $errors->first('old_password') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="img_portada">{{ __('Imagen Flash') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input type="file" name="img_portada" class="file" accept="image/*">
                                            <div class="input-group my-3">
                                                <input type="text" class="form-control" disabled placeholder="Upload File"
                                                    id="file" required>
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
                                <div class="row">
                                    <label for="categorias_id"
                                        class="col-sm-2 col-form-label">{{ __('Categorias') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select name="categorias_id" id="categorias_id" class="form-control" required>
                                                <option value="0">-- Selecciona una opcion --</option>
                                                @foreach ($categories as $cat)
                                                    <option value={{ $cat->id }}>{{ $cat->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="position" class="col-sm-2 col-form-label">{{ __('Posición') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="position" id="position" required>
                                                <option value="">-- selecciona una opción --</option>
                                                <option value="1">1a fila</option>
                                                <option value="2">2a fila</option>
                                                <option value="3">3a fila</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="cuerpo">{{ __('Cuerpo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="editor">
                                            <textarea class="ckeditor form-control" id="ckeditor" name="cuerpo"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Crear Flash') }}</button>
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
        CKEDITOR.replace('editor');
        $("form").submit(function(e) {
            var messageLength = CKEDITOR.instances['ckeditor'].getData().replace(/<[^>]*>/gi, '').length;
            if (messageLength >= 1700) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Un flash debe tener un maximo de 1700 caracteres',
                })
                e.preventDefault();
            }
            if (!messageLength) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El campo del cuerpo del flash no puede ir vacio',
                })
                e.preventDefault();
            }
        });
        // var ck = CKEDITOR.instances["ckeditor"].element
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

        function handleEvt(e) {
            str = e.target.value
            str = str.replace(/^\s+|\s+$/g, ""); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "åàáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
            var to = "aaaaaaeeeeiiiioooouuuunc------";
            for (var i = 0, l = from.length; i < l; i++) {
                str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
            }
            str = str
                .replace(/[^a-z0-9 -]/g, "") // remove invalid chars
                .replace(/\s+/g, "-") // collapse whitespace and replace by -
                .replace(/-+/g, "-"); // collapse dashes
            console.log(str)
            $('#slug').val(str)
        }
    </script>
@endsection
