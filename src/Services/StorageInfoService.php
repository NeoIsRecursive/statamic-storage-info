<?php

namespace Neoisrecursive\StorageInfo\Services;

use Illuminate\Support\Facades\Cache;
use Statamic\Assets\AssetContainer as Container;
use Statamic\Facades\AssetContainer;
use Statamic\Support\Str;

class StorageInfoService
{
    public function get(array $containers)
    {
        return Cache::rememberForever('neoisrecursive:storage-info', fn () => $this->getContainerData($containers));
    }

    public function forget()
    {
        return Cache::forget('neoisrecursive:storage-info');
    }

    public static function getContainerData(array $containers)
    {
        $containers = AssetContainer::all()->filter(function ($container) use ($containers) {
            return in_array($container->handle(), $containers);
        })->map(function (Container $container) {
            return [
                'name' => $container->title(),
                'files' => $container->queryAssets()->count(),
                'url' => $container->showUrl(),
                'spaceUsed' => Str::fileSizeForHumans($container->assets()->sum(fn ($asset) => $asset->size())),
            ];
        });

        return $containers;
    }
}
