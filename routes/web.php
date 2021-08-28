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

use App\Http\Controllers\NightingaleController;
use App\Http\Controllers\CrawlerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [CrawlerController::class, 'makeRequest']);

Route::match(['get', 'post'], '/botman', [NightingaleController::class, 'handle']);
