<div class="row suscribe">
    <div class="col-3"></div>
    <div class="col-6">
        <h3 class="titulo-azul text-center">Boletín informativo</h3>
        <p class="text-center">Suscribete para recibir antes que nadie las nuevas publicaciones</p>
        <hr>
        @include('flash-message')
        <form method="POST" action="{{ route('suscribe.store') }}">
            @csrf
            @method('post')
            <div class="row justify-content-center" style="padding-top:2rem;">
                <div class="col-lg-6">
                    <label class="sr-only" for="inlineFormInput">Name</label>
                    <input type="text" class="form-control mb-2 form-mail" name="email" id="email"
                        placeholder="Correo Electronico">
                    <div class="row justify-content-center">
                        <div class="col-lg-3">
                            <button type="submit" class="btn suscribe mb-2">Suscribirse</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>
