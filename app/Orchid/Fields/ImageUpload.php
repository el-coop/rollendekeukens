<?php


namespace App\Orchid\Fields;


use Orchid\Screen\Field;

class ImageUpload extends Field {
    /**
     * @var string
     */
    protected $view = 'platform.fields.imageUpload';
    
    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [
        'class' => 'form-control-file',
        'type' => 'file',
        'url'    => null,
    ];
    
    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [
        'accept',
        'multiple',
        'type',
        'value',
    ];
    
    /**
     * @param string|null $name
     *
     * @return self
     */
    public static function make(string $name = null): self {
        $input = (new static())->name($name);
        
        return $input;
    }
    
}
