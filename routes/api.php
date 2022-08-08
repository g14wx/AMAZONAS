<?php

if (App::environment('production')) {
    URL::forceScheme('https');
}

use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/greeting",[UserController::class,"greeting"]);

Route::get("/hour",[UserController::class,"hour"]);

Route::get("/textMessageCampaignHealth",[UserController::class,"textMessageCampaignHealth"]);
Route::get("/emailCampaignHealth",[UserController::class,"emailCampaignHealth"]);
Route::get("/salesVsCampaign",[UserController::class,"salesVsCampaign"]);
Route::get("/subscriberGrowth",[UserController::class,"subscriberGrowth"]);
Route::get("/orderDetail", [\App\Http\Controllers\OrdersController::class,'order']);
