<?php
use Illuminate\Http\Request;

//PUBLIC
Route::get('/', 'PublicController@index');

Route::get('/detalii/{idul}', 'PublicController@detalii');
Route::get('/cos', 'PublicController@cosGet');
Route::post('/cos', 'PublicController@cosPost');
Route::put('/cos', 'PublicController@cosPut');
Route::get('/comenzi/{date?}', 'PublicController@formular');
Route::post('/comenzi', 'PublicController@comenziInsert');
Route::post('/login', 'PublicController@loginPost');
Route::get('/login', 'PublicController@loginGet');
Route::get('/logout', 'PublicController@logout');

//ADMIN
Route::get('/admin', 'AdminController@admin');
Route::get('/admin/produse', 'AdminController@produse');
Route::get('/admin/comenzi', 'AdminController@comenzi');
Route::get('/admin/produse/adauga', 'AdminController@adauga_produse');
Route::post('/admin/produse/process', 'AdminController@post_produs');
Route::get('/admin/produse/process', 'AdminController@post_produs_get');
Route::get('/admin/pro/{idul}', 'AdminController@pro');
Route::put('/admin/produse/editare', 'AdminController@editarePut');
Route::get('/admin/produse/editare', 'AdminController@editareGet');

//WEBSERVICE
Route::get('/webservice/{operatie}.{format}/{id?}', 'Webservice@doit');