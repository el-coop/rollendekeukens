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
            'album.title' => 'required|string|unique:albums,title,' . $this->album->id
        
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
        $this->album->title = $this->input('album.title');
        $this->album->save();
        return $this->album;
    }
}