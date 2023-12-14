<?php

namespace Neoisrecursive\StorageInfo\Listeners;

use Illuminate\Contracts\Events\Dispatcher;
use Neoisrecursive\StorageInfo\Services\StorageInfoService;
use Statamic\Events\AssetDeleted;
use Statamic\Events\AssetSaved;
use Statamic\Events\AssetUploaded;
use Statamic\Events\EntryDeleted;
use Statamic\Events\EntrySaved;
use Statamic\Events\GlobalSetDeleted;
use Statamic\Events\GlobalSetSaved;
use Statamic\Events\TermDeleted;
use Statamic\Events\TermSaved;

class InvalidateCacheListener
{
    public function __construct(
        protected StorageInfoService $service,
    ) {
    }

    public function handle()
    {
        $this->service->forget();
    }

    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(AssetDeleted::class, $this->handle(...));
        $events->listen(AssetSaved::class, $this->handle(...));
        $events->listen(AssetUploaded::class, $this->handle(...));
        $events->listen(EntrySaved::class, $this->handle(...));
        $events->listen(EntryDeleted::class, $this->handle(...));
        $events->listen(GlobalSetSaved::class, $this->handle(...));
        $events->listen(GlobalSetDeleted::class, $this->handle(...));
        $events->listen(TermSaved::class, $this->handle(...));
        $events->listen(TermDeleted::class, $this->handle(...));
    }
}
