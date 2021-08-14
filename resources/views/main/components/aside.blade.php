<div class="col-md-2 aside index d-none d-sm-none d-md-block">
    <div class="row">
        <div class="col">
            @if (sizeof($capsulas) == 0)
                <br>
                {{-- <p>No hay capsulas para mostrar</p> --}}
            @else
                @foreach ($capsulas as $item)
                    @if ($item->status == 1)
                        <div class="card aside">
                            <img class="card-img-top aside" src="{{ asset('images/capsulas/' . $item->img_capsula) }}"
                                alt="Card image">
                            <div class="card-body gray aside">
                                <h5 class="card-title text-uppercase capsulas">{{ $item->nombre }}</h5>
                                <div>{!! Illuminate\Support\Str::of($item->descripcion)->words(13) !!}</div>
                                <a class="link-capsula" href="{{ route('capsula.show', $item->id) }}">Leer mas...</a>
                            </div>
                        </div>

                    @endif

                    <hr>
                @endforeach
                <br>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5>Categorias</h5>
            @foreach ($categories as $cat)
                @if ($cat->status == 1)
                    <a href="{{ route('categories.show', $cat->nombre) }}">
                        <span class="badge badge-secondary">{{ $cat->nombre }}</span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <hr>
    <hr>
    <div class="row" style="padding: 1em">
        @foreach ($publicidad as $p)
            <img class="img-fluid" src="{{ asset('images/publicidad/' . $p->img_publicidad) }}" alt="profile Pic">
        @endforeach
    </div>
</div>
