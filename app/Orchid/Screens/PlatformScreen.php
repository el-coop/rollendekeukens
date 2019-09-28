<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Alert;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\SiteSetting;
use App\Orchid\Layouts\SiteSettingsLayout;
use App\Orchid\Screens\User\UserListScreen;
use Illuminate\Http\Request;
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
        
        $settings = SiteSetting::select('value','key')->get()->pluck('value','key');

        return [
            'status' => Dashboard::checkUpdate(),
            'instagram' => $settings->get('instagram',''),
            'facebook' => $settings->get('facebook',''),
            'contact' => $settings->get('contact',''),
            'links-title' => $settings->get('links-title',''),
            'logo' => $settings->get('logo',false) ? action('HomeController@logo') : '',
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
            SiteSettingsLayout::class,
            Layout::view('platform::partials.update')
        ];
    }
    
    
    public function store(UpdateSettingsRequest $request) {
        $request->commit();
        Alert::success('Settings saved.');
        return back();
    }
}
