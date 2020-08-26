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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'Site\HomeController@index')->name("home");
Route::get('login', 'Auth\LoginController@index')->name("login");
Route::post('login', 'Auth\LoginController@singIn');
Route::get('logout', 'Auth\LoginController@logout')->name("logout");
Route::get('/registration', 'Auth\RegisterController@index');
Route::post('/registration', 'Auth\RegisterController@registration')->name("registration");
Route::get('/reset', 'Auth\ResetController@index');
Route::post('/reset', 'Auth\ResetController@restore')->name("restore");


Route::get('/profile', 'Site\ProfileController@index')->name("profile");
Route::get('add-synonyms', 'Site\SynonymController@create')->name('create');
