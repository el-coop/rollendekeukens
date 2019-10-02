<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class AlbumEntry extends Model {

    use AsSource;
    
	public function album() {
		return $this->belongsTo(Album::class);
	}

	public function entry() {
		return $this->morphTo();
	}
}
