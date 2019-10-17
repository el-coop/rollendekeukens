<?php

namespace App\Models;

use App\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\AsSource;

class Album extends Model {
    
    use AsSource, Cacheable;
    protected $appends = ['title'];
    
    public function entries() {
        return $this->hasMany(AlbumEntry::class)->orderBy('order');
    }
    
    public function getPreviewAttribute() {
        return "<img src='/storage/{$this->thumbnail}' class='thumbnail-gallery__entry-image rounded-circle'>";
    }
    
    public function getTitleAttribute() {
        $title = 'title_' . app()->getLocale();
        return $this->$title;
    }
}
