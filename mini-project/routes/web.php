<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\authentication;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PurchaseController;


Route::get('/', [authentication::class, 'login']);
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


Route::get('/purchase', [PurchaseController::class, 'showpurchase']);
Route::get('/add_purchase', [PurchaseController::class, 'showaformpurchase']);
Route::post('/database-purchase', [PurchaseController::class, 'addpurchase']);

Route::get('/purchase/edit/{id}', [PurchaseController::class, 'edit']);
Route::post('/purchase/update/{id}', [PurchaseController::class, 'update']);

Route::get('/purchase/delete/{id}', [PurchaseController::class, 'delete']);



Route::get('/sales', [PurchaseController::class, 'showsale']);
Route::get('/add_sale', [PurchaseController::class, 'showaformsale']);
Route::post('/database-sale', [PurchaseController::class, 'addsale']);


Route::get('/sale/edit/{id}', [PurchaseController::class, 'editsale']);
Route::post('/sale/update/{id}', [PurchaseController::class, 'updatesale']);

Route::get('/sale/delete/{id}', [PurchaseController::class, 'deletesale']);
