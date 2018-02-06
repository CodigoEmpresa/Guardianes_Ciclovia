<?php
session_start();
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/personas', '\Idrd\Usuarios\Controllers\PersonaController@index');
Route::get('/personas/service/obtener/{id}', '\Idrd\Usuarios\Controllers\PersonaController@obtener');
Route::get('/personas/service/buscar/{key}', '\Idrd\Usuarios\Controllers\PersonaController@buscar');
Route::get('/personas/service/ciudad/{id_pais}', '\Idrd\Usuarios\Controllers\LocalizacionController@buscarCiudades');
Route::post('/personas/service/procesar/', '\Idrd\Usuarios\Controllers\PersonaController@procesar');


Route::get('login', function () {
    return view('login');
});

Route::post('listar_datos', 'FormController@listar_datos');


Route::any('/',['as' => '/','uses' => 'MainController@index']);

//rutas con filtro de autenticación
Route::group(['middleware' => ['web']], function () {
    Route::any('/logout', 'MainController@logout');
    Route::any('admin','FormController@admin');
    Route::any('insertar',['as' => 'insertar','uses' => 'FormController@insertar']);
    Route::any('/welcome', 'MainController@welcome');


    Route::get('cerrar', function () {
		session_start();
		session_destroy();
	    return view('welcome');
	});

});
/*