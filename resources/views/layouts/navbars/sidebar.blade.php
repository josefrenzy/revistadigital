<div class="sidebar" data-color="orange" data-background-color="white"
    data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="{{ route('revista.index') }}" class="simple-text logo-normal">
            {{ __('Revista Digital') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            {{-- <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Laravel Examples') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li> --}}
            @if (auth()->user()->type == 0)
                <li class="nav-item{{ $activePage == 'user' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="material-icons">content_paste</i>
                        <p>{{ __('Usuarios') }}</p>
                    </a>
                </li>
                <li class="nav-item{{ $activePage == 'lectores' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('lectores.index') }}">
                        <i class="material-icons">library_books</i>
                        <p>{{ __('Lectores') }}</p>
                    </a>
                </li>
            @endif
            <li class="nav-item{{ $activePage == 'ediciones' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('ediciones.index') }}">
                    <i class="material-icons">bubble_chart</i>
                    <p>{{ __('Ediciones') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'categories' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="material-icons">location_ons</i>
                    <p>{{ __('Categorias') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'posts' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('posts.index') }}">
                    <i class="material-icons">notifications</i>
                    <p>{{ __('Articulos') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'capsula' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('capsula.index') }}">
                    <i class="material-icons">location_ons</i>
                    <p>{{ __('Capsula') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'flash' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('flash.index') }}">
                    <i class="material-icons">language</i>
                    <p>{{ __('Flash') }}</p>
                </a>
            </li>
            <li class="nav-item active-pro{{ $activePage == 'suscribe' ? ' active' : '' }}">
                <a class="nav-link text-white bg-success" href="{{ route('suscribe.index') }}">
                    <i class="material-icons text-white">unarchive</i>
                    <p>{{ __('Suscripciones') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
