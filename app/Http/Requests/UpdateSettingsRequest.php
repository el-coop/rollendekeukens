<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\ProcessImage;
use App\Models\SiteSetting;
use Illuminate\Foundation\Http\FormRequest;
use Storage;

class UpdateSettingsRequest extends FormRequest {
	use ProcessImage;
	protected $settings = ['instagram', 'facebook', 'contact_en', 'contact_nl', 'display-album', 'bottom-album'];

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
			'contact_en' => 'nullable|string',
			'contact_nl' => 'nullable|string',
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
				Storage::delete($logo->value);
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
