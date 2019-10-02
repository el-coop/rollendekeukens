<div class="thumbnail-gallery">
    <button class="card thumbnail-gallery__add thumbnail-gallery__entry rounded-circle"
            data-action="screen--base#targetModal"
            data-modal-async="true"
            data-modal-key="{{$modal}}"
            data-modal-params='{}'
            data-modal-action="{{route($route ?? Route::currentRouteName())}}/{{$method}}">
            <span class="text-center">
                <i class="icon-plus"></i><br>
                Add
            </span>
    </button>
    @foreach($entries as $entry)
        <a class="thumbnail-gallery__entry"
             data-action="screen--base#targetModal"
             data-modal-async="true"
             data-modal-key="{{ $modal }}"
             data-modal-action="{{route($route ?? Route::currentRouteName())}}/{{$updateMethod}}"
             data-modal-params="[{{ $entry->id }}]">
            <img src="{{ $entry->$src }}" class="thumbnail-gallery__entry-image rounded-circle">
            <div class="text-center text-muted mt-1">{{ $entry->title }}</div>
        </a>
    @endforeach
</div>
