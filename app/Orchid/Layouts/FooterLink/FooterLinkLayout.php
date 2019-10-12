<?php

namespace App\Orchid\Layouts\FooterLink;

use App\Orchid\Fields\ImageUpload;
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
			ImageUpload::make('link.logo')
				->title(__('panel.logo')),

            Input::make('link.url')
                ->type('url')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('panel.url'))
        ];
    }
}
