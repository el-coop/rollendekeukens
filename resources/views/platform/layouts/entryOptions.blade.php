<div data-controller="layouts--entry-options">
    <div class="form-group">
        <select class="custom-select" name="type" data-action="layouts--entry-options#change">
            @foreach($manyForms as $name => $tab)
                <option value="{{$name}}" @if(stripos($entry->entry_type ?? '',$name) !== false) selected @endif>{{$name}}</option>
            @endforeach
        </select>
    </div>
    @foreach($manyForms as $name => $forms)
        <div class="entry-options-form {{$name}}">
            @foreach($forms as $form)
                {!! $form !!}
            @endforeach
        </div>
    @endforeach
</div>
