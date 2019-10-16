<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Orchid\Support\Facades\Dashboard;

class CreateUserRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'user.email' => 'required|email|unique:users,email',
			'user.name' => 'required|string|max:255',
			'password' => 'required|min:6|confirmed',
			'user.language' => 'required|string|in:en,nl'
		];
	}

	public function commit() {
		$user = new User;
		$permissions = collect();

		Dashboard::getPermission()
			->collapse()
			->each(function ($item) use ($permissions) {
				$permissions->put($item['slug'], true);
			});
		$user->email = $this->input('user.email');
		$user->name = $this->input('user.name');
		$user->password = bcrypt($this->input('password'));
		$user->permissions = $permissions;
		$user->language = $this->input('user.language');
		$user->save();
	}
}
