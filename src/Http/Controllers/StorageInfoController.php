<?php

namespace Neoisrecursive\StorageInfo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Neoisrecursive\StorageInfo\Services\StorageInfoService;

class StorageInfoController extends Controller
{
    public function __invoke(Request $request, StorageInfoService $service)
    {
        $data = $service->get($request->get('containers', []));

        return response($data);
    }
}
