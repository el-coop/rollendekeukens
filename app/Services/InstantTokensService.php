<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class InstantTokensService implements InstagramAlbumService{

    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $user;
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $secret;
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $account;
    /**
     * @var Client
     */
    protected $client;

    public function __construct() {
        $this->user = config('services.instant-tokens.user');
        $this->secret = config('services.instant-tokens.secret');
        $this->account = config('services.instant-tokens.account');

    }

    public function getAlbums() {
        $this->client = new Client();
        $token = $this->getInstagramToken();
        $images = $this->getInstagramResponse($token);

        return collect($images->data ?? [])->map(function($entry) {
            return  [
                'type' => 'Photo',
                'image' => $entry->media_url,
                'image_en' => $entry->media_url,
            ];
        });
    }

    protected function getInstagramToken() {
        $request = $this->client->get("https://ig.instant-tokens.com/users/{$this->user}/instagram/{$this->account}/token.js?userSecret={$this->secret}");
        $response = $request->getBody()->getContents();
        $token = Str::after($response, "'");
        return Str::before($token, "'");

    }

    protected function getInstagramResponse(string $token) {
        $request = $this->client->get("https://graph.instagram.com/me/media?fields=caption,media_url,media_type,permalink,thumbnail_url&access_token={$token}&limit=4");
        return json_decode($request->getBody()->getContents());
    }
}
