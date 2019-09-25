<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Orchid\Screens\User\UserListScreen;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Actions\Link;

class PlatformScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'panel.home';
    
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'panel.dashboard';
    
    /**
     * Query data.
     *
     *
     * @return array
     */
    public function query(): array {
        return [
            'status' => Dashboard::checkUpdate(),
        ];
    }
    
    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array {
        return [
            Link::make('Users')
                ->href(action('\App\Orchid\Screens\User\UserListScreen@handle'))
                ->icon('icon-user'),
            
            Link::make('Site')
                ->href(env('APP_URL'))
                ->target('_blank')
                ->icon('icon-globe-alt'),
        ];
    }
    
    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array {
        return [
            Layout::view('platform::partials.update')
        ];
    }
}
