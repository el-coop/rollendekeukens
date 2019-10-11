@extends('layouts.plain')
@section('body')
    <div class="container">
        @include('partials.header')
        <albums :albums="{{$albums}}"></albums>
        <entries :entries="{{$entries}}"></entries>
        @include('partials.footer');
    </div>
@endsection
