@extends('layouts.admin')

@section('adminContent')
    <div class="col-md-12 mt-4">

        <router-link to="/page/create">
            <button class="btn btn-success btn-sm mb-4">Create Page</button>
        </router-link>

        <router-view name="PageIndex"></router-view>
        <router-view></router-view>
    </div>
@endsection
