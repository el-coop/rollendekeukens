<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\ProcessImage;
use App\Models\SiteSetting;
use Illuminate\Foundation\Http\FormRequest;
use Storage;

class UpdateSettingsRequest extends FormRequest {
    use ProcessImage;
    protected $settings = ['instagram','pinterest', 'facebook', 'top_text_en', 'top_text_nl', 'contact_en', 'contact_nl', 'display-album', 'bottom-album', 'meta-description'];
    
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
            'logo' => 'nullable|image|clamav',
            'instagram' => 'nullable|string|url',
            'facebook' => 'nullable|string|url',
            'pinterest' => 'nullable|string|url',
            'top_text_en' => 'nullable|string',
            'top_text_nl' => 'nullable|string',
            'contact_en' => 'nullable|string',
            'contact_nl' => 'nullable|string',
            'meta-description' => 'nullable|string',
            'display-album' => 'nullable|integer|exists:albums,id',
            'bottom-album' => 'nullable|integer|exists:albums,id'
        ];
    }
    
    public function commit() {
        foreach ($this->settings as $key) {
            $setting = $this->findOrNew($key);
            $setting->value = $this->input($key);
            $setting->save();
        }
        if ($this->hasFile('logo')) {
            $logo = $this->findOrNew('logo');
            if ($logo->value) {
                Storage::delete("public/{$logo->value}");
            }
            $image = $this->file('logo');
            $path = 'public/images/' . $image->hashName();
            $path = $this->processImage($image, $path);
            $logo->value = $path;
            $logo->save();
        }
    }
    
    protected function findOrNew($key) {
        $setting = SiteSetting::where('key', $key)->first();
        if (!$setting) {
            $setting = new SiteSetting;
            $setting->key = $key;
        }
        
        return $setting;
    }
}
