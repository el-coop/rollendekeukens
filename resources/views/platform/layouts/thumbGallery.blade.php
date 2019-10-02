<div id="vue">
    <button class="card thumbnail-gallery__add thumbnail-gallery__entry {{ $class }}"
            data-action="screen--base#targetModal"
            data-modal-async="true"
            data-modal-key="{{$modal}}"
            data-modal-params='{}'
            data-modal-action="{{\URL::current()}}/{{$createMethod}}">
            <span class="text-center">
                <i class="icon-plus"></i><br>
                Add
            </span>
    </button>
    <drag-n-drop :init-entries="{{ $entries }}" class="thumbnail-gallery" url="{{\URL::current()}}/{{$reorderMethod}}">
        <template #default="{entries}">
            <div class="thumbnail-gallery__entry" v-for="entry in entries" :key="entry.id">
                <a
                    @if(! $link)
                    data-action="screen--base#targetModal"
                    data-modal-async="true"
                    data-modal-key="{{ $modal }}"
                    data-modal-action="{{\URL::current()}}/{{$updateMethod}}"
                    :data-modal-params="`[${entry.id}]`"
                    @else
                    data-turbolinks="true"
                    :href="'{{$link}}'.replace('{id}',entry.id)"
                    @endif>
                    <img :src="entry.src" class="thumbnail-gallery__entry-image {{ $class }}">
                </a>
                <div class="text-center text-muted mt-1">
                    <button :formaction="`{{\URL::current()}}/${entry.id}/{{$deleteMethod}}`"
                            class="btn btn-danger"><i class="icon-trash"></i></button>
                    <a data-action="screen--base#targetModal"
                       data-modal-async="true"
                       data-modal-key="{{ $modal }}"
                       data-modal-action="{{\URL::current()}}/{{$updateMethod}}"
                       :data-modal-params="`[${entry.id}]`"
                       v-text="entry.title"
                    >
                    </a>
                </div>
            </div>
        </template>
    </drag-n-drop>
</div>
