<p class="mt-3 pt-1 title is-4">
    <a class="has-text-red" href="{{  $settings->get('instagram','') }}">#RollendeKeukens</a>
</p>
<bottom-album @open-entry="modalData = $event" :entries="{{$bottomEntries->sortBy('order')->values()}}"></bottom-album>
