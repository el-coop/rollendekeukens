<?php

namespace App\Orchid\Layouts\Album;

use App\Models\Album;
use App\Orchid\Layouts\ThumbnailGallery;
use Orchid\Screen\Layouts\Base;
use Orchid\Screen\Repository;
use Orchid\Screen\TD;

class AlbumListLayout extends ThumbnailGallery {
    
    protected $target = 'albums';
    protected $modal = 'createAlbumModal';
    protected $createMethod = 'create';
    protected $updateMethod = 'update';
    protected $deleteMethod = 'delete';
    protected $reorderMethod = 'reorder';
    protected $class = "rounded-circle";
    protected $link = "/dashboard/albums/{id}/edit";
    
}
