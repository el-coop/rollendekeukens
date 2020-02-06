<?php

namespace App\Orchid\Layouts\Album;

use App\Orchid\Fields\EntryOptions;
use App\Orchid\Fields\ImageUpload;
use App\Orchid\Fields\TinyMCE5;
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
				ImageUpload::make('entry.image_en')
					->title(__('panel.image_en')),
            ]),
            'Text' => Layout::rows([
                Input::make('entry.id')->type('hidden'),
                ImageUpload::make('entry.image')
                    ->title(__('panel.image')),
				ImageUpload::make('entry.image_en')
					->title(__('panel.image_en')),
                TinyMCE::make('entry.text_en')
                    ->title(__('panel.text-en')),
                TinyMCE::make('entry.text_nl')
                    ->title(__('panel.text-nl')),
            ]),
            'Video' => Layout::rows([
                Input::make('entry.id')->type('hidden'),
                ImageUpload::make('entry.image')
                    ->title(__('panel.image')),
				ImageUpload::make('entry.image_en')
					->title(__('panel.image_en')),
                Input::make('entry.video')
                    ->type('url')
                    ->max(255)
                    ->title(__('entry.youtube')),
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
