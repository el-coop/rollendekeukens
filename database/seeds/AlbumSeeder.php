<?php

use App\Models\AlbumEntry;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $albums = factory(\App\Models\Album::class, 10)->create();
        
        factory(SiteSetting::class)->create([
            'key' => 'display-album',
            'value' => $albums->random()->id
        ]);
        factory(SiteSetting::class)->create([
            'key' => 'bottom-album',
            'value' => $albums->random()->id
        ]);
        
        $albums->each(function ($album) {
            factory(AlbumEntry::class, 6)->create([
                'album_id' => $album->id,
                'order' => $album->entries->count()
            ]);
        });
    }
}
