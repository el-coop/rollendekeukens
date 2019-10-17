<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumEntry;
use App\Models\FooterLink;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller {
    
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
