<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Album extends Model {
    
    use AsSource;
    
    public function entries() {
        return $this->hasMany(AlbumEntry::class);
    }
    
    public function getThumbnailLinkAttribute() {
        return action('HomeController@albumThumbnail', ['album' => $this, 'time' => $this->updated_at->timestamp]);
    }
    
    public function getPreviewAttribute() {
        return "<img src='{$this->thumbnailLink}' class='thumbnail-gallery__entry-image rounded-circle'>";
    }
}