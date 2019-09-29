<?php

namespace App\Orchid\Screens\Album;

use Alert;
use App\Http\Requests\Album\DeleteAlbumRequest;
use App\Http\Requests\Album\UpdateAlbumRequest;
use App\Models\Album;
use App\Orchid\Layouts\Album\AlbumLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class AlbumEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'AlbumEditScreen';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'AlbumEditScreen';

    /**
     * Query data.
     * @param Album
     * @return array
     */
    public function query(Album $album): array
    {
    	$album;

        return [
        	'album' => $album,
			'entries' => $album->entries
		];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
			Button::make(__('Save'))
				->icon('icon-check')
				->method('save'),

			Button::make(__('Remove'))
				->icon('icon-trash')
				->method('remove'),
		];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
        	AlbumLayout::class
		];
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
