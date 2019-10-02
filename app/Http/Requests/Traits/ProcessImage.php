<?php
/**
 * Created by PhpStorm.
 * User: adamb
 * Date: 02/10/2019
 * Time: 14:52
 */

namespace App\Http\Requests\Traits;


use Intervention\Image\Facades\Image;

trait ProcessImage {

	private function processImage($image, $path){
		$mime = $image->extension();
		if ($mime != '.peg' || $mime != 'jpeg') {
			$path = str_replace($mime, 'jpeg', $path);
		}
		Image::make($image)->resize('600', null)->interlace()->save(storage_path('app/' . $path));
		return $path;
	}
}