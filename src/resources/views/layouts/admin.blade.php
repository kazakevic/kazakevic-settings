@extends('settings::layouts.app')

@section('content')
    @php
        $route = Route::currentRouteName();
    @endphp

    <div class="container mt-5 p-0">
        <br>
        <div class="row">
            @yield('adminContent')
        </div>
    </div>

@endsection
