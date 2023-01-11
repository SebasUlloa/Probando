<?php

use App\Http\Controllers\EmptySqlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SQLite3;
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

Route::get('/', function () {
    return view('auth.login');
});

/*--------------------VISTAS APP----------------------*/


/*---------------------DESCARGA SQL----------------------------*/
Route::get('download-sql', 'App\Http\Controllers\CrucianelliController@downloadsql')->name('download-sql');

Route::get('generar/{machineID}', 'App\Http\Controllers\SQLite3@generar')->name('generar');
Route::get('crucianelli', 'App\Http\Controllers\CrucianelliController@index');

/*--------------------VISTAS COMPLETA APP----------------------*/
Route::get('crucianelli/createmachine', 'App\Http\Controllers\CrucianelliController@createmonitor')->name('createmachine');

Route::get('crucianelli/products', 'App\Http\Controllers\ProductsController@index')->name('products');

Route::get('crucianelli/createproducts', 'App\Http\Controllers\ProductsController@createProfull')->name('createprofull');
Route::post('crucianelli/createproducts', 'App\Http\Controllers\ProductsController@createProfull')->name('createprofull');

Route::get('crucianelli/sensorsrows', 'App\Http\Controllers\ProductsSensorController@selectproducts')->name('sensorsrows');
Route::get('crucianelli/sensorsline', 'App\Http\Controllers\ProductsSensorController@selectproducts')->name('sensorsrows');

Route::get('crucianelli/rowsoffset', 'App\Http\Controllers\DefasajesController@index')->name('rowsoffset');
Route::get('createoffset', 'App\Http\Controllers\DefasajesController@createoffset')->name('createoffset');
Route::post('createoffset', 'App\Http\Controllers\DefasajesController@createoffset')->name('createoffset');

Route::get('crucianelli/actuators', 'App\Http\Controllers\ActuatorController@indexFull')->name('actuators');
Route::get('hasFullactuators', 'App\Http\Controllers\ActuatorController@hasFullactuators')->name('hasFullactuators');
Route::post('hasFullactuators', 'App\Http\Controllers\ActuatorController@hasFullactuators')->name('hasFullactuators');

Route::get('crucianelli/ecus', 'App\Http\Controllers\EcusController@index')->name('ecus');
Route::get('createecus', 'App\Http\Controllers\EcusController@createecus')->name('createecus');
Route::post('createecus', 'App\Http\Controllers\EcusController@createecus')->name('createecus');

Route::get('crucianelli/sensors', 'App\Http\Controllers\SensorsController@index')->name('sensors');
Route::get('hasfullsensors', 'App\Http\Controllers\SensorsController@hasfullsensors')->name('hasfullsensors');
Route::post('hasfullsensors', 'App\Http\Controllers\SensorsController@hasfullsensors')->name('hasfullsensors');

Route::get('crucianelli/configs', 'App\Http\Controllers\RelacionEcusController@index')->name('configs');
Route::get('setconfigs', 'App\Http\Controllers\RelacionEcusController@setConfigs')->name('setconfigs');
Route::post('setconfigs', 'App\Http\Controllers\RelacionEcusController@setConfigs')->name('setconfigs');

Route::get('crucianelli/plantingtypes', 'App\Http\Controllers\PlantingtypesController@index')->name('plantingtypes');

Route::get('crucianelli/createfullplanting', 'App\Http\Controllers\PlantingtypesController@createfullplanting')->name('createfullplanting');
Route::post('crucianelli/createfullplanting', 'App\Http\Controllers\PlantingtypesController@createfullplanting')->name('createfullplanting');

Route::get('savefullPlanting', 'App\Http\Controllers\PlantingtypesController@savefullPlanting')->name('savefullPlanting');
Route::post('savefullPlanting', 'App\Http\Controllers\PlantingtypesController@savefullPlanting')->name('savefullPlanting');

Route::get('prosenprofull', 'App\Http\Controllers\PlantingtypesController@prosenprofull')->name('prosenprofull');
Route::post('prosenprofull', 'App\Http\Controllers\PlantingtypesController@prosenprofull')->name('prosenprofull');

Route::get('crucianelli/plantingtypes', 'App\Http\Controllers\PlantingtypesController@index')->name('plantingtypes');

Route::get('crucianelli/plantingseccion', 'App\Http\Controllers\PlantingtypesController@plantingSeccion')->name('plantingseccion');
Route::post('crucianelli/plantingseccion', 'App\Http\Controllers\PlantingtypesController@plantingSeccion')->name('plantingseccion');

Route::get('saveSeccion', 'App\Http\Controllers\PlantingtypesController@saveSeccion')->name('saveSeccion');
Route::post('saveSeccion', 'App\Http\Controllers\PlantingtypesController@saveSeccion')->name('saveSeccion');

Route::get('deleteplantingtype/{plantingTypeId}', 'App\Http\Controllers\PlantingtypesController@destroy')->name('deleteplantingtype');
Route::post('deleteplantingtype/{plantingTypeId}', 'App\Http\Controllers\PlantingtypesController@destroy')->name('deleteplantingtype');

/*--------------------VISTAS SOLO MONITOR APP----------------------*/

Route::get('crucianelli/createmonitor', 'App\Http\Controllers\CrucianelliController@createmonitor')->name('createmonitor');
Route::post('crucianelli/createmonitor', 'App\Http\Controllers\CrucianelliController@createmonitor')->name('createmonitor');

Route::get('crucianelli/productsmonitor', 'App\Http\Controllers\ProductsController@indexmonitor')->name('productmonitor');

Route::get('crucianelli/productssensora', 'App\Http\Controllers\ProductsSensorController@productssensor')->name('productssensora');

Route::get('crucianelli/sensorslineamonitor', 'App\Http\Controllers\ProductsSensorController@productssensor')->name('sensorslineamonitor');

Route::get('crucianelli/actuatorsmonitor', 'App\Http\Controllers\ActuatorController@index')->name('actuatorsmonitor');
Route::get('crucianelli/sensorsmonitor', 'App\Http\Controllers\SensorsController@indexmonitor')->name('sensorsmonitor');
Route::get('crucianelli/plantingtypesmonitor', 'App\Http\Controllers\PlantingtypesController@indexmonitor')->name('plantingtypesmonitor');
Route::get('crucianelli/new-plantingtypesmonitor', 'App\Http\Controllers\PlantingtypesController@indexmonitor')->name('new-plantingtypesmonitor');

Route::get('crucianelli/createproductmonitor', 'App\Http\Controllers\ProductsController@createProdMon')->name('createproductmonitor');
Route::post('crucianelli/createproductmonitor', 'App\Http\Controllers\ProductsController@createProdMon')->name('createproductmonitor');


Route::get('hasmany', 'App\Http\Controllers\ProductsSensorController@hasmany')->name('hasmany');
Route::post('hasmany', 'App\Http\Controllers\ProductsSensorController@hasmany')->name('hasmany');

Route::post('hasactuator', 'App\Http\Controllers\ActuatorController@hasactuator')->name('hasactuator');
Route::get('hasactuator', 'App\Http\Controllers\ActuatorController@hasactuator')->name('hasactuator');

Route::get('hassensors', 'App\Http\Controllers\SensorsController@hassensors')->name('hassensors');
Route::post('hassensors', 'App\Http\Controllers\SensorsController@hassensors')->name('hassensors');

Route::get('crucianelli/createplantingtype', 'App\Http\Controllers\PlantingtypesController@createplanting')->name('createplanting');
Route::post('crucianelli/createplantingtype', 'App\Http\Controllers\PlantingtypesController@createplanting')->name('createplanting');

Route::get('prueba', 'App\Http\Controllers\PlantingtypesController@prueba')->name('prueba');
Route::post('prueba', 'App\Http\Controllers\PlantingtypesController@prueba')->name('prueba');

Route::get('savePlanting', 'App\Http\Controllers\PlantingtypesController@savePlanting')->name('savePlanting');
Route::post('savePlanting', 'App\Http\Controllers\PlantingtypesController@savePlanting')->name('savePlanting');

Route::get('prosenpro', 'App\Http\Controllers\PlantingtypesController@prosenpro')->name('prosenpro');
Route::post('prosenpro', 'App\Http\Controllers\PlantingtypesController@prosenpro')->name('prosenpro');


Route::resource('crucianelli', 'App\Http\Controllers\CrucianelliController');
Route::resource('products', 'App\Http\Controllers\ProductsController');
Route::resource('erca', 'App\Http\Controllers\ErcaController');
Route::resource('sensors', 'App\Http\Controllers\SensorsController');
Route::resource('sensorslinea', 'App\Http\Controllers\SensorsController');
Route::resource('defasajes', 'App\Http\Controllers\DefasajesController');
Route::resource('actuadores', 'App\Http\Controllers\ActuatorsController');
Route::resource('ecus', 'App\Http\Controllers\EcusController');
Route::resource('relacionecus', 'App\Http\Controllers\RelacionEcusController');
Route::resource('plantingtypes', 'App\Http\Controllers\PlantingtypesController');
Route::resource('productssensor', 'App\Http\Controllers\ProductsSensorController');


/*----------------------PDF-----------------------------*/
Route::get('download-pdf', 'App\Http\Controllers\CrucianelliController@downloadPdf')->name('download-pdf');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
