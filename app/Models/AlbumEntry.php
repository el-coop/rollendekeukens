<?php

namespace App\Models;

use App\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class AlbumEntry extends Model {
    use Cacheable;
    use AsSource;
    protected $with = ['entry'];
    protected $appends = ['type', 'image'];

    public function album() {
        return $this->belongsTo(Album::class);
    }

    public function entry() {
        return $this->morphTo();
    }

    public function getPreviewAttribute() {
        if (method_exists($this->entry, 'getPreviewAttribute')) {
            return $this->entry->preview;
        }
        return "<img src='/storage/{$this->image}' class='thumbnail-gallery__entry-image'>";
    }

	public function getTypeAttribute() {
		return str_replace("Album", "",class_basename($this->entry));
    }

	public function getImageAttribute() {
		if (app()->getLocale() == 'en' && $this->image_en){
			return $this->image_en;
		}
		return $this->attributes['image'];
    }
}
