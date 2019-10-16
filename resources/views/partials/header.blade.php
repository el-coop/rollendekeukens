<div class="columns">
    <div class="column is-4">
        <img class="site-logo" src="{{action('HomeController@logo')}}">
    </div>
    <div class="column">
        <div class="content">
            {!!  $settings->get('contact')  !!}
        </div>
    </div>
</div>
