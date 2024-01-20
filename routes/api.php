<?php

use App\Http\Controllers\Api\ApartmentController;

use App\Http\Controllers\Api\MessageController;

use App\Http\Controllers\Api\ServiceController;

use App\Http\Controllers\Api\ViewController;
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

//rotta api per tutti gli appartamenti, inclusi di sponsor e servizi
Route::get('/apartments', [ApartmentController::class, 'index']);

//rotta api per singolo appartamento, incluso di sponsor e servizi
Route::get('/apartments/{apartment:slug}', [ApartmentController::class, 'show']);

//rotta per mandare dati al db
Route::post('/contacts', [MessageController::class, 'store']);

//rotta per mandare le views al db
Route::post('/views', [ViewController::class, 'store']);

//rotta per tutti i servizi
Route::get('/services', [ServiceController::class, 'index']);

