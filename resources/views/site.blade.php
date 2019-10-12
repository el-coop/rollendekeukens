@extends('layouts.plain')
@section('body')
    <div class="container">
        @include('partials.navbar')
        <div class="section">
            @include('partials.header')
            <albums :albums="{{$albums}}"></albums>
            <album-entries :entries="{{$entries}}"></album-entries>
            @include('partials.footer')
        </div>
    </div>
@endsection
