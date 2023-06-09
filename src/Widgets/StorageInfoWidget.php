<?php

declare(strict_types=1);

namespace Neoisrecursive\StorageInfo\Widgets;

use Statamic\Widgets\Widget;

class StorageInfoWidget extends Widget
{
    public function html()
    {
        return view('storage-info::widgets.storage-info-widget', [
            'containers' => implode(',', $this->config('containers') ?? []),
        ]);
    }
}
