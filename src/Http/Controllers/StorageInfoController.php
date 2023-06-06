<?php

namespace Neoisrecursive\StorageInfo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Statamic\Assets\AssetContainer as Container;
use Statamic\Facades\AssetContainer;
use Statamic\Support\Str;

class StorageInfoController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = Cache::remember('neoisrecursive:storage-info', 3600, fn () => $this->getContainerData($request->get('containers')));

        return response($data);
    }

    private function getContainerData(array $containers)
    {
        $containers = AssetContainer::all()->filter(function ($container) use ($containers) {
            return in_array($container->handle(), $containers);
        })->map(function (Container $container) {
            return [
                'name' => $container->title(),
                'files' => $container->queryAssets()->count(),
                'url' => $container->showUrl(),
                'spaceUsed' =>  Str::fileSizeForHumans($container->assets()->sum(function ($asset) {
                    return $asset->size();
                })),
            ];
        });

        return $containers;
    }
}
