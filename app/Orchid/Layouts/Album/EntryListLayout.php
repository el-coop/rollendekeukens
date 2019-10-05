<?php

namespace App\Orchid\Layouts\Album;

use App\Orchid\Fields\ImageUpload;
use App\Orchid\Layouts\ThumbnailGallery;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;

class EntryListLayout extends ThumbnailGallery {
    
    
    protected $target = 'entries';
    
    protected $modal = 'entryModal';
    protected $src = 'preview';
    protected $createMethod = 'save';
    protected $updateMethod = 'update';
    protected $deleteMethod = 'delete';
    protected $reorderMethod = 'reorder';
}
