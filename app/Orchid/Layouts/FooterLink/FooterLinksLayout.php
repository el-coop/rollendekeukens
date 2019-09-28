<?php

namespace App\Orchid\Layouts\FooterLink;

use Orchid\Platform\Models\User;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FooterLinksLayout extends Table {
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'links';
    
    /**
     * @return TD[]
     */
    protected function columns(): array {
        
        return [

            TD::set('text', __('panel.text'))
                ->loadModalAsync('footerLinkModal', 'saveLink', 'id','text'),

            TD::set('url', __('panel.url'))
                ->loadModalAsync('footerLinkModal', 'saveLink', 'id','url')
        ];
    }
}
