<?php

namespace App\Http\Requests\Album;

use App\Http\Requests\Traits\ProcessImage;
use App\Models\Album;
use Illuminate\Foundation\Http\FormRequest;

class CreateAlbumRequest extends FormRequest {

	use ProcessImage;
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
		    'album.thumbnail' => 'required|image',
			'album.title' => 'required|string|unique:albums,title'
		];
	}

	public function commit() {
		$album = new Album;
		$album->title = $this->input('album.title');
		$image = $this->file('album.thumbnail');

		$path = 'public/images/' . $image->hashName();
		$path = $this->processImage($image, $path);
        $album->thumbnail = $path;
        $album->order = Album::count();
        
        $album->save();
		return $album;
	}
}