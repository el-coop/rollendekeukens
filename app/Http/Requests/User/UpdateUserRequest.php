<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Orchid\Platform\Models\User;

class UpdateUserRequest extends FormRequest {
	protected $user;
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		$this->user = User::find($this->input('user.id'));
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'user.email' => 'required|email|unique:users,email,' . $this->user->id,
			'user.name' => 'required|string|max:255',
			'password' => 'nullable|min:6|confirmed',
			'user.language' => 'required|string|in:en,nl'
		];
	}

	public function commit() {
		$this->user->name = $this->input('user.name');
		$this->user->email = $this->input('user.email');
		$this->user->language = $this->input('user.language');
		if ($this->input('password')){
			$this->user->password = bcrypt($this->input('password'));
		}
		$this->user->save();
	}
}
