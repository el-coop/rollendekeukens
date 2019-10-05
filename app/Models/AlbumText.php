<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumText extends Model {
    
    public function entry() {
        return $this->morphOne(AlbumEntry::class, 'entry');
    }
    
    public function getPreviewAttribute() {
        if ($this->entry->image) {
            return "<img src='{$this->entry->imageLink}' class='thumbnail-gallery__entry-image'>";
        }
        return "<div class='thumbnail-gallery__entry-text'>{$this->text}</div>";
    }
    
}
