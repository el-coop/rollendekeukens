<?php

namespace App\Models;

use App\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\AsSource;

class Album extends Model {

    use AsSource, Cacheable;
    protected $appends = ['thumbnailLink'];
    
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
