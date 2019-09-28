<?php

namespace App\Orchid\Layouts\FooterLink;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class FooterLinkLayout extends Rows {
    /**
     * Views.
     *
     * @return Field[]
     */
    protected function fields(): array {
        return [
            Input::make('link.id')
                ->type('hidden'),
    
            Input::make('link.text')
                ->type('text')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('panel.text')),

            Input::make('link.url')
                ->type('url')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('panel.url'))
        ];
    }
}
