<?php

namespace App\Http\Requests\Album;

use App\Models\Album;
use Illuminate\Foundation\Http\FormRequest;

class AlbumReorderRequest extends FormRequest {
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
            'order' => 'required|array',
            'order.*' => 'integer'
        ];
    }
    
    public function commit() {
        foreach ($this->input('order') as $order => $id) {
            $album = Album::find($id);
            $album->order = $order;
            $album->save();
        }
    }
}
