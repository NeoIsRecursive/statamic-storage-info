<?php

namespace Neoisrecursive\StorageInfo\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Statamic\Assets\AssetCollection;
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

    public function getContainerData(array $containers)
    {
        $containers = $this->getAssets($containers)->map(function (Container $container) {
            $assets = $container->assets();
            return [
                'name' => $container->title(),
                'files' => $container->queryAssets()->count(),
                'url' => $container->showUrl(),
                'spaceUsed' => Str::fileSizeForHumans($assets->sum(fn ($asset) => $asset->size())),
                'unused' => $this->getUnused($assets)->count(),
            ];
        });

        return $containers;
    }

    public function getAssets(array $containers){
        return AssetContainer::all()->filter(function ($container) use ($containers) {
            return in_array($container->handle(), $containers);
        });
    }

    public function getUnused(AssetCollection $assets){
        return collect('content')
            ->map(fn ($folder) => File::allFiles(base_path($folder)))
            ->flatten()
            ->unique()
            ->each(function ($contentFile) use ($assets) {
                $contents = file_get_contents($contentFile);

                $assets->each(function ($asset, $index) use ($contents, $assets) {
                    // If asset is used in content, then remove it from unused list.
                    if (strpos($contents, $asset->path()) !== false) {
                        $assets->forget($index);
                    }
                });
            });
    }
}
