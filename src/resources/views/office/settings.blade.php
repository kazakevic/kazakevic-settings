@extends('settings::layouts.admin')

@section('adminContent')
    <div class="col-md-12 mt-4">
        <router-view name="settingsIndex"></router-view>
        <router-view></router-view>
    </div>
@endsection
