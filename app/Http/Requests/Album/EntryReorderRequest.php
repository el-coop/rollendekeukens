<?php

namespace App\Http\Requests\Album;

use App\Models\AlbumEntry;
use Illuminate\Foundation\Http\FormRequest;

class EntryReorderRequest extends FormRequest {
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
            'order' => 'required|array',
            'order.*' => 'integer'
        ];
    }
    
    public function commit() {
        foreach ($this->input('order') as $order => $id) {
            $album = AlbumEntry::find($id);
            $album->order = $order;
            $album->save();
        }
    }
}
