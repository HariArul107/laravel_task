<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\authentication;
use App\Http\Controllers\ListController;

Route::get('/log-in', [authentication::class, 'login']);
Route::post('/loginhome', [authentication::class, 'loginhome']);

Route::get('/register', [authentication::class, 'register']);
Route::post('/store-data', [authentication::class, 'storeData']);

Route::get('/home', [authentication::class, 'home']);
Route::get('/logout', [authentication::class, 'logout']);

Route::get('/category', [ListController::class, 'showcategory']);
Route::get('/add_category', [ListController::class, 'showaddcategory']);
Route::post('/database-add', [ListController::class, 'addcategory']);

Route::get('/item', [ListController::class, 'showpage']);
Route::get('/add_item', [ListController::class, 'additem']);
Route::post('/database_item', [ListController::class, 'adddata']);


Route::get('/category/edit/{id}', [ListController::class, 'editcategory']);
Route::post('/category/update/{id}', [ListController::class, 'updatecategory']);


Route::get('/category/delete/{id}', [ListController::class, 'deletecategory']);


Route::get('/item/edit/{id}', [ListController::class, 'edititem']);
Route::post('/item/update/{id}', [ListController::class, 'updateitem']);

Route::get('/item/delete/{id}', [ListController::class, 'deleteitem']);

