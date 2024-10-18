<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ScategorieController;
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

Route::middleware('api')->group(function () {
    Route::resource('categories', CategorieController::class);
    });
    
    Route::get('/scat/{idcat}', [ScategorieController::class,'showSCategorieByCAT']);
    Route::middleware('api')->group(function () {
        Route::resource('articles', ArticleController::class);
        });
    Route::get('/articles/art/articlespaginate', [ArticleController::class,
'articlesPaginate']);
        