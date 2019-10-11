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

	public function albumThumbnail(Album $album) {
		return Storage::response($album->thumbnail);
	}

	public function entryImage(AlbumEntry $entry) {
		return Storage::response($entry->image);
	}

	public function footerLinkImage(FooterLink $footerLink) {
		return Storage::response($footerLink->logo);
	}

	public function home() {
		$footerLinks = FooterLink::getCached();
		$settings = SiteSetting::select('key', 'value')->getCached()->pluck('value', 'key');
		$albums = Album::getCached();
		$entries = AlbumEntry::where('album_id', 1)->getCached();
		return view('site', compact('settings', 'albums', 'entries', 'footerLinks'));
	}
}
