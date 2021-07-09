<div class="wrapper">
    @include('main.components.navbar')
    {{-- <div class="main-panel"> --}}
    @yield('content')
    {{-- </div> --}}
    @include('main.components.footer')
</div>
