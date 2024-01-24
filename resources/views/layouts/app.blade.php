@extends('layouts.base')

@section('layout-content')
    <div class="wrapper row">
        <div class="col-2 col-md-3 col-lg-2 col-xl-2">
            @include('partials.sidebar')
        </div>
        <div class="col-10 col-md-9 col-lg-10 col-xl-10 main-content-div">
            <div class="main">
                <main class="content">
                    @stack('before-content')
                    @yield('content')
                    @stack('after-content')
                </main>
            </div>
        </div>
        @stack('modals')

    </div>
@endsection
