<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//调整路由如下
Route::middleware('web')
    ->namespace($this->namespace)
    ->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/foo', function () {
            echo "this is a test";
        });
    });
