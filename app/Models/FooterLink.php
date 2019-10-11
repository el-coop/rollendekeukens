<?php

namespace App\Models;

use App\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class FooterLink extends Model
{
	use Cacheable;
    use AsSource;
}
