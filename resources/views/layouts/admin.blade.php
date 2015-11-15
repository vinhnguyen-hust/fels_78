@extends('layouts.root')
@section('content-layout')
    <div class="container">
        @include('layouts.partials._admin_nav')
        @include('admin.search.search')
        @include('flash::message')
        @yield('content')
        @include('layouts.partials._footer')
    </div>
@stop
