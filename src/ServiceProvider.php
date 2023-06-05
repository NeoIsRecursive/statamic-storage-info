<?php

namespace Neoisrecursive\StorageInfo;

use Neoisrecursive\StorageInfo\Widgets\StorageInfoWidget;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $widgets = [
        StorageInfoWidget::class,
    ];

    protected $routes = [
       "cp" =>  __DIR__ . '/../routes/api.php'
    ];

    protected $vite = [ 
        'input' => [
            'resources/js/main.js',
        ],
        'publicDirectory' => 'resources/dist',
    ]; 
    
    public function bootAddon()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'storage-info');
    }
}
