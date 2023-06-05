<?php

declare(strict_types=1);

namespace Neoisrecursive\StorageInfo\Widgets;

use Statamic\Widgets\Widget;

class StorageInfoWidget extends Widget
{
    private $containers = [];
    public function __construct(string ...$containers) {
        $this->containers = $containers;
    }

    public function html()
    {
        return view('storage-info::widgets.storage-info-widget', [
            'containers' => $this->containers,
        ]);
    }
}
