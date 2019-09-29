<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumPhoto extends Model {

	public function entry() {
		return $this->morphOne(AlbumEntry::class, 'entry');
	}
}
