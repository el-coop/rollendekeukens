<?php
/**
 * Created by PhpStorm.
 * User: adamb
 * Date: 12/10/2019
 * Time: 15:43
 */

namespace App\Http\Requests\Traits;


trait ProcessYoutubeLink {
	private function convertYoutube($string) {
		return preg_replace(
			"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
			"//www.youtube.com/embed/$2",
			$string
		);
	}
}