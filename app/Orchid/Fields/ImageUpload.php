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
    
    public function render() {
        if (!$this->isSee()) {
            return;
        }
    
        $this->runBeforeRender();
        $this->checkRequired();
        $this->translate();
        $this->checkError();
    
        $id = $this->getId();
        $this->set('id', $id);
    
        $this->modifyName();
        $this->modifyValue();
    
        $errors = $this->getErrorsMessage();
       
        return view($this->view, array_merge($this->getAttributes(), [
            'attributes' => $this->getAllowAttributes(),
            'id' => $id,
            'old' => $this->getOldValue(),
            'slug' => $this->getSlug(),
            'oldName' => $this->getOldName(),
            'typeForm' => $this->typeForm ?? $this->vertical()->typeForm,
        ]))
            ->withErrors($errors);
    }
}
