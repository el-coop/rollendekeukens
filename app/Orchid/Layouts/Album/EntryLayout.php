<?php

namespace App\Orchid\Layouts\Album;

use App\Orchid\Fields\EntryOptions;
use App\Orchid\Fields\ImageUpload;
use Illuminate\Support\Arr;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TinyMCE;
use Orchid\Screen\Layout;
use Orchid\Screen\Layouts\Tabs;
use Orchid\Screen\Repository;

class EntryLayout extends Tabs {
    
    public $template = 'platform.layouts.entryOptions';
    
    public function __construct() {
        $this->layouts = [
            'Photo' => Layout::rows([
                Input::make('entry.id')->type('hidden'),
                
                ImageUpload::make('entry.image')
                    ->title(__('panel.image')),
            ]),
            'Text' => Layout::rows([
                Input::make('entry.id')->type('hidden'),
                ImageUpload::make('entry.image')
                    ->title(__('panel.image')),
                TinyMCE::make('entry.text')
                    ->title(__('panel.text')),
            ]),
            'Video' => Layout::rows([
                Input::make('entry.id')->type('hidden'),
                ImageUpload::make('entry.image')
                    ->title(__('panel.image')),
                Input::make('entry.video')
                    ->type('url')
                    ->max(255)
                    ->title(__('panel.youtube')),
            ])
        ];
    }
    
    protected function buildAsDeep(Repository $repository) {
        $build = [];
        
        if (!$this->checkPermission($this, $repository)) {
            return;
        }
        foreach ($this->layouts as $key => $layouts) {
            $layouts = Arr::wrap($layouts);
            
            $build += $this->buildChild($layouts, $key, $repository);
        }
        
        $variables = array_merge($this->variables, [
            'entry' => $repository['entry'],
            'manyForms' => $build,
            'templateSlug' => $this->getSlug(),
            'templateAsync' => $this->asyncNext,
            'templateAsyncMethod' => $this->asyncMethod,
        ]);
        
        return view($this->async ? 'platform::layouts.blank' : $this->template, $variables);
    }
}