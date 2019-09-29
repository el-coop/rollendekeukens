<?php

namespace App\Http\Requests\Album;

use App\Models\Album;
use Illuminate\Foundation\Http\FormRequest;

class CreateAlbumRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return $this->user();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'album.title' => 'required|string|unique:albums,title'
		];
	}

	public function commit() {
		$album = new Album;
		$album->title = $this->input('album.title');
		$album->save();
		return $album;
	}
}
