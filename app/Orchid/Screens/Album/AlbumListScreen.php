<?php

namespace App\Orchid\Screens\Album;

use Alert;
use App\Http\Requests\Album\CreateAlbumRequest;
use App\Http\Requests\Album\UpdateAlbumRequest;
use App\Models\Album;
use App\Orchid\Fields\ModalButton;
use App\Orchid\Layouts\Album\AlbumLayout;
use App\Orchid\Layouts\Album\AlbumListLayout;
use Illuminate\Http\Request;
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
	public $description = 'AlbumListScreen';

	/**
	 * Query data.
	 *
	 * @return array
	 */
	public function query(): array {
		return [
			'albums' => Album::paginate()
		];
	}

	/**
	 * Button commands.
	 *
	 * @return Action[]
	 */
	public function commandBar(): array {
		return [];
	}

	/**
	 * Views.
	 *
	 * @return Layout[]
	 */
	public function layout(): array {
		return [
			AlbumListLayout::class,
			Layout::rows([
				ModalButton::make(__('add album	'))
					->modal('createAlbumModal')
					->method('create')
					->class('btn btn-primary mb-5')
					->right(),
			]),
			Layout::modal('createAlbumModal', [
				AlbumLayout::class
			])->title(__('album'))->async('asyncAlbum')
		];
	}

	public function asyncAlbum(Request $request) {
		$album = Album::find($request->input(0,0));
		if (!$album){
			$album = new Album;
		}
		return ['album' => $album];
	}

	public function create(CreateAlbumRequest $request) {
		$request->commit();
		Alert::success('Album created');
		return back();
	}

	public function update(UpdateAlbumRequest $request) {
		$request->commit();
		Alert::success('Album updated');
		return back();
	}
}
