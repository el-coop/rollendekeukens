<?php

namespace App\Orchid\Screens\Album;

use Alert;
use App\Http\Requests\Album\CreateEntryRequest;
use App\Http\Requests\Album\DeleteAlbumRequest;
use App\Http\Requests\Album\DeleteEntryRequest;
use App\Http\Requests\Album\EntryReorderRequest;
use App\Http\Requests\Album\UpdateAlbumRequest;
use App\Http\Requests\Album\UpdateEntryRequest;
use App\Models\Album;
use App\Models\AlbumEntry;
use App\Models\AlbumText;
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
            'entries' => $album->entries()->orderBy('order')->get()->each(function ($item) {
                $item->src = $item->preview;
            })
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
                ->turbolinks(false)
                ->icon('icon-user'),
            Link::make(__('panel.settingsTab'))
                ->href(action('\App\Orchid\Screens\PlatformScreen@handle'))
                ->turbolinks(false)
                ->icon('icon-picture'),
            Link::make(__('panel.albums'))
                ->href(action('\App\Orchid\Screens\Album\AlbumListScreen@handle'))
                ->turbolinks(false)
                ->icon('icon-picture'),
            
            Link::make(__('panel.site'))
                ->href(env('APP_URL'))
                ->turbolinks(false)
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
            ])->rawClick()->title(__('panel.entryCreate'))->async('asyncEntry')
        ];
    }
    
    
    public function asyncEntry(Request $request) {
        $entry = AlbumEntry::find($request->input(0, 0));
        if (!$entry) {
            $entry = new AlbumEntry;
        } else {
            if($entry->image ){
                $entry->image = "/storage/{$entry->image}";
            }
            $entry->text_en = $entry->entry->text_en;
            $entry->text_nl = $entry->entry->text_nl;
            $entry->video = $entry->entry->url;
        }
        return ['entry' => $entry];
    }
    
    public function save(CreateEntryRequest $request) {
        $request->commit();
        Album::flushCache();
        AlbumEntry::flushCache();
        Alert::info(__('entry.created'));
        return redirect()->back();
    }
    
    public function update(UpdateEntryRequest $request) {
        $request->commit();
        Album::flushCache();
        AlbumEntry::flushCache();
        Alert::success(__('entry.updated'));
        return back();
    }
    
    public function delete(DeleteEntryRequest $request) {
        $request->commit();
        Album::flushCache();
        AlbumEntry::flushCache();
		Alert::success(__('entry.deleted'));
		return redirect()->back();
    }
    
    public function reorder(EntryReorderRequest $request) {
        $request->commit();
        Album::flushCache();
        Alert::success(__('entry.reordered'));
        return back();
    }
}
