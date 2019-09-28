<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Storage;

class HomeController extends Controller {
    public function logo() {
        $logo = SiteSetting::select('value')->where('key', 'logo')->first();
        return Storage::response("{$logo->value}");
    }
}
