<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('banners', BannerController::class);
    $router->resource('users', UserController::class);
    $router->resource('wechat', WechatController::class);

    Route::group(['prefix' => 'group'], function() use ($router){
        $router->get('export/{group_id}', 'GroupController@userExport');

        $router->resource('', GroupController::class);
        $router->resource('configs', GroupConfigController::class);
        $router->resource('goods', GroupCoinController::class);
        $router->post('goods/import/{group_id}', 'GroupCoinController@coinsImport');
    });

});
