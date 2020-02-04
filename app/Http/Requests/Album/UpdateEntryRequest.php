<?php

namespace App\Http\Requests\Album;

use App\Http\Requests\Traits\ProcessImage;
use App\Http\Requests\Traits\ProcessYoutubeLink;
use App\Models\AlbumEntry;
use App\Models\AlbumPhoto;
use App\Models\AlbumText;
use App\Models\AlbumVideo;
use Illuminate\Foundation\Http\FormRequest;
use Storage;

class UpdateEntryRequest extends FormRequest {
    use ProcessImage;
    use ProcessYoutubeLink;
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
            'entry.image' => 'image|nullable|clamav',
			'entry.image_en' => 'image|nullable|clamav',
            'entry.video' => 'url|required_if:type,Video',
            'entry.text_en' => 'string|required_if:type,Text',
            'entry.text_nl' => 'string|required_if:type,Text'
        ];
    }
    
    public function commit() {
        if ($this->hasFile('entry.image')) {
            if (Storage::exists("public/{$this->entry->image}")) {
                Storage::delete("public/{$this->entry->image}");
            }
            $image = $this->file('entry.image');
            $path = 'public/images/' . $image->hashName();
            $path = $this->processImage($image, $path);
            $this->entry->image = $path;
        }
		if ($this->hasFile('entry.image_en')) {
			if (Storage::exists("public/{$this->entry->image_en}")) {
				Storage::delete("public/{$this->entry->image_en}");
			}
			$image_en = $this->file('entry.image');
			$path = 'public/images/' . $image_en->hashName();
			$path = $this->processImage($image_en, $path);
			$this->entry->image_en = $path;
		}
        switch ($this->input('type')) {
            case 'Photo':
                $entryExtended = new AlbumPhoto;
                break;
            case 'Video':
                $entryExtended = new AlbumVideo;
                $url = $this->convertYoutube($this->input('entry.video'));
                $entryExtended->url = $url;
                break;
            case 'Text':
                $entryExtended = new AlbumText;
                $entryExtended->text_en = $this->input('entry.text_en');
                $entryExtended->text_nl = $this->input('entry.text_nl');
                break;
        }
        $this->entry->entry()->delete();
        $entryExtended->save();
        $entryExtended->entry()->save($this->entry);
    }
}
