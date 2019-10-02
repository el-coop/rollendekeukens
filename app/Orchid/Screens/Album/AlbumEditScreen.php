<?php

namespace App\Orchid\Screens\Album;

use Alert;
use App\Http\Requests\Album\DeleteAlbumRequest;
use App\Http\Requests\Album\UpdateAlbumRequest;
use App\Models\Album;
use App\Orchid\Layouts\Album\AlbumLayout;
use App\Orchid\Layouts\Album\EntryLayout;
use App\Orchid\Layouts\Album\EntryListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class AlbumEditScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'panel.album';
    
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'panel.dashboard';
    
    /**
     * Query data.
     * @param Album
     * @return array
     */
    public function query(Album $album): array {
        
        return [
            'entries' => $album->entries
        ];
    }
    
    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array {
        return [
            Link::make(__('panel.users'))
                ->href(action('\App\Orchid\Screens\User\UserListScreen@handle'))
                ->icon('icon-user'),
            Link::make(__('panel.settingsTab'))
                ->href(action('\App\Orchid\Screens\PlatformScreen@handle'))
                ->icon('icon-picture'),
            Link::make(__('panel.albums'))
                ->href(action('\App\Orchid\Screens\Album\AlbumListScreen@handle'))
                ->icon('icon-picture'),
            
            Link::make(__('panel.site'))
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
            EntryListLayout::class,
            Layout::modal('entryModal', [
                EntryLayout::class
            ])->title(__('panel.entryCreate'))->async('asyncEntry')
        ];
    }
    
    
    public function asyncEntry(Request $request) {
        $entry = Album::find($request->input(0, 0));
        if (!$entry) {
            $entry = new Entry;
        }
        $entry->thumbnail = $entry->link;
        return ['$entry' => $entry];
    }
    
    public function save(UpdateAlbumRequest $request) {
        $request->commit();
        Alert::info(__('album updated.'));
        return redirect()->back();
        
    }
    
    public function remove(DeleteAlbumRequest $request) {
        $request->commit();
        return redirect()->route('platform.albums');
    }
}
