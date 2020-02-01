<?php
Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index')->name('home.index');

Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'middleware' => 'auth'],
function (){
	Route::get('/', 'AdminController@index')->name('admin.index');
	Route::resource('users', 'UsersController', ['as' => 'admin']);
	Route::resource('marcas', 'MarcaController', ['as' => 'admin']);
	Route::resource('sucursales', 'SucursalController', ['as' => 'admin']);
	Route::resource('planes', 'PlanesAccionController', ['as' => 'admin']);
});
