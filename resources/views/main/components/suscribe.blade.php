<div class="row suscribe">
    <div class="col-3"></div>
    <div class="col-6">
        <h3 class="titulo-azul text-center">Boletín informativo</h3>
        <hr>
        <p class="text-center">Suscribete para recibir antes que nadie las nuevas publicaciones</p>
        @include('flash-message')
        <form method="POST" action="{{ route('suscribe.store') }}">
            @csrf
            @method('post')
            <div class="form-row align-items-center" style="padding: 0 4em;">
                <div class="col-auto">
                    <label class="sr-only" for="inlineFormInput">Name</label>
                    <input type="text" class="form-control mb-2 form-mail" name="email" id="email"
                        placeholder="Correo Electronico">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn suscribe mb-2">Suscribirse</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>