<?php

declare(strict_types=1);

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
    public function getCachedStorageInfo(): Collection
    {
        return Cache::rememberForever(self::CACHE_KEY, fn () => $this->getStorageInfo());
    }

    /**
     * Forget the storage info.
     */
    public function forget(): bool
    {
        return Cache::forget(self::CACHE_KEY);
    }

    /**
     * Get the container data.
     *
     * @return Collection<StorageInfoDto>
     */
    public function getStorageInfo(): Collection
    {
        return $this->getAssetContainers()->map(function (Container $container) {
            $assets = $container->assets();
            return StorageInfoDto::make(
                $container->title(),
                $container->showUrl(),
                $container->queryAssets()->count(),
                Str::fileSizeForHumans($assets->sum(fn ($asset) => $asset->size())),
                $this->getUnusedAssets($assets)->count(),
            );
        });
    }

    /**
     * Get the assets from the given containers.
     *
     * @return Collection<Container>
     */
    public function getAssetContainers(): Collection
    {
        return AssetContainer::all()->filter(
            fn ($container) => in_array($container->handle(), config('storage-info.hide-containers'))
        );
    }

    /**
     * Get the unused assets from the given collection.
     */
    public function getUnusedAssets(AssetCollection $assets): AssetCollection
    {
        $exclude = [
            'assets',
        ];

        collect(config('statamic.stache.stores'))
            ->map(
                fn ($store, $key) => !in_array($key, $exclude) && File::exists($store['directory'])
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
