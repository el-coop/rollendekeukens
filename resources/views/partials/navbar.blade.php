<nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
    <div class="navbar-menu">
        <div class="navbar-start">
            <div class="navbar-item">
                <a href="{{action('LocaleController@set', 'en')}}">English</a>|<a
                    href="{{action('LocaleController@set', 'nl')}}">Nederlands</a>
            </div>
        </div>
        <div class="navbar-end">
            <a class="navbar-item" href="{{ $settings->get('facebook','') }}" target="_blank" rel="noreferrer">
                <font-awesome-icon :icon="[ 'fab', 'facebook' ]" size="2x"/>
            </a>
            <a class="navbar-item" href="{{ $settings->get('instagram','') }}" target="_blank" rel="noreferrer">
                <font-awesome-icon :icon="[ 'fab', 'instagram' ]" size="2x"/>
            </a>
            <a class="navbar-item" href="{{ $settings->get('pinterest','') }}" target="_blank" rel="noreferrer">
                <font-awesome-icon :icon="[ 'fab', 'pinterest' ]" size="2x"/>
            </a>
        </div>
    </div>
</nav>
