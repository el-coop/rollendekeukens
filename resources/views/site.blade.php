@extends('layouts.plain')
@section('body')
    <div class="container">
        @include('partials.header')
        <albums :albums="{{$albums}}"></albums>
        <album-entries :entries="{{$entries}}"></album-entries>
        @include('partials.footer');
    </div>
@endsection
