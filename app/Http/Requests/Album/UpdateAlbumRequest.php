<?php

namespace App\Http\Requests\Album;

use App\Http\Requests\Traits\ProcessImage;
use App\Models\Album;
use Illuminate\Foundation\Http\FormRequest;
use Storage;

class UpdateAlbumRequest extends FormRequest {
    use ProcessImage;
	/**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $album;
    
    public function authorize() {
        return $this->user();
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $this->album = Album::findOrFail($this->input('album.id'));
        
        return [
            'album.thumbnail' => 'nullable|image',
			'album.title_en' => 'required|string|unique:albums,title_en,'. $this->album->id,
			'album.title_nl' => 'required|string|unique:albums,title_nl,' . $this->album->id
        
        ];
    }
    
    public function commit() {
        if ($this->hasFile('album.thumbnail')) {
            Storage::delete($this->album->thumbnail);
			$image = $this->file('album.thumbnail');

			$path = 'public/images/' . $image->hashName();
			$path = $this->processImage($image, $path);
			$this->album->thumbnail = $path;
        }
        $this->album->title_en = $this->input('album.title_en');
		$this->album->title_nl = $this->input('album.title_nl');

		$this->album->save();
        return $this->album;
    }
}
