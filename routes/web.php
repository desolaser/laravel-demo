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

Auth::routes(['register' => false]);

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', 'HomeController@index');

Route::get('/dashboard', 'HomeController@getDashboardData');
Route::get('/dashboard/send/{id}', 'HomeController@sendToAdmin');
Route::get('/dashboard/aprove/{id}', 'HomeController@aprove');
Route::get('/dashboard/cancel/{id}', 'HomeController@cancel');
Route::get('/dashboard/reject/{id}', 'HomeController@reject');
Route::get('/dashboard/operations/{id}', 'HomeController@operations');

Route::post('/dashboard/uploadSpecialData', 'ReportController@uploadSpecialData');
Route::post('/dashboard/deleteSpecialData', 'ReportController@deleteSpecialData');
Route::post('/dashboard/sendSpecialData', 'ReportController@sendSpecialData');
Route::get('/pdf/{id}', 'ReportController@generate');
Route::get('/pdf/workReport/{id}', 'ReportController@workReport');
Route::get('/pdf/costReport/{id}', 'ReportController@costReport');
Route::get('/sendPdf/{id}', 'ReportController@send');

Route::resource('/empresas','EmpresaController');

Route::resource('/centros','CentroController');

Route::resource('/contactos','ContactoController');

Route::resource('/servicios','ServicioController');

Route::resource('/categorias','CategoriaController');

Route::resource('/productos','ProductoController');

Route::resource('/notas','NotaController');

Route::resource('/users','UserController');

Route::resource('/seguimiento', 'SeguimientoController');

Route::resource('/trabajadores', 'TrabajadorController');

Route::resource('/precios','PrecioEmpresaController');
Route::get('/precios/editBasePrice/{id}','PrecioEmpresaController@editBasePrice');

Route::resource('/cotizaciones', 'CotizacionController');
Route::post('/cotizaciones/getDetalleCotizacion', 'CotizacionController@getDetalleCotizacion');
Route::post('/cotizaciones/getCentros', 'CotizacionController@getCentros');
Route::post('/cotizaciones/getContactos', 'CotizacionController@getContactos');
Route::post('/cotizaciones/getProductos', 'CotizacionController@getProductos');
Route::post('/cotizaciones/setProductos', 'CotizacionController@setProductos');
Route::post('/cotizaciones/delRow', 'CotizacionController@delRow');
Route::get('/cotizaciones/reactivate/{id}', 'CotizacionController@reactivate');
Route::get('/cotizaciones/show/{id}', 'CotizacionController@show');

Route::get('/operaciones','OperacionesController@index');
Route::post('/operaciones/resumedBudget', 'OperacionesController@resumedBudget');
Route::post('/operaciones/getDetails', 'OperacionesController@getDetails');
Route::post('/operaciones/addDetail', 'OperacionesController@addDetail');
Route::post('/operaciones/deleteDetail', 'OperacionesController@deleteDetail');
Route::post('/operaciones/getinfoCentros', 'OperacionesController@getinfoCentros');
Route::post('/operaciones/newFile', 'OperacionesController@newFile');
Route::post('/operaciones/getFile', 'OperacionesController@getFile');
Route::post('/operaciones/getBudgetFiles', 'OperacionesController@getBudgetFiles');
Route::get('/operaciones/getFile/{id}', 'OperacionesController@getFile');
Route::post('/operaciones/deleteFile', 'OperacionesController@deleteFile');
Route::post('/operaciones/facturar', 'OperacionesController@facturar');
Route::post('/operaciones/getTotalCost', 'OperacionesController@getTotalCost');

Route::get('/materiales/index/{id}', 'MaterialController@index');
Route::post('/materiales/show', 'MaterialController@show');
Route::post('/materiales/store', 'MaterialController@store');
Route::post('/materiales/edit', 'MaterialController@edit');
Route::post('/materiales/update', 'MaterialController@update');
Route::post('/materiales/delete', 'MaterialController@delete');

Route::get('/trabajos/index/{id}', 'TrabajoController@index');
Route::post('/trabajos/getWorks', 'TrabajoController@getWorks');
Route::post('/trabajos/store', 'TrabajoController@store');
Route::post('/trabajos/edit', 'TrabajoController@edit');
Route::post('/trabajos/update', 'TrabajoController@update');
Route::post('/trabajos/delete', 'TrabajoController@delete');
Route::post('/trabajos/workers', 'TrabajoController@workers');
Route::post('/trabajos/addWorker', 'TrabajoController@addWorker');
Route::post('/trabajos/deleteWorker', 'TrabajoController@deleteWorker');

Route::get('/gastos/index/{id}', 'GastosController@index');
Route::post('/gastos/show', 'GastosController@show');
Route::post('/gastos/store', 'GastosController@store');
Route::post('/gastos/edit', 'GastosController@edit');
Route::post('/gastos/update', 'GastosController@update');
Route::post('/gastos/delete', 'GastosController@delete');

Route::get('/tecnicos/index/{id}', 'DatosTecnicosController@index');

Route::post('/posts/show', 'PostController@show');
Route::post('/posts/store', 'PostController@store');
Route::post('/posts/edit', 'PostController@edit');
Route::post('/posts/update', 'PostController@update');
Route::post('/posts/delete', 'PostController@delete');

Route::post('/pc/show', 'PcController@show');
Route::post('/pc/store', 'PcController@store');
Route::post('/pc/edit', 'PcController@edit');
Route::post('/pc/update', 'PcController@update');
Route::post('/pc/delete', 'PcController@delete');

Route::post('/tv/show', 'TvController@show');
Route::post('/tv/store', 'TvController@store');
Route::post('/tv/edit', 'TvController@edit');
Route::post('/tv/update', 'TvController@update');
Route::post('/tv/delete', 'TvController@delete');

Route::post('/cable/show', 'CableController@show');
Route::post('/cable/store', 'CableController@store');
Route::post('/cable/edit', 'CableController@edit');
Route::post('/cable/update', 'CableController@update');
Route::post('/cable/delete', 'CableController@delete');

Route::post('/regulador/show', 'ReguladorController@show');
Route::post('/regulador/store', 'ReguladorController@store');
Route::post('/regulador/edit', 'ReguladorController@edit');
Route::post('/regulador/update', 'ReguladorController@update');
Route::post('/regulador/delete', 'ReguladorController@delete');

Route::post('/ap/show', 'ApController@show');
Route::post('/ap/show_modulo', 'ApController@show_modulo');
Route::post('/ap/store', 'ApController@store');
Route::post('/ap/store_modulo', 'ApController@store_modulo');
Route::post('/ap/edit', 'ApController@edit');
Route::post('/ap/edit_modulo', 'ApController@edit_modulo');
Route::post('/ap/update', 'ApController@update');
Route::post('/ap/update_modulo', 'ApController@update_modulo');
Route::post('/ap/delete', 'ApController@delete');
Route::post('/ap/delete_modulo', 'ApController@delete_modulo');

Route::post('/ups/show', 'UpsController@show');
Route::post('/ups/store', 'UpsController@store');
Route::post('/ups/edit', 'UpsController@edit');
Route::post('/ups/update', 'UpsController@update');
Route::post('/ups/delete', 'UpsController@delete');

Route::post('/switch/show', 'SwitchController@show');
Route::post('/switch/store', 'SwitchController@store');
Route::post('/switch/edit', 'SwitchController@edit');
Route::post('/switch/update', 'SwitchController@update');
Route::post('/switch/delete', 'SwitchController@delete');

Route::post('/dvr/show', 'DvrController@show');
Route::post('/dvr/store', 'DvrController@store');
Route::post('/dvr/edit', 'DvrController@edit');
Route::post('/dvr/update', 'DvrController@update');
Route::post('/dvr/delete', 'DvrController@delete');

Route::post('/camara/show', 'CamaraController@show');
Route::post('/camara/store', 'CamaraController@store');
Route::post('/camara/edit', 'CamaraController@edit');
Route::post('/camara/update', 'CamaraController@update');
Route::post('/camara/delete', 'CamaraController@delete');

Route::post('/broadcast/show', 'BroadcastController@show');
Route::post('/broadcast/store', 'BroadcastController@store');
Route::post('/broadcast/edit', 'BroadcastController@edit');
Route::post('/broadcast/update', 'BroadcastController@update');
Route::post('/broadcast/delete', 'BroadcastController@delete');

Route::resource('/facturas','FacturaController');
Route::post('/facturas/store','FacturaController@store');
Route::post('/facturas/newFile', 'FacturaController@newFile');
Route::get('/facturas/getFile/{id}', 'FacturaController@getFile');
Route::get('/facturas/getTempFile/{id}', 'FacturaController@getTempFile');
Route::post('/facturas/deleteFile', 'FacturaController@deleteFile');
Route::post('/facturas/newCotizacion', 'FacturaController@newCotizacion');
Route::post('/facturas/getCotizaciones', 'FacturaController@getCotizaciones');
Route::post('/facturas/deleteCotizacion', 'FacturaController@deleteCotizacion');

Route::resource('/movimientos', 'MovimientoController');
Route::get('/movimientos/account/{id}', 'MovimientoController@account');

Route::resource('/transferencias', 'TransferenciaController');
Route::post('/transferencias/store','TransferenciaController@store');
Route::get('/transferencias/create/{id}', 'TransferenciaController@create');
Route::post('/transferencias/newFile', 'TransferenciaController@newFile');
Route::get('/transferencias/getFile/{id}', 'TransferenciaController@getFile');
Route::get('/transferencias/getTempFile/{id}', 'TransferenciaController@getTempFile');
Route::post('/transferencias/deleteFile', 'TransferenciaController@deleteFile');
Route::post('/transferencias/newBill', 'TransferenciaController@newBill');
Route::post('/transferencias/deleteBill', 'TransferenciaController@deleteBill');
