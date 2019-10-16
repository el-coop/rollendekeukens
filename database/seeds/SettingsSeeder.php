<?php

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class SettingsSeeder extends Seeder {
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    protected $settings = [
        'logo' => 'seeds/logo.png',
        'instagram' => ['url'],
        'facebook' => ['url'],
        'contact_en' => ['paragraph'],
        'contact_nl' => ['paragraph'],
    ];
    
    
    public function run() {
        $faker = Faker::create();
        foreach ($this->settings as $key => $value) {
            if (is_array($value)) {
                $value = $faker->{$value[0]}();
            }
            factory(SiteSetting::class)->create([
                'key' => $key,
                'value' => $value
            ]);
        }
    }
}
