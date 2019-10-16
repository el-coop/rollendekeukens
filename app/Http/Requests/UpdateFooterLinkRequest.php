<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\ProcessImage;
use App\Models\FooterLink;
use Illuminate\Foundation\Http\FormRequest;
use Storage;


class UpdateFooterLinkRequest extends FormRequest {
    use ProcessImage;
    
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
            'link' => 'array',
            'link.id' => 'nullable|exists:footer_links,id',
            'link.url' => 'required|string|url',
            'link.logo' => 'required|image'
        ];
    }
    
    public function commit() {
        $link = $this->input('link');
        $footerLink = new FooterLink;
        if (isset($link['id'])) {
            $footerLink = FooterLink::find($link['id']);
            Storage::delete("public/{$footerLink->logo}");
        }
        $image = $this->file('link.logo');
        $path = 'public/images/' . $image->hashName();
        $path = $this->processImage($image, $path);
        $footerLink->logo = $path;
        $footerLink->url = $link['url'];
        $footerLink->save();
    }
}
