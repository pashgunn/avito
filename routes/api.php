<?php

use App\Http\Api\V1\Controllers\Banner\CommandController as BannerCommandController;
use App\Http\Api\V1\Controllers\Banner\QueryController as BannerQueryController;
use App\Http\Api\V1\Controllers\Feature\CommandController as FeatureCommandController;
use App\Http\Api\V1\Controllers\Feature\QueryController as FeatureQueryController;
use App\Http\Api\V1\Controllers\Tag\CommandController as TagCommandController;
use App\Http\Api\V1\Controllers\Tag\QueryController as TagQueryController;
use App\Http\Middleware\Auth;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

Route::get('user_banner', [BannerQueryController::class, 'userBanner'])->middleware(Auth::class);

Route::middleware(CheckAdmin::class)->group(function () {
    Route::prefix('banner')->group(function () {
        Route::get('/', [BannerQueryController::class, 'index']);

        Route::post('/', [BannerCommandController::class, 'create']);
        Route::put('bulk-toggle-status', [BannerCommandController::class, 'updateBannerStatuses']);
        Route::patch('{id}', [BannerCommandController::class, 'update']);
        Route::delete('{id}', [BannerCommandController::class, 'delete']);
    });

    Route::prefix('feature')->group(function () {
        Route::get('/', [FeatureQueryController::class, 'index']);
        Route::get('{id}', [FeatureQueryController::class, 'show']);

        Route::post('/', [FeatureCommandController::class, 'create']);
        Route::put('{id}', [FeatureCommandController::class, 'update']);
        Route::delete('{id}', [FeatureCommandController::class, 'delete']);
    });

    Route::prefix('tag')->group(function () {
        Route::get('/', [TagQueryController::class, 'index']);
        Route::get('{id}', [TagQueryController::class, 'show']);

        Route::post('/', [TagCommandController::class, 'create']);
        Route::post('{bannerId}/attach-tags', [TagCommandController::class, 'attachTags']);

        Route::put('{id}', [TagCommandController::class, 'update']);

        Route::delete('{id}', [TagCommandController::class, 'delete']);
        Route::delete('{bannerId}/detach-tags', [TagCommandController::class, 'detachTags']);
    });
});
