<?php

namespace App\Orchid\Layouts\Album;

use App\Models\Album;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AlbumListLayout extends Table {
	/**
	 * Data source.
	 *
	 * @var string
	 */
	protected $target = 'albums';

	/**
	 * @return TD[]
	 */
	protected function columns(): array {
		return [
			TD::set('title', 'title')
				->sort()
				->filter(TD::FILTER_TEXT)
				->render(function (Album $album) {
					$title = $album->title;
					$route = route('platform.albums.edit', $album->id);
					return "<a href='{$route}'> 
                                <div class='d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center'>
                                	{$title}
                                </div>
							</a>";
				})
		];
	}
}
