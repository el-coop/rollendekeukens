@component($typeForm,get_defined_vars())
    <div data-controller="fields--image-upload"
         data-fields--image-upload-url="{{ $value }}">
        <label class="image-upload">
            <input class="image-upload__input" type="file" name="{{ $name }}"
                   data-target="fields--image-upload.value"
                   data-action="fields--image-upload#change"
                   accept="image/*">
            <div class="image-upload__preview-wrapper d-none">
                <div class="image-upload__preview">
                    <img class="image-upload__preview-image">
                    <div type="button" class="image-upload__preview-label" data-action="click->fields--image-upload#clear">
                        <i class="image-upload__preview-label-icon icon-close"></i>
                        <span>Remove file</span>
                    </div>
                </div>
            </div>
            <div class="image-upload__no-preview-wrapper">
                <span class="image-upload__icon">
                        <i class="icon-cloud-upload"></i>
                    </span>
                <span class="has-text-centered">
                    Add image
                </span>
            </div>

        </label>
    </div>
@endcomponent
