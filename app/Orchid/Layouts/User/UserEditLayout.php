<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * Views.
     *
     * @throws \Throwable|\Orchid\Screen\Exceptions\TypeException
     *
     * @return array
     */
    public function fields(): array
    {
		$passwordInput = Input::make('password')->type('password')
			->title(__('passwords.password'))
			->placeholder(__('passwords.password'))
			->horizontal();
		$passwordConfirm = Input::make('password_confirmation')->type('password')
			->title(__('passwords.confirm'))
			->placeholder(__('passwords.confirm'))
			->horizontal();
    	if ($this->query['user'] && !$this->query['user']->id ){
    		$passwordInput->required();
    		$passwordConfirm->required();
		}
        return [
        	Input::make('user.id')->type('hidden'),
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->horizontal()
                ->title(__('user.name'))
                ->placeholder(__('user.name')),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->horizontal()
                ->title(__('user.email'))
                ->placeholder(__('user.email')),
			$passwordInput,
			$passwordConfirm
        ];
    }
}
