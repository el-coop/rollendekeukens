@extends('layouts.plain')
@section('body')
    <div class="container">
        @include('partials.navbar')
        <div class="section">
            @include('partials.header')
            <albums :albums="{{$albums->sortBy('order')->values()}}" @open-entry="modalData = $event"></albums>
            <album-entries @open-entry="modalData = $event"
                           :entries="{{$displayEntries->sortBy('order')->values()}}"></album-entries>
            @include('partials.bottomAlbum')
            @include('partials.footer')
        </div>
    </div>
    <modal v-if="modalData != null" @close-modal="modalData = null">
        <component :is="modalData.component" :data="modalData"></component>
    </modal>
@endsection
