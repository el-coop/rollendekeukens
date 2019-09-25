<?php

declare(strict_types=1);

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

//Screens

// Platform > Users
Breadcrumbs::for('platform.systems.users', function ($trail) {
    $trail->parent('platform.index');
    $trail->push(__('panel.users'), route('platform.systems.users'));
});

// Platform > Users > User
Breadcrumbs::for('platform.systems.users.edit', function ($trail, $user) {
    $trail->parent('platform.systems.users');
    $trail->push(__('panel.edit'), route('platform.systems.users.edit', $user));
});
