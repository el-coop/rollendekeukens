<div class="section">
    <hr>
    <div class="columns is-centered">
        <div class="column is-four-fifths">
            <div class="level is-mobile">
                @foreach($footerLinks as $footerLink)
                    @component('partials.components.footerLink', ['footerLink' => $footerLink])
                    @endcomponent
                @endforeach
            </div>
        </div>
    </div>
</div>
