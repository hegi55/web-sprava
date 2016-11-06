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

Route::auth();

//Homepage
Route::get('/sprava', 'management@index');
Route::get('/', 'management@index');

//Add landing page
Route::post('/', 'management@add');

//Edit landing page
Route::get('/edit/{id}', 'management@edit');

//Delete landing page
Route::get('/delete/{id}', 'management@delete');

//Edit Jumping
Route::put('/', 'management@store');


//Administrácia
Route::get('/admin', 'management@admin');

//Administrácia - Vytvorenie Groupy
Route::post('/admin', 'management@adminAddGroup');

//Administrácia - Úprava Groupy
Route::get('/admin/group/{id}', 'management@adminEditGroup');

//Administrácia - Úprava Groupy - Validácia
Route::put('/admin/group/{id}/update', 'management@adminEditGroupUpdate');

//Administrácia - Úprava užívatela
Route::get('/admin/user/{id}', 'management@adminEditUser');

//Administrácia - Úprava užívatela - Update
Route::put('/admin/user/{id}/update', 'management@adminEditUserUpdate');

//Administrácia - Zmazanie užívatela
Route::get('/admin/user/{id}/delete', 'management@adminDeleteUser');
