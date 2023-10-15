<?php

namespace Neoisrecursive\StorageInfo\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Neoisrecursive\StorageInfo\DataTransferObjects\StorageInfoDto;
use Statamic\Assets\AssetCollection;
use Statamic\Assets\AssetContainer as Container;
use Statamic\Facades\AssetContainer;
use Statamic\Support\Str;

class StorageInfoService
{
    public const CACHE_KEY = 'neoisrecursive:storage-info';

    /**
     * Get the storage info.
     * 
     * @return Collection<StorageInfoDto>
     */
    public function get(array $containers)
    {
        return $this->getContainerData($containers);
        return Cache::rememberForever(self::CACHE_KEY, fn () => $this->getContainerData($containers));
    }

    /**
     * Forget the storage info.
     */
    public function forget()
    {
        return Cache::forget(self::CACHE_KEY);
    }

    /**
     * Get the container data.
     * 
     * @return Collection<array>
     */
    public function getContainerData(array $containers)
    {
        $containers = $this->getAssets($containers)->map(function (Container $container) {
            $assets = $container->assets();
            return new StorageInfoDto(
                $container->title(),
                $container->showUrl(),
                $container->queryAssets()->count(),
                Str::fileSizeForHumans($assets->sum(fn ($asset) => $asset->size())),
                $this->getUnused($assets)->count(),
            );
        });

        return $containers;
    }

    /**
     * Get the assets from the given containers.
     * 
     * @return Collection<Container>
     */
    public function getAssets(array $containers): Collection
    {
        return AssetContainer::all()->filter(function ($container) use ($containers) {
            return in_array($container->handle(), $containers);
        });
    }

    /**
     * Get the unused assets from the given collection.
     */
    public function getUnused(AssetCollection $assets): AssetCollection
    {
        $exclude = [
            'assets',
        ];

        collect(config('statamic.stache.stores'))
            ->map(
                fn ($store, $key) => !in_array($key, $exclude)
                    ? File::allFiles($store['directory'])
                    : []
            )
            ->flatten()
            ->unique()
            ->each(function ($contentFile) use ($assets) {
                $contents = file_get_contents($contentFile);

                $assets->each(function ($asset, $index) use ($contents, $assets) {
                    if (strpos($contents, $asset->path()) !== false) {
                        $assets->forget($index);
                    }
                });
            });

        return $assets;
    }
}
