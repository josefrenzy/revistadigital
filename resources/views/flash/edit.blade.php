@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'flash.edit', 'title' => __('Material
Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('flash.update', $flash->id) }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Editar Flash') }}</h4>
                            </div>
                            <div class="card-body ">
                                @include('flash-message')
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('Título') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="titulo" id="titulo"
                                                placeholder="{{ __('Titulo') }}" onkeyup="handleEvt(event)"
                                                value="{{ $flash->titulo }}" required />
                                            <span id="name-error" class="error text-danger" for="titulo"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="slug">{{ __('Slug (único)') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" input type="text" name="slug" id="slug"
                                                placeholder="{{ __('Slug') }}" value="{{ $flash->slug }}" required />
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
                                                    id="file" value="{{ $flash->img_portada }}">
                                                <div class="input-group-append">
                                                    <button type="button"
                                                        class="browse btn btn-primary">Selecciona...</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding: 0 20rem;">
                                    <div class="doc">
                                        <div class="col-sm-12 box">
                                            <img src="{{ asset('images/flash/' . $flash->img_portada) }}" id="preview"
                                                class="img-thumbnail" style="max-width:50%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="estatus" class="col-sm-2 col-form-label">{{ __('Estatus') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select class="form-control" name="status" id="status">
                                                <option value="">-- selecciona una opción --</option>
                                                <option value="1">activo</option>
                                                <option value="0" default>inactivo</option>
                                            </select>
                                            <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                                                        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                                                        crossorigin="anonymous">
                                            </script>
                                            <script>
                                                $(function() {
                                                    $("#status").val({{ $flash->status }})
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="categorias_id"
                                        class="col-sm-2 col-form-label">{{ __('Categorias') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <select name="categorias_id" id="categorias_id" class="form-control">
                                                <option value="0">-- Selecciona una opcion --</option>
                                                @foreach ($categories as $cat)
                                                    <option value={{ $cat->id }}>{{ $cat->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" 
                                                crossorigin="anonymous">
                                            </script>
                                            <script>
                                                $(function() {
                                                    $("#categorias_id").val({{ $flash->categorias_id }})
                                                });
                                            </script>
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
                                            <script src="https://code.jquery.com/jquery-3.2.0.min.js" 
                                                integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" 
                                                crossorigin="anonymous">
                                            </script>
                                            <script>
                                                $(function() {
                                                    $("#position").val({{ $flash->position }})
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="cuerpo">{{ __('Cuerpo') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <textarea class="ckeditor form-control"
                                                name="cuerpo">{{ $flash->cuerpo }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Editar Flash') }}</button>
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
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
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
