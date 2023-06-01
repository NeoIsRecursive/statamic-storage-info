<?php

namespace Neoisrecursive\StorageInfo\Widgets;

use Statamic\Assets\AssetContainer as Container;
use Statamic\Facades\AssetContainer;
use Statamic\Support\Str;
use Statamic\Widgets\Widget;

class StorageWidget extends Widget
{
    /**
     * The HTML that should be shown in the widget.
     *
     * @return string|\Illuminate\View\View
     */
    public function html()
    {
        return view('storage-info::widgets.storage-widget', [
            'containers' => $this->getContainerData(),
        ]);
    }

    private function getContainerData() {
        $containers = AssetContainer::all()->filter(function ($container) {
            return config("filesystems.disks.{$container->diskHandle()}.driver") === 'local';
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
