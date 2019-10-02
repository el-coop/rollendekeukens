<?php

namespace App\Orchid\Layouts;

use App\Models\Album;
use Orchid\Screen\Layouts\Base;
use Orchid\Screen\Repository;
use Orchid\Screen\TD;

class ThumbnailGallery extends Base {
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = '';
    protected $template = 'platform.layouts.thumbGallery';
    protected $modal = '';
    protected $src = '';
    protected $createMethod = '';
    protected $updateMethod = '';
    protected $deleteMethod = '';
    protected $reorderMethod = '';
    protected $class = "";
    protected $link = false;
    
    
    public function build(Repository $repository) {
        if (!$this->checkPermission($this, $repository)) {
            return;
        }
        
        return view($this->template, [
            'entries' => $repository->getContent($this->target),
            'src' => $this->src,
            'modal' => $this->modal,
            'createMethod' => $this->createMethod,
            'updateMethod' => $this->updateMethod,
            'deleteMethod' => $this->deleteMethod,
            'reorderMethod' => $this->reorderMethod,
            'class' => $this->class,
            'link' => $this->link
        ]);
    }
    
}
