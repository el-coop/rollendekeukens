<?php

namespace App\Http\Requests;

use App\Models\SiteSetting;
use Illuminate\Foundation\Http\FormRequest;
use Storage;

class UpdateSettingsRequest extends FormRequest {
    
    protected $settings = ['instagram', 'facebook', 'contact', 'links-title'];
    
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
            'logo' => 'nullable|image',
            'instagram' => 'nullable|string|url',
            'facebook' => 'nullable|string|url',
            'contact' => 'nullable|string',
            'links-title' => 'nullable|string',
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
            if($logo->value){
                Storage::delete($logo->value);
            }
            $logo->value = $this->file('logo')->store('public/images');
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
