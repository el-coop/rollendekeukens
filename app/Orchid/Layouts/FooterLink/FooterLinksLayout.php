<?php

namespace App\Orchid\Layouts\FooterLink;

use App\Models\FooterLink;
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
            TD::set('url', __('panel.url'))
                ->loadModalAsync('footerLinkModal', 'saveLink', 'id', 'url'),
            
            
            TD::set('id', ' ')
                ->render(function (FooterLink $link) {
                    
                    $route = action('\App\Orchid\Screens\PlatformScreen@handle', [
                        'method' => $link->id,
                        'argument' => 'deleteLink'
                    ]);
                    
                    return view('platform.fields.deleteButton', compact('route'));
                }),
        ];
    }
}
