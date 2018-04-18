<?php

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

Route::prefix('api')
    ->namespace($this->namespace)
    ->group(function () {
        Route::get('/user', function (Request $request) {
            return ['code' => 200, 'message' => 'ok'];
        });
    });
