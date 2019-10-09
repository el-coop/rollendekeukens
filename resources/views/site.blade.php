@extends('layouts.plain')
@section('body')
    <div class="columns is-centered">
        <div class="column is-two-fifths-desktop">
            @include('partials.header')
            <albums :albums="{{$albums}}"></albums>
            <entries :entries="{{$entries}}"></entries>
        </div>
    </div>
@endsection
