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
    
    public function bootAddon()
    {
        $this->publishes([
            __DIR__.'/../resources/dist' => public_path('neoisrecursive/storage-info'),
        ], 'public');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'storage-info');
    }
}
