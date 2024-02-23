<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/tesdb', function () {
    // Test database connection
    try {
        DB::connection()->getPdo();
        echo "Connected successfully to : " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        die("Could not connect to the database. Please check your configuration. error:" . $e);
    }
    // return view('welcome');
});

Route::get('/', 'App\Http\Controllers\HomeController@pusat')->name('pusat');

Route::get('/dpr/provinsi', 'App\Http\Controllers\HomeController@provinsi')->name('provinsi');

Route::get('/dpr/daerah', 'App\Http\Controllers\HomeController@daerah')->name('daerah');

Route::get('/tos', 'App\Http\Controllers\HomeController@tos')->name('tos');

Route::get('/donate', 'App\Http\Controllers\HomeController@donate')->name('donate');

Route::group(['prefix' => 'dapil', 'as' => 'dapil.'], function () {
    //For Anything That Dont Need Login
    Route::get('pusat/{kode}', [
        'as' => 'pusat',
        'uses' => 'App\Http\Controllers\HomeController@getKursiPusat',
    ]);
    Route::get('provinsi/{kode}', [
        'as' => 'provinsi',
        'uses' => 'App\Http\Controllers\HomeController@getKursiProvinsi',
    ]);
    Route::get('daerah/{kode}', [
        'as' => 'daerah',
        'uses' => 'App\Http\Controllers\HomeController@getKursidaerah',
    ]);
});
