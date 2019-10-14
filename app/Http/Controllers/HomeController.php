<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumEntry;
use App\Models\FooterLink;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller {
    public function logo() {
        $logo = SiteSetting::select('value')->where('key', 'logo')->firstCached();
        return Storage::response($logo->value);
    }
    
    public function albumThumbnail($album) {
        $album = Album::where('id', $album)->firstCached();
        return Storage::response($album->thumbnail);
    }
    
    public function entryImage($entry) {
        $entry = AlbumEntry::where('id', $entry)->firstCached();
        return Storage::response($entry->image);
    }
    
    public function footerLinkImage($footerLink) {
        $footerLink = FooterLink::where('id', $footerLink)->firstCached();
        return Storage::response($footerLink->logo);
    }
    
    public function home() {
        $footerLinks = FooterLink::getCached();
        $settings = SiteSetting::select('key', 'value')->getCached()->pluck('value', 'key');
        $albums = Album::with('entries')->getCached()->keyBy('id');
        
        $displayAlbum = $settings->get('display-album');
		$displayEntries = $albums->get($displayAlbum)->entries;
		$bottomAlbum = $settings->get('bottom-album');
		$bottomEntries = $albums->get($bottomAlbum)->entries;
        $albums->forget([$displayAlbum, $bottomAlbum]);
        
        return view('site', compact('settings', 'albums', 'displayEntries', 'footerLinks', 'bottomEntries'));
    }
}
