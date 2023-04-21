<hr>
<div class="footer-links">
    @foreach($footerLinks as $footerLink)
        @component('partials.components.footerLink', ['footerLink' => $footerLink])
        @endcomponent
    @endforeach
</div>
@if($settings->get('email',false))
    <div>
        <a class="footer-email" href="mailto:{{  $settings->get('email') }}">Contact: {{ $settings->get('email') }}</a>
    </div>
@endif
