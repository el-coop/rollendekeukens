<p class="mt-3 title pt-1 has-text-red is-4">#RollendeKeukens</span></p>
<bottom-album @open-entry="modalData = $event" :entries="{{$bottomEntries->sortBy('order')->values()}}"></bottom-album>
