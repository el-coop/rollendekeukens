<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumEntry;
use App\Models\FooterLink;
use App\Models\SiteSetting;
use App\Services\InstagramAlbumService;
use Cache;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

class HomeController extends Controller {

    public function home(InstagramAlbumService $instagramAlbumService) {
        $footerLinks = FooterLink::getCached();
        $settings = SiteSetting::select('key', 'value')->getCached()->pluck('value', 'key');
        $albums = Album::with('entries')->getCached()->keyBy('id');


        if ($displayAlbum = $settings->get('display-album')) {
            $displayEntries = $albums->get($displayAlbum)->entries;
        } else {
            $displayEntries = collect();
        }
        $bottomAlbum = $settings->get('bottom-album');
        try {
            $bottomEntries = Cache::remember(600, 'ig-bottom-entries', function() use ($instagramAlbumService) {
                return $instagramAlbumService->getAlbums();
            });
        } catch (\Exception $exception) {
            $bottomEntries = collect([]);
        }

        if (!$bottomEntries->count()) {
            $bottomEntries = $albums->get($bottomAlbum)->entries ?? collect([]);
        }

        $albums->forget([$displayAlbum, $bottomAlbum]);

        return view('site', compact('settings', 'albums', 'displayEntries', 'footerLinks', 'bottomEntries'));
    }

    protected function getInstagramAlbum() {
        $client = new Client();
        $request = $client->get("https://ig.instant-tokens.com/users/{$igUser}/instagram/{$igAccount}/token.js?userSecret={$igSecret}");
        $response = $request->getBody()->getContents();
        $token = Str::after($response, "'");
        $token = Str::before($token, "'");

        //
        $request = $client->get("https://graph.instagram.com/me/media?fields=caption,media_url,media_type,permalink,thumbnail_url&access_token={$token}&limit=4");
        return json_decode($request->getBody()->getContents());
    }
}
