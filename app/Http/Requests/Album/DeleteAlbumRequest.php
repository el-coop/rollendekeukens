<?php

namespace App\Http\Requests\Album;

use App\Models\Album;
use Illuminate\Foundation\Http\FormRequest;
use Storage;

class DeleteAlbumRequest extends FormRequest {
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
            //
        ];
    }
    
    public function commit() {
        $album = Album::find($this->route('method'));
        $album->entries->each(function ($entry) {
            if (Storage::exists("public/{$entry->image}")) {
                Storage::delete("public/{$entry->image}");
            }
            $entry->entry()->delete();
            $entry->delete();
        });
        Storage::delete("public/{$album->thumbnail}");
        return $album->delete();
    }
}
