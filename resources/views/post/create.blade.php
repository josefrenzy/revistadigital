@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'posts', 'title' => __('Material
Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="form-row">
                <div class="col-md-12 col-md-offset-2">
                    <form method="post" action="{{ route('posts.store') }}" class="needs-validation form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Crear nuevo Artículo') }}</h4>
                            </div>
                            <div class="card-body">
                                @include('flash-message')
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('Título') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                            <input class="form-control" input type="text" name="titulo"
                                                id="validationTooltip01" placeholder="{{ __('Titulo') }}"
                                                onkeyup="handleEvt(event)" required />
                                            <div class="invalid-tooltip">
                                                Please provide a valid state.
                                            </div>
                                            <span id="name-error" class="error text-danger"
                                                for="titulo">{{ $errors->first('old_password') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="slug">{{ __('Slug (único)') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="slug" id="slug"
                                                placeholder="{{ __('Slug') }}" value="" required />
                                            <div class="invalid-tooltip">
                                                Please provide a valid state.
                                            </div>
                                            <span id="name-error" class="error text-danger"
                                                for="slug">{{ $errors->first('old_password') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-sm-12" style="padding: 0 35%;background-color:rgb(211, 206, 206);">
                                        Datos del Abstract
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="descripcion">{{ __('Cuerpo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <textarea class="ckeditor form-control" name="descripcion" required></textarea>
                                        </div>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="img_abstract">{{ __('Imagen Abstract') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input type="file" class="custom-file-input" id="customFile" class="file"
                                                name="img_abstract" required>
                                            <label class="custom-file-label" for="customFile">Selecciona imagen para la
                                                portada</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-sm-12" style="padding: 0 35%;background-color:rgb(211, 206, 206);">
                                        Datos del Articulo
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-2 col-form-label"
                                        for="img_portada">{{ __('Imagen de Portada') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input type="file" class="custom-file-input2" id="customFile2" class="file"
                                                name="img_portada" required>
                                            <label class="custom-file-label" for="customFile2">Selecciona imagen
                                                para la portada</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="cuerpo">{{ __('Cuerpo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="editor">
                                            <textarea class="ckeditor form-control" name="cuerpo"></textarea>
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
                                    <label class="col-sm-2 col-form-label">{{ __('Autor') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name='user_id' required>
                                                <option value="0">-- Selecciona una opcion --</option>
                                                @foreach ($user_id as $user)
                                                    @if ($user->type == 0 || $user->type == 1)
                                                        <option value="{{ $user->id }}">{{ $user->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
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
                                                    @if ($cat->status == 1)
                                                        <option value={{ $cat->id }}>{{ $cat->nombre }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="type_post" class="col-sm-2 col-form-label">{{ __('Edicion: ') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select name="ediciones_id" id="ediciones_id" class="form-control" required>
                                                <option value="0">-- Selecciona una opcion --</option>
                                                @foreach ($ediciones as $item)
                                                    @if ($item->status == 1)
                                                        <option value="{{ $item->id }}">{{ $item->nombre }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="scope" class="col-sm-2 col-form-label">{{ __('Alcance') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="scope" id="scope" required>
                                                <option value="">-- selecciona una opción --</option>
                                                <option value="1">privado</option>
                                                <option value="0" default>público</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="visibility" class="col-sm-2 col-form-label">{{ __('Posición') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="visibility" id="visibility" required>
                                                <option value="">-- selecciona una opción --</option>
                                                <option value="1">1a fila</option>
                                                <option value="2">2a fila</option>
                                                <option value="3">3a fila</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Crear Post') }}</button>
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
    <script type="text/javascript">
        CKEDITOR.replace('editor');
        $("form").submit(function(e) {
            var messageLength = CKEDITOR.instances['descripcion'].getData().replace(/<[^>]*>/gi, '').length;
            if (!messageLength) {
                // alert('Agrega contenido para el abstract');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El campo de la descripcion del abstrac no puede ir vacio',
                })
                e.preventDefault();
            }
        });
        CKEDITOR.replace('editor');
        $("form").submit(function(e) {
            var messageLength = CKEDITOR.instances['cuerpo'].getData().replace(/<[^>]*>/gi, '').length;
            if (!messageLength) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El campo del cuerpo del articulo no puede ir vacio',
                })
                e.preventDefault();
            }
        });
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            console.log(fileName)
        });
        $(".custom-file-input2").on("change", function() {
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
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
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
