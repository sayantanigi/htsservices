<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function () {
    Route::post('users', 'App\Http\Controllers\ApiController@store');
    // Route::post('users/{activity_id}/items', 'App\Http\Controllers\ApiController@storeLists');
    
    Route::get('property-types', 'App\Http\Controllers\ApiController@propertyType');
    Route::get('property-list', 'App\Http\Controllers\ApiController@list');
    // Route::get('users/{activity_id}', 'App\Http\Controllers\ApiController@getActivityById');
    
    // Route::patch('users/{activity_id}', 'App\Http\Controllers\ApiController@activityUpdate');
    // Route::patch('users/{activity_id}/items/{item_id}', 'App\Http\Controllers\ApiController@itemUpdate');

    // Route::delete('users/{activity_id}', 'App\Http\Controllers\ApiController@activityDestroy');
    // Route::delete('users/{activity_id}/items/{item_id}', 'App\Http\Controllers\ApiController@activityItemDestroy');
});
