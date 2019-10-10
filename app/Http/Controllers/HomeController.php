<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumEntry;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller {
    public function logo() {
        $logo = SiteSetting::select('value')->where('key', 'logo')->firstCached();
        return Storage::response($logo->value);
    }
    
    public function albumThumbnail(Album $album) {
        return Storage::response($album->thumbnail);
    }
    
    public function entryImage(AlbumEntry $entry) {
        return Storage::response($entry->image);
    }
    
    public function home() {
        $settings = SiteSetting::select('key','value')->getCached()->pluck('value','key');
        $albums = Album::all();
        $entries = Album::find(1)->entries;
        return view('site', compact('settings','albums', 'entries'));
    }
}
