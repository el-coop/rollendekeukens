<hr>
<div class="footer-links">
    @foreach($footerLinks as $footerLink)
        @component('partials.components.footerLink', ['footerLink' => $footerLink])
        @endcomponent
    @endforeach
</div>
