<?php

declare(strict_types=1);

use App\Orchid\Screens\Album\AlbumEditScreen;
use App\Orchid\Screens\Album\AlbumListScreen;
use App\Orchid\Screens\ExampleScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
$this->router->screen('/main', PlatformScreen::class)->name('platform.main');

// Users...
$this->router->screen('users/{users}/edit', UserEditScreen::class)->name('platform.systems.users.edit');
$this->router->screen('users', UserListScreen::class)->name('platform.systems.users');
$this->router->screen('albums/{album}/edit', AlbumEditScreen::class)->name('platform.albums.edit');
$this->router->screen('albums', AlbumListScreen::class)->name('platform.albums');

// Example...
//Route::screen('/dashboard/screen/idea', 'Idea::class','platform.screens.idea');
