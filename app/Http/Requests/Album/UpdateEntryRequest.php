<?php

namespace App\Http\Requests\Album;

use App\Http\Requests\Traits\ProcessImage;
use App\Models\AlbumEntry;
use App\Models\AlbumPhoto;
use App\Models\AlbumText;
use App\Models\AlbumVideo;
use Illuminate\Foundation\Http\FormRequest;
use Storage;

class UpdateEntryRequest extends FormRequest {
    use ProcessImage;
    private $entry;
    
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
        $this->entry = AlbumEntry::findOrFail($this->input('entry.id'));
        
        return [
            'type' => 'required|in:Photo,Text,Video',
            'entry.image' => 'image|nullable',
            'entry.video' => 'url|required_if:type,Video',
            'entry.text' => 'string|required_if:type,Text'
        ];
    }
    
    public function commit() {
        
        
        if ($this->hasFile('entry.image')) {
            if (Storage::exists($this->entry->image)) {
                Storage::delete($this->entry->image);
            }
            
            $image = $this->file('entry.image');
            $path = 'public/images/' . $image->hashName();
            $path = $this->processImage($image, $path);
            $this->entry->image = $path;
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
        $this->entry->entry()->delete();
        $entryExtended->save();
        $entryExtended->entry()->save($this->entry);
    }
}