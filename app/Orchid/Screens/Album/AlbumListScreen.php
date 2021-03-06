<?php

namespace App\Orchid\Screens\Album;

use Alert;
use App\Http\Requests\Album\AlbumReorderRequest;
use App\Http\Requests\Album\CreateAlbumRequest;
use App\Http\Requests\Album\DeleteAlbumRequest;
use App\Http\Requests\Album\UpdateAlbumRequest;
use App\Models\Album;
use App\Orchid\Fields\ModalButton;
use App\Orchid\Layouts\Album\AlbumLayout;
use App\Orchid\Layouts\Album\AlbumListLayout;
use App\Orchid\Layouts\Album\ThumbnailGallery;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class AlbumListScreen extends Screen {
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'panel.albums';
    
    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'panel.dashboard';
    
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array {
        return [
            'albums' => Album::orderBy('order')->get()->each(function ($item) {
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
            AlbumListLayout::class,
            Layout::modal('createAlbumModal', [
                AlbumLayout::class
            ])->rawClick()->title(__('panel.albumCreate'))->async('asyncAlbum')
        ];
    }
    
    public function asyncAlbum(Request $request) {
        $album = Album::find($request->input(0, 0));
        if (!$album) {
            $album = new Album;
        } else {
            $album->thumbnail = "/storage/{$album->thumbnail}";
        }
        return ['album' => $album];
    }
    
    public function create(CreateAlbumRequest $request) {
        $request->commit();
        Album::flushCache();
        Alert::success(__('album.created'));
        return back();
    }
    
    public function update(UpdateAlbumRequest $request) {
        $request->commit();
        Album::flushCache();
        Alert::success(__('album.updated'));
        return back();
    }
    
    public function delete(DeleteAlbumRequest $request) {
        $request->commit();
        Album::flushCache();
        Alert::success(__('album.deleted'));
        return back();
    }
    
    public function reorder(AlbumReorderRequest $request) {
        $request->commit();
        Album::flushCache();
        Alert::success(__('album.reordered'));
        return back();
    }
}
