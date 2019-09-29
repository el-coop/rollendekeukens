<?php

namespace App\Http\Requests;

use App\Models\FooterLink;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFooterLinkRequest extends FormRequest {
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
            'link.text' => 'required|string',
        ];
    }
    
    public function commit() {
        $link = $this->input('link');
        $footerLink = new FooterLink;
        if (isset($link['id'])) {
            $footerLink = FooterLink::find($link['id']);
        }
        
        $footerLink->url = $link['url'];
        $footerLink->text = $link['text'];
        $footerLink->save();
    }
}
