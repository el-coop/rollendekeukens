<?php

namespace App\Orchid\Layouts\Album;

use App\Orchid\Fields\ImageUpload;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AlbumLayout extends Rows {
    /**
     * Views.
     *
     * @return Field[]
     */
    protected function fields(): array {
        return [
            Input::make('album.id')->type('hidden'),
            ImageUpload::make('album.thumbnail')
                ->title(__('panel.thumbnail')),
            Input::make('album.title')->type('text')
                ->required()
                ->max(255)
                ->horizontal()
                ->title(__('panel.title-en')),
            Input::make('album.title_nl')->type('text')
              ->required()
              ->max(255)
              ->horizontal()
              ->title(__('panel.title-nl'))

        ];
    }
}
