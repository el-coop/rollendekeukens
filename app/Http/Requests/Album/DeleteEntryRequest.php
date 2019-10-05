<?php

namespace App\Http\Requests\Album;

use App\Models\AlbumEntry;
use Illuminate\Foundation\Http\FormRequest;
use Storage;

class DeleteEntryRequest extends FormRequest {
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
        $entry = AlbumEntry::find($this->route('method'));
        if (Storage::exists($entry->image)) {
            Storage::delete($entry->image);
        }
        $entry->entry()->delete();
        return $entry->delete();
    }
}
