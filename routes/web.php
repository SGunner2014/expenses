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

Route::resource("/years", "YearController");
Route::resource("/years/{year}/months", "MonthsController");