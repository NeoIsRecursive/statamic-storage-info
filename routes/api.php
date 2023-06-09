<?php

use Illuminate\Support\Facades\Route;
use Neoisrecursive\StorageInfo\Http\Controllers\StorageInfoController;

Route::get('storage-info', StorageInfoController::class)->name('storage.info');
