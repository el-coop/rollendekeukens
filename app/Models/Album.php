<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Album extends Model {

	use AsSource;

	public function entries() {
		return $this->hasMany(AlbumEntry::class);
	}
}
