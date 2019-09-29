<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Alert;
use App\Http\Requests\UpdateSettingsRequest;
use App\Models\FooterLink;
use App\Models\SiteSetting;
use App\Orchid\Fields\ModalButton;
use App\Orchid\Layouts\FooterLink\FooterLinkLayout;
use App\Orchid\Layouts\FooterLink\FooterLinksLayout;
use App\Orchid\Layouts\SiteSettingsLayout;
use App\Orchid\Screens\User\UserListScreen;
use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
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
        
        $settings = SiteSetting::select('value', 'key')->get()->pluck('value', 'key');
        $links = FooterLink::paginate();
        return [
            'status' => Dashboard::checkUpdate(),
            'instagram' => $settings->get('instagram', ''),
            'facebook' => $settings->get('facebook', ''),
            'contact' => $settings->get('contact', ''),
            'links-title' => $settings->get('links-title', ''),
            'logo' => $settings->get('logo', false) ? action('HomeController@logo') : '',
            'links' => $links
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
			Link::make('Albums')
				->href(action('\App\Orchid\Screens\Album\AlbumListScreen@handle'))
				->icon('icon-picture'),
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
            
            Layout::tabs([
                __('panel.settingsTab') => SiteSettingsLayout::class,
                __('panel.linksTab') => Layout::blank([
                    FooterLinksLayout::class,
                    Layout::rows([
                        ModalButton::make(__('panel.add-footer-link'))
                            ->modal('footerLinkModal')
                            ->method('saveLink')
                            ->class('btn btn-primary mb-5')
                            ->right(),
                    ]),
                ])
            ]),
            
            Layout::modal('footerLinkModal', [
                FooterLinkLayout::class
            ])->title(__('panel.linkModalTitle'))->async('asyncFooterLink'),
            Layout::view('platform::partials.update')
        ];
    }
    
    public function asyncFooterLink(Request $request): array {
        $footerLink = FooterLink::find($request->input(0, 0));
        if (!$footerLink) {
            $footerLink = new FooterLink;
        }
        
        return [
            'link' => $footerLink,
        ];
    }
    
    public function saveLink(Request $request) {
        $link = $request->input('link');
        $footerLink = new FooterLink;
        if (isset($link['id'])) {
            $footerLink = FooterLink::find($link['id']);
        }
        
        $footerLink->url = $link['url'];
        $footerLink->text = $link['text'];
        $footerLink->save();
        
        Alert::info(__('Link was saved.'));
        return back();
    }
    
    public function store(UpdateSettingsRequest $request) {
        $request->commit();
        Alert::success('Settings saved.');
        return back();
    }
}
