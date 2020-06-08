<?php
Auth::routes(['register' => false]);

Route::get('chartex', function() {
    return view('charts');
});
Route::group(['middleware' => 'auth'], function () {
//    Route::get('/', 'Admin\AdminController@spa')->name('home.spa'); //vuejs app

    Route::get('planes', 'HomeController@planes')->name('pages.planes');
    Route::get('/', 'Admin\AdminController@index')->name('home.index');

    Route::get('consultareporte', 'Admin\AdminController@index')->name('reporte');

    Route::get('/region/{id}', 'Admin\AdminController@region')->name('home.region');

    Route::get('/cedula/{id}', 'Admin\AdminController@cedula')->name('home.cedula');

    // Exports
    Route::get('exports/cuestionario', 'ExportsViewsController@index')->name('exports.home');
    Route::get('exports/download', 'ExportsViewsController@export')->name('exports.export');
    Route::get('exports/pdf', 'ExportsViewsController@viewpdf')->name('exports.pdf');
    //endExports// Exports
    Route::get('exports/auditoria', 'ExportsViewsController@auditoria')->name('export.auditoria');
    Route::get('exports/detalles/sucursales', 'ExportsViewsController@detailscharts')->name('export.chart');
    Route::get('exports/auditoria/download', 'ExportsViewsController@exportauditoria')->name('exports.auditoria');
    Route::get('exports/auditoria/pdf', 'ExportsViewsController@exportauditoriapdf')->name('exports.auditoria.pdf');
    //endExports
    Route::get('exports/all/pdf', 'ExportsViewsController@allpdf')->name('exports.all.pdf');
    Route::get('exports/allauditoria/pdf', 'ExportsViewsController@allauditoriapdf')->name('exports.allauditoria.pdf');

    Route::get('chart/cuestionario', 'Admin\AdminController@charts')->name('chart.cuestionario');
    Route::get('zonas', 'Admin\AdminController@zonaslist')->name('zonas.lista');
    Route::get('regiones', 'Admin\AdminController@regionList')->name('region.lista');

});

Route::group(
      [
            'prefix' => 'admin',
            'namespace' => 'Admin',
            'middleware' => 'auth'
      ],
      function () {
            Route::get('/', 'AdminController@index')->name('admin.index');

            Route::resource('users', 'UsersController', ['as' => 'admin']);
            Route::resource('marcas', 'MarcaController', ['as' => 'admin']);

            Route::get('marcas/cedulas/{marca}', 'MarcaController@showcedula', ['as' => 'admin'])->name('admin.marcas.cedula');
            Route::get('marcas/vips/{marca}', 'MarcaController@showVips', ['as' => 'admin'])->name('admin.marcas.vips');
            Route::get('marcas/vips/detalles/{marca}', 'MarcaController@showVipsDetails', ['as' => 'admin'])->name('admin.marcas.detail.vips');

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

            Route::get('promedio', 'AdminController@promedio')->name('promedio');

            Route::post('userdata/{user}', 'UsersController@userdata')->name('admin.users.userdata');
            Route::post('userreset/{user}', 'UsersController@resetpass')->name('admin.users.resetpass');
            //vuejs Routes
            Route::get('datos', 'AdminController@index');
            Route::get('gmarca', 'GruposMarcasController@index');
      }
);
