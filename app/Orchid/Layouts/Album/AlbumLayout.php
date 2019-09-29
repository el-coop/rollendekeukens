<?php

namespace App\Orchid\Layouts\Album;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class AlbumLayout extends Rows {
	/**
	 * Views.
	 *
	 * @return Field[]
	 */
	protected function fields(): array {
		return [
			Input::make('album.id')->type('hidden'),

			Input::make('album.title')->type('text')
			->required()
			->max(255)
			->horizontal()
			->title(__('title'))
		];
	}
}
