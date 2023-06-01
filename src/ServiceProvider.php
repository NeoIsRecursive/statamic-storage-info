<?php

namespace Neoisrecursive\StorageInfo;

use Neoisrecursive\StorageInfo\Widgets\StorageInfoWidget;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $widgets = [
        StorageInfoWidget::class,
    ];

    public function bootAddon()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'storage-info');
    }
}
