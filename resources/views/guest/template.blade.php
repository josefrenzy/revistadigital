<div class="wrapper">
    @include('guest.components.navbar')
    {{-- <div class="main-panel"> --}}
    @yield('content')
    {{-- </div> --}}
    @include('guest.components.footer')
</div>
