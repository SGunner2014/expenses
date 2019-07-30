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

Route::get("/", function() {
    return view("index");
});
Route::get("/home", function() {
    return view("index");
});
Auth::routes();

Route::resource("/years", "YearController")->middleware("auth");
Route::resource("/years/{year}/months", "MonthsController")->middleware("auth");
Route::resource("/children", "ChildrenController")->middleware("auth");
Route::resource("/recurring", "RecurringController")->middleware("auth");
Route::resource("/expenses", "ExpensesController")->middleware("auth");