<div class="columns">
    <div class="column is-4">
        <img class="site-logo" src="/storage/{{ $settings->get('logo') }}" alt="{{ config('app.name') }}">
    </div>
    <div class="column">
        <div class="content">
            {!!  $settings->get('contact_' . App::getLocale())  !!}
        </div>
    </div>
</div>
