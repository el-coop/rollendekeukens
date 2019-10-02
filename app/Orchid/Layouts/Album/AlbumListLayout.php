<?php

namespace App\Orchid\Layouts\Album;

use App\Models\Album;
use Orchid\Screen\Layouts\Base;
use Orchid\Screen\Repository;
use Orchid\Screen\TD;

class AlbumListLayout extends Base {
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'albums';
    protected $template = 'platform.layouts.thumbGallery';
    
    
    public function build(Repository $repository) {
        if (!$this->checkPermission($this, $repository)) {
            return;
        }
        
        $src = "thumbnailLink";
        
        return view($this->template, [
            'entries' => $repository->getContent($this->target),
            'src' => $src,
            'modal' => 'createAlbumModal',
            'method' => 'create',
            'updateMethod' => 'update',
        ]);
    }
    
}
