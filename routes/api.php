<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    EventController,
    PlanController,
    PlayerConfirmationController,
    PlayerController,
    TenantController,
    UserController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::apiResource('plans', PlanController::class);
Route::apiResource('tenants', TenantController::class);
Route::apiResource('users', UserController::class)->except('store');
Route::apiResource('events', EventController::class);
Route::apiResource('players', PlayerController::class);
Route::post('players/{player}/refreshcode', [PlayerController::class, 'refreshCode'])->name('players.refreshCode');

Route::middleware(['auth:sanctum', 'verified'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('confirmation/{event:token}/{player:code}', [PlayerConfirmationController::class, 'toggle'])->name('confirmation.toggle');
Route::get('event/{event:token}', [EventController::class, 'public'])->name('events.public');

