<?php
Auth::routes(['register' => false]);
// Route::get('export', 'MyController@export')->name('export');
// Route::get('importExportView', 'MyController@importExportView');
// Route::get('import', 'MyController@import')->name('import');

Route::group(['middleware' => 'auth'], function(){

Route::get('planes', 'HomeController@planes')->name('pages.planes');
// Route::get('/', 'Admin\AdminController@spa')->name('home.spa'); //vuejs app
Route::get('/', 'Admin\AdminController@index')->name('home.index'); 
Route::get('consultareporte', 'Admin\AdminController@index')->name('reporte');

Route::get('/region/{id}', 'Admin\AdminController@region')->name('home.region');

Route::get('/cedula/{id}', 'Admin\AdminController@cedula')->name('home.cedula');

// Exports
Route::get('exports', 'ExportsViewsController@index')->name('exports.home');
Route::get('exports/download', 'ExportsViewsController@export')->name('exports.export');
Route::get('exports/pdf', 'ExportsViewsController@viewpdf')->name('exports.pdf');
//endExports

});

Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
	'middleware' => 'auth'],
	function (){
		Route::get('/', 'AdminController@index')->name('admin.index');
		
		Route::resource('users', 'UsersController', ['as' => 'admin']);
		Route::resource('marcas', 'MarcaController', ['as' => 'admin']);
		Route::get('marcas/{marca}', 'MarcaController@showcedula', ['as' => 'admin'])->name('admin.marcas.showcedula');
		Route::resource('sucursales', 'SucursalController', ['as' => 'admin']);
		Route::resource('questions', 'QuestionsController', ['as' => 'admin']);
		Route::resource('segmentos', 'SegmentosController', ['as' => 'admin']);
		Route::resource('gruposm', 'GruposMarcasController', ['as' => 'admin']);
		Route::resource('auditorias', 'AuditoriasController', ['as' => 'admin']);
		Route::resource('roles', 'RolesController', ['except' => 'show', 'as' => 'admin']);
		Route::resource('resultados', 'ResultadoAuditoriaController', ['except' => 'show', 'index', 'create', 'delete', 'edit', 'as' => 'admin']);

		Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'edit', 'update'], 'as' => 'admin']);

		Route::get('/status', 'SegmentosController@status', ['as' => 'admin'])->name('admin.segmentos.status');

		Route::middleware('role:Admin')
			->put('users/{user}/roles', 'UsersRolesController@update')
			->name('admin.users.roles.update');


		Route::put('approved/{question}', 'QuestionsController@approved', ['as' => 'admin'])
		->name('admin.questions.approved');

		Route::middleware('role:Admin')
            ->put('users/{user}/permissions', 'UsersPermissionsController@update')->name('admin.users.permissions.update');
            
            //vuejs Routes
            Route::get('datos', 'AdminController@index');
            Route::get('gmarca', 'GruposMarcasController@index');
});