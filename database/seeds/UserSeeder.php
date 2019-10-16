<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $permissions = Dashboard::getPermission()
            ->collapse()
            ->map(function ($item) {
                return $item['slug'];
            });
        
        factory(\App\User::class)->create([
            'email' => 'admin@test.com',
            'password' => bcrypt('123456'),
            'permissions' => $permissions
        ]);
    }
}
