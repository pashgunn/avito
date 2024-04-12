<?php

use App\Http\Api\V1\Controllers\Banner\CommandController as BannerCommandController;
use App\Http\Api\V1\Controllers\Banner\QueryController as BannerQueryController;
use App\Http\Api\V1\Controllers\Feature\CommandController as FeatureCommandController;
use App\Http\Api\V1\Controllers\Feature\QueryController as FeatureQueryController;
use App\Http\Api\V1\Controllers\Tag\CommandController as TagCommandController;
use App\Http\Api\V1\Controllers\Tag\QueryController as TagQueryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::prefix('banners')->group(function () {
       Route::get('/', [BannerQueryController::class, 'index']);
       Route::get('{id}', [BannerQueryController::class, 'show']);

       Route::post('/', [BannerCommandController::class, 'create']);
       Route::put('{id}', [BannerCommandController::class, 'update']);
       Route::delete('{id}', [BannerCommandController::class, 'delete']);
    });

    Route::prefix('features')->group(function () {
       Route::get('/', [FeatureQueryController::class, 'index']);
       Route::get('{id}', [FeatureQueryController::class, 'show']);

       Route::post('/', [FeatureCommandController::class, 'create']);
       Route::put('{id}', [FeatureCommandController::class, 'update']);
       Route::delete('{id}', [FeatureCommandController::class, 'delete']);
    });

    Route::prefix('tags')->group(function () {
        Route::get('/', [TagQueryController::class, 'index']);
        Route::get('{id}', [TagQueryController::class, 'show']);

        Route::post('/', [TagCommandController::class, 'create']);
        Route::put('{id}', [TagCommandController::class, 'update']);
        Route::delete('{id}', [TagCommandController::class, 'delete']);
    });
});