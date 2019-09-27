<?php

namespace App\Orchid\Layouts;

use App\Orchid\Fields\ImageUpload;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Picture;
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
            [
                Input::make('instagram')
                    ->type('text')
                    ->max(255)
                    ->title(__('panel.instagram')),
                
                Input::make('facebook')
                    ->type('text')
                    ->max(255)
                    ->title(__('panel.facebook')),
            ],
            TinyMCE::make('contact')
                ->title(__('panel.footer-contact'))
                ->theme('inlite'),
            
            Input::make('links-title')
                ->type('text')
                ->title(__('panel.footer-links-title')),
            ImageUpload::make('logo')
                ->title(__('panel.logo')),
    
    
            // Need to make a better system to save links
//            Matrix::make('links')
//                ->title(_('panel.footer-links'))
//                ->columns([__('panel.text'), __('panel.url')]),
            Button::make(__('panel.update'))
                ->class('btn btn-primary mx-auto')
                ->method('store')
        ];
    }
}
