<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\TD;
use Orchid\Platform\Models\User;
use Orchid\Screen\Layouts\Table;

class UserListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'users';

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            TD::set('name', __('user.name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->loadModalAsync('userModal', 'updateUser', 'id', 'name'),
            TD::set('email', __('user.email'))
                ->loadModalAsync('userModal', 'updateUser', 'id', 'email')
                ->filter(TD::FILTER_TEXT)
                ->sort(),
			TD::set('id', __('panel.delete'))
				->render(function (User $user) {

					$route = action('\App\Orchid\Screens\User\UserListScreen@handle', [
						'method' => $user->id,
						'argument' => 'deleteUser'
					]);

					return view('platform.fields.deleteButton', compact('route'));
				}),
        ];

    }
}
