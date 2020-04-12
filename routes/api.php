<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    // Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['prefix' => 'group'], function ($route) {
    $route->get('', 'GroupController@index');
    $route->post('', 'GroupController@store');
    $route->get('current/price/{goods_id}', 'GroupController@currentPrice'); // 当前价
    $route->get('my', 'GroupController@userGroup'); // 我的竞价列表
    $route->resource('history', GroupBuyingController::class)->only(['index', 'show']);
});
Route::get('wechat', 'WechatController@show');
Route::get('banners', 'BannerController@index');
