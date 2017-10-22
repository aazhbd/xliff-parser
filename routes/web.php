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

Route::get('/',['as'=>'index','uses'=>'BaseController@index']);

Route::post('uploaded',['as'=>'xliff.post','uses'=>'BaseController@xliffPost']);

Route::get('import-file/{filename}',['as'=>'importFile','uses'=>'BaseController@importFile']);

Route::get('display',['as'=>'display','uses'=>'BaseController@display']);

Route::post('display',['as'=>'display','uses'=>'BaseController@display']);
