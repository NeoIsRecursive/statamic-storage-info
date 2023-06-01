<?php

namespace Neoisrecursive\StorageInfo;

use Neoisrecursive\StorageInfo\Widgets\StorageWidget;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $widgets = [
        StorageWidget::class,
    ];

    public function bootAddon()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'storage-info');
    }
}
