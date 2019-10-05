<?php


namespace App\Orchid\Fields;


use Orchid\Screen\Actions\Button;

class ModalButton extends Button {
    /**
     * @var string
     */
    protected $view = 'platform.fields.modalButton';
    
    protected $attributes = [
        'class' => 'btn btn-link',
        'novalidate' => false,
        'method' => null,
        'icon' => null,
        'action' => null,
        'confirm' => null,
        'modal' => null,
        'parameters' => [],
    ];
}
