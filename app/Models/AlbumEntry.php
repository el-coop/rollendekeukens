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
    
    public function getImageLinkAttribute() {
        return action('HomeController@entryImage', ['entry' => $this, 'time' => $this->entry->updated_at->timestamp]);
    }
    
    public function getPreviewAttribute() {
        if (method_exists($this->entry, 'getPreviewAttribute')) {
            return $this->entry->preview;
        }
        return "<img src='{$this->imageLink}' class='thumbnail-gallery__entry-image'>";
    }
}
