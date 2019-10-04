<?php

namespace App\Orchid\Layouts;

use App\Models\Album;
use App\Orchid\Fields\ImageUpload;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TinyMCE;
use Orchid\Screen\Layouts\Rows;

class SiteSettingsLayout extends Rows {
    
    /**
     * Views.
     *
     * @return Field[]
     */
    protected function fields(): array {
        
        return [
            ImageUpload::make('logo')
                ->title(__('panel.logo')),
            [
                Input::make('instagram')
                    ->type('url')
                    ->max(255)
                    ->title(__('panel.instagram')),
                
                Input::make('facebook')
                    ->type('url')
                    ->max(255)
                    ->title(__('panel.facebook')),
            ],
            TinyMCE::make('contact')
                ->title(__('panel.footer-contact'))
                ->theme('inlite'),
            
            Input::make('links-title')
                ->type('text')
                ->title(__('panel.footer-links-title')),
			Select::make('display-album')
				->type('select')
				->fromModel(Album::class, 'title')
				->title(__('panel.displayAlbum')),
            Button::make(__('panel.update'))
                ->method('store')
                ->type(Button::PRIMARY)

        ];
    }
}
