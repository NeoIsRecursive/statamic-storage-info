<?php

namespace Neoisrecursive\StorageInfo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Neoisrecursive\StorageInfo\Services\StorageInfoService;

class StorageInfoController extends Controller
{
    public function __invoke(Request $request, StorageInfoService $service)
    {
        return response([
            'data' => $service->get($request->input('containers', []))->map->toArray(),
            'meta' => [
                'columns' => [
                    [
                        'label' => 'Container',
                        'field' => 'name',
                        'type' => 'string',
                        'sortable' => true,
                    ],
                    [
                        'label' => 'Assets',
                        'field' => 'files',
                        'type' => 'number',
                        'sortable' => true,
                    ],
                    [
                        'label' => 'Unused',
                        'field' => 'unused',
                        'type' => 'number',
                        'sortable' => true,
                    ],
                    [
                        'label' => 'Size',
                        'field' => 'spaceUsed',
                        'type' => 'number',
                        'sortable' => true,
                    ],
                ]
            ],
        ]);
    }
}
