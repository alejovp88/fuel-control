@extends('layouts.base')

@section('layout-content')
    <div class="container" style="padding-top: 25vh; max-width: 35em; height: 100vh">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body rounded" style="background-color: #1a202c">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 mb-3"></div>

                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')

@endpush

@push('scripts')

@endpush
