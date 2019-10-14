<?php

use Illuminate\Database\Seeder;
use Orchid\Support\Facades\Dashboard;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		$permissions = collect();

		Dashboard::getPermission()
			->collapse()
			->each(function ($item) use ($permissions) {
				$permissions->put($item['slug'], true);
			});
		$user = factory(\App\User::class)->create([
			'email' => 'admin@test.com',
			'password' => bcrypt('123456'),
			'permissions' => $permissions
		]);


	}
}
