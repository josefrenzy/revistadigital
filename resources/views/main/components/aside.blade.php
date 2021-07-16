<div class="col-md-2 aside index">
    <div class="row">
        <div class="col">
            <h5 class="aside titulo-azul">Capsulas</h5>
            <br>
            @foreach ($capsulas as $item)
                <div class="card aside">
                    <img class="card-img-top aside" src="{{ asset('images/' . $item->img_capsula) }}"
                        alt="Card image">
                    <div class="card-body gray aside">
                        <h4 class="card-title text-uppercase capsulas">{{ $item->nombre }}</h4>
                        <div>{!! Illuminate\Support\Str::of($item->descripcion)->words(13) !!}</div>
                        <a class="link-capsula" href="{{route('capsula.show', $item->id)}}">Leer mas...</a>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5>Categorias</h5>
            @foreach ($categories as $cat)
                <span class="badge badge-secondary">{{ $cat->nombre }}</span>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <h5>Comentarios</h5>
        </div>
    </div>
    <hr>
    <div class="row" style="padding: 1em">
        <img class="img-fluid" src="{{ asset('images/publicidad/publicidad.png') }}" alt="profile Pic">
    </div>
</div>