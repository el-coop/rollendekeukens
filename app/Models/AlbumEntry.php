<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumEntry extends Model {

	public function album() {
		return $this->belongsTo(Album::class);
	}

	public function entry() {
		return $this->morphTo();
	}
}
