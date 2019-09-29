<?php

namespace App\Http\Requests\Album;

use App\Models\Album;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAlbumRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	private $album;
	public function authorize() {
		$this->album = Album::find($this->route('album'));
		return $this->user();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'album.title' => 'required|string|unique:albums,title,' . $this->album->id

		];
	}

	public function commit() {
		$this->album->title = $this->input('album.title');
		$this->album->save();
		return $this->album;
	}
}
