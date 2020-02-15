<?php
Auth::routes(['register' => false]);
Route::get('planes', 'HomeController@planes')->name('pages.planes');
Route::get('/', 'Admin\AdminController@index')->name('home.index');
Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'middleware' => 'auth'],
function (){
	Route::get('/', 'AdminController@index')->name('admin.index');
	Route::resource('users', 'UsersController', ['as' => 'admin']);
	Route::resource('marcas', 'MarcaController', ['as' => 'admin']);
	Route::resource('sucursales', 'SucursalController', ['as' => 'admin']);
	Route::resource('questions', 'QuestionsController', ['as' => 'admin']);
	Route::resource('segmentos', 'SegmentosController', ['as' => 'admin']);
	Route::resource('gruposm', 'GruposMarcasController', ['as' => 'admin']);
	Route::resource('auditorias', 'AuditoriasController', ['as' => 'admin']);
	Route::get('/status', 'SegmentosController@status', ['as' => 'admin'])->name('admin.segmentos.status');
	Route::put('approved/{question}', 'QuestionsController@approved', ['as' => 'admin'])
	->name('admin.questions.approved');
});
