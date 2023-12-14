<?php

namespace Neoisrecursive\StorageInfo;

use Neoisrecursive\StorageInfo\Listeners\InvalidateCacheListener;
use Neoisrecursive\StorageInfo\Widgets\StorageInfoWidget;
use Statamic\Providers\AddonServiceProvider;

final class ServiceProvider extends AddonServiceProvider
{
    protected $widgets = [
        StorageInfoWidget::class,
    ];

    protected $routes = [
        'cp' => __DIR__ . '/../routes/api.php',
    ];

    protected $subscribe = [
        InvalidateCacheListener::class,
    ];

    protected $vite = [
        'input' => [
            'resources/js/main.js',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    public function bootAddon()
    {
        $this->publishes([
            __DIR__ . '/../config/storage-info.php' => config_path('storage-info.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'storage-info');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/storage-info.php', 'storage-info');
    }
}
