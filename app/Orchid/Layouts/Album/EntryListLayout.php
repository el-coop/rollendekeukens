<?php

namespace App\Orchid\Layouts\Album;

use App\Orchid\Fields\ImageUpload;
use App\Orchid\Layouts\ThumbnailGallery;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;

class EntryListLayout extends ThumbnailGallery {
    
    
    protected $target = 'entries';
    
    protected $modal = 'entryModal';
    protected $src = 'thumbnailLink';
    protected $createMethod = 'create';
    protected $updateMethod = 'update';
    protected $deleteMethod = 'delete';
}
