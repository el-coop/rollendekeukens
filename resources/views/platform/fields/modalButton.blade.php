@component($typeForm,get_defined_vars())
    <a type="submit"
       data-action="screen--base#targetModal"
       data-modal-title="{{ $title ?? '' }}"
       data-modal-async="true"
       data-modal-key="{{$modal ?? ''}}"
       data-modal-params='@json($attributes)'
       data-modal-action="{{route($route ?? Route::currentRouteName())}}/{{$method}}"

       @if(!is_null($confirm))onclick="return confirm('{{$confirm}}');"@endif
        @include('platform::partials.fields.attributes', ['attributes' => $attributes])>
        @isset($icon)<i class="{{ $icon }} m-r-xs"></i>@endisset
        {{ $name ?? '' }}
    </a>
@endcomponent
