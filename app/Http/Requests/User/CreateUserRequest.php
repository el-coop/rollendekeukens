<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

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
			'password' => 'required|min:6|confirmed'
		];
	}

	public function commit() {
		$user = new User;
		$user->email = $this->input('user.email');
		$user->name = $this->input('user.name');
		$user->password = bcrypt($this->input('password'));
		$user->save();
	}
}
