<nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
    <div class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="#">English|Nederlands</a>
        </div>
        <div class="navbar-end">
            <a class="navbar-item" href="#" target="_blank">
                <font-awesome-icon :icon="[ 'fab', 'facebook' ]" size="2x"/>
            </a>
            <a class="navbar-item" href="#" target="_blank">
                <font-awesome-icon :icon="[ 'fab', 'instagram' ]" size="2x"/>
            </a>
        </div>
    </div>
</nav>
<div class="container">
    <div class="columns is-centered">
        <div class="column is-three-fifths">
            <figure class="image is-2by1">
                <img class="site-logo" src="{{action('HomeController@logo')}}">
            </figure>
        </div>
    </div>
    <p>
        As a front end developer, more and more frequently I am given designs that include a horizontal scrolling component.
        This has become especially common on mobile to help reduce the vertical height of dense pages.
        We’ve all seen them before. Our comp has something like this:
    </p>
</div>

