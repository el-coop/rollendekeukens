<?php

namespace App\Orchid\Layouts\Album;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AlbumEntryListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'entries';

    /**
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
        	TD::set()
		];
    }
}
