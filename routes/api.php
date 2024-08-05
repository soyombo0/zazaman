<?php

use App\Http\Controllers\ParameterController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResources([
    'posts' => PostController::class,
    'parameters' => ParameterController::class
]);

Route::prefix('parameters')->group(function (Router $router) {
    $router->post('{parameter}/icon', [ParameterController::class, 'storeIcon'])->name('parameters.icon.store');
    $router->delete('{parameter}/icon', [ParameterController::class, 'destroyIcon'])->name('parameters.icon.delete');
    $router->post('{parameter}/icon-gray', [ParameterController::class, 'storeIconGray'])->name('parameters.icon.store');
    $router->delete('{parameter}/icon-gray', [ParameterController::class, 'destroyIconGray'])->name('parameters.icon.delete');
});
