@extends('layouts.app', ['activePage' => 'post', 'titlePage' => __('Index Post')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('posts.update', $post->id) }}" class="form-horizontal">
                        @csrf
                        @method('put')
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Editar Post') }}</h4>
                            </div>
                            <div class="card-body ">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    <img src="images/{{ Session::get('image') }}">
                                @endif
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="title">{{ __('Título') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                            <input class="form-control" type="text" name="titulo" id="titulo"
                                                placeholder="{{ __('Titulo') }}" value="{{ $post->titulo }}"
                                                onkeyup="handleEvt(event)" required />
                                            <span id="name-error" class="error text-danger"
                                                for="titulo">{{ $errors->first('old_password') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label" for="slug">{{ __('Slug') }}</label>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="slug" id="slug"
                                                placeholder="{{ __('Slug') }}" value="{{ $post->slug }}"  />
                                            {{-- <span id="name-error" class="error text-danger"
                                                for="slug">{{ $errors->first('old_password') }}</span> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-sm-12" style="padding: 0 35%;background-color:rgb(211, 206, 206);">
                                        {{-- <div class="card-header" style="padding: 0 35%;background-color:gray;"> --}}
                                        --> Datos del Abstract <-- {{-- </div> --}} </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label"
                                            for="descripcion">{{ __('Abstract') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <textarea class="ckeditor form-control" name="descripcion">
                                                        {{ $abstract->descripcion }}
                                                    </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label"
                                            for="img_abstract">{{ __('Imagen Abstract') }}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input type="file" class="custom-file-input" id="customFile" class="file"
                                                        name="img_abstract">
                                                    <label class="custom-file-label" for="customFile">{{ $abstract->img_abstract }}</label>
                                                {{-- <input type="file" name="img_abstract" class="file-abstract" accept="image/*" multiple>
                                                <div class="input-group my-3">
                                                    <input type="text" class="form-control" disabled
                                                        placeholder="Upload File" id="file-abstract"
                                                        value="{{ $abstract->img_abstract }}">
                                                    <div class="input-group-append">
                                                        <button type="button"
                                                            class="browse-abstract btn btn-primary">Browse...</button>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row" style="padding: 0 20rem;">
                                        <div class="doc">
                                            <div class="col-sm-12 box">
                                                <img src="{{ asset('images/' . $abstract->img_abstract) }}" id="preview-abstract"
                                                    class="img-thumbnail" style="max-width:50%;">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-md-sm-12"
                                            style="padding: 0 35%;background-color:rgb(211, 206, 206);">
                                            --> Datos del Artículo <-- </div>
                                        </div>
                                        <div class="row">
                                            <label for="estatus"
                                                class="col-sm-2 col-form-label">{{ __('Estatus') }}</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="">-- selecciona una opción --</option>
                                                        <option value="1">activo</option>
                                                        <option value="0">inactivo</option>
                                                    </select>
                                                    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                                                                        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                                                                        crossorigin="anonymous">
                                                    </script>
                                                    <script>
                                                        $(function() {
                                                            $("#status").val({{ $post->status }})
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label"
                                                for="img_abstract">{{ __('Imagen de la Portada') }}</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <input type="file" class="custom-file-input2" id="customFile2" class="file"
                                                        name="img_portada">
                                                    <label class="custom-file-label" for="customFile2" >{{$post->img_portada}}</label>
                                                    {{-- <input type="file" name="img_portada" class="file-portada"accept="image/*" multiple>
                                                    <div class="input-group my-3">
                                                        <input type="text" class="form-control" disabled
                                                            placeholder="Upload File" id="file-portada"
                                                            value="{{  }}">
                                                        <div class="input-group-append">
                                                            <button type="button"
                                                                class="browse-portada btn btn-primary">Browse...</button>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row" style="padding: 0 20rem;">
                                            <div class="col-sm-12">
                                                <img src="{{ asset('images/' . $post->img_portada) }}" id="preview-portada"
                                                    class="img-thumbnail" style="max-width:50%;">
                                            </div>
                                        </div> --}}
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('User ID') }}</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <select class="form-control" name='user_id' id="user_id">
                                                        <option value="0">-- Selecciona una opcion --</option>
                                                        @foreach ($user_id as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                                                                        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                                                                        crossorigin="anonymous">
                                                    </script>
                                                    <script>
                                                        $(function() {
                                                            $("#user_id").val({{ $post->user_id }})
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="categorias_id"
                                                class="col-sm-2 col-form-label">{{ __('Category') }}</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <select name="categorias_id" id="categorias_id" class="form-control">
                                                        <option value="0">-- Selecciona una opcion --</option>
                                                        @foreach ($categories as $cat)
                                                            @if ($cat->status == 1)
                                                                <option value={{ $cat->id }}>{{ $cat->nombre }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                                                                        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                                                                        crossorigin="anonymous">
                                                    </script>
                                                    <script>
                                                        $(function() {
                                                            $("#categorias_id").val({{ $post->categorias_id }})
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="type_post"
                                                class="col-sm-2 col-form-label">{{ __('Edicion: ') }}</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <select name="ediciones_id" id="ediciones_id" class="form-control">
                                                        <option value="0">-- Selecciona una opcion --</option>
                                                        @foreach ($ediciones as $item)
                                                            @if ($item['status'] == 1)
                                                                <option value="{{ $item->id }}">{{ $item->nombre }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                                                                        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                                                                        crossorigin="anonymous">
                                                    </script>
                                                    <script>
                                                        $(function() {
                                                            $("#ediciones_id").val({{ $post->ediciones_id }})
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="scope"
                                                class="col-sm-2 col-form-label">{{ __('Alcance') }}</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <select class="form-control" name="scope" id="scope">
                                                        <option value="">-- selecciona una opción --</option>
                                                        <option value="1">privado</option>
                                                        <option value="0" default>público</option>
                                                    </select>
                                                    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                                                                        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                                                                        crossorigin="anonymous">
                                                    </script>
                                                    <script>
                                                        $(function() {
                                                            $("#scope").val({{ $post->scope }})
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="visibility"
                                                class="col-sm-2 col-form-label">{{ __('Publicado\Borrador') }}</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <select class="form-control" name="visibility" id="visibility">
                                                        <option value="">-- selecciona una opción --</option>
                                                        <option value="1">publicado</option>
                                                        <option value="0" default>borrador</option>
                                                    </select>
                                                    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                                                                        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                                                                        crossorigin="anonymous">
                                                    </script>
                                                    <script>
                                                        $(function() {
                                                            $("#visibility").val({{ $post->visibility }})
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label"
                                                for="cuerpo">{{ __('Cuerpo') }}</label>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <textarea class="ckeditor form-control" name="cuerpo"
                                                        id="cuerpo">{{ $post->cuerpo }}</textarea>
                                                    <script src="https://code.jquery.com/jquery-3.2.0.min.js"
                                                        integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
                                                                                                        crossorigin="anonymous">
                                                    </script>
                                                    <script>
                                                        $(function() {
                                                            var cuerpo = {{ $post->cuerpo }};
                                                            document.getElementById("input_cuerpo").value(
                                                                {{ $post->cuerpo }})
                                                            document.getElementById("cuerpo").innerHTML = cuerpo;
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer ml-auto mr-auto">
                                        <button type="submit"
                                            class="btn btn-primary">{{ __('Actualizar Post') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        //Me permite cargar la imagen
        $(document).on("click", ".browse-abstract", function() {
            // obteniendo el valor del input file con clase file-absrtract∂
            var file = $(this).parents().find(".file-abstract");
            file.trigger("click");
            
        });
        // obteniedo el valor del input file
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            
            $("#file_abstract").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview-abstract").src = e.target.result;
                // e.target.value = ''
            };
            
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on("click", ".browse-portada", function() {
            var file = $(this).parents().find(".file-portada");
            file.trigger("click");
        });
        // var fileInput = document.getElementById("img_portada");

        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[1].name;
            $("#file-portada").val(fileName);
            // $("#file-abstract").val(fileName);
            console.log(e.target.files[1].name)
            // console.log($("#file-abstract").val(fileName))
            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview-portada").src = e.target.result;
                // e.target.value = ''
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

        $(document).ready(function() {
            $('.ckeditor').ckeditor();
            $("#ediciones_id").val({{ $post->ediciones_id }})
        });

        function handleEvt(e) {
            console.log(e.target.value)
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
