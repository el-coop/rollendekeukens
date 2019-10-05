<?php

namespace App\Http\Requests\Album;

use App\Http\Requests\Traits\ProcessImage;
use App\Models\Album;
use App\Models\AlbumEntry;
use App\Models\AlbumPhoto;
use App\Models\AlbumText;
use App\Models\AlbumVideo;
use Illuminate\Foundation\Http\FormRequest;

class CreateEntryRequest extends FormRequest {
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
            'type' => 'required|in:Photo,Text,Video',
            'entry.image' => 'image|required_if:type,Photo|required_if:type,video',
            'entry.video' => 'url|required_if:type,Video',
            'entry.text' => 'string|required_if:type,Text'
        ];
    }
    
    public function commit() {
        $album = Album::find($this->route('album'));
        $entry = new AlbumEntry;
        $entry->album_id = $album->id;
        $entry->order = $album->entries()->count();
        
        if ($this->hasFile('entry.image')) {
            $image = $this->file('entry.image');
            $path = 'public/images/' . $image->hashName();
            $path = $this->processImage($image, $path);
            $entry->image = $path;
        }
        switch ($this->input('type')) {
            case 'Photo':
                $entryExtended = new AlbumPhoto;
                break;
            case 'Video':
                $entryExtended = new AlbumVideo;
                $entryExtended->url = $this->input('entry.video');
                break;
            case 'Text':
                $entryExtended = new AlbumText;
                $entryExtended->text = $this->input('entry.text');
                break;
        }
        $entryExtended->save();
        $entryExtended->entry()->save($entry);
    }
}
