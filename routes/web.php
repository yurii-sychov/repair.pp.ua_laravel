<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CiphersController;
use App\Http\Controllers\CompleteRenovationObjectsController;
use App\Http\Controllers\EquipmentsController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\MaterialsPricesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkersController;
use App\Http\Controllers\WorkersPricesController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\SpecificRenovationObjectsController;
use App\Http\Controllers\SubdivisionsController;
use App\Http\Controllers\TechnicsController;
use App\Http\Controllers\TechnicsPricesController;
use App\Http\Controllers\TypeServicesController;

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
	return view('welcome');
});

Route::get('/dashboard', function () {
	return view('dashboard');
})
	->middleware(['auth'])
	->name('dashboard');

Route::resource('ciphers', CiphersController::class);

Route::resource(
	'complete_renovation_objects',
	CompleteRenovationObjectsController::class
)->name('index', 'complete_renovation_objects');

Route::resource('equipments_controller', EquipmentsController::class);

Route::resource('materials', MaterialsController::class);

Route::resource('materials_prices', MaterialsPricesController::class);

Route::get('materials_prices/create/tabular', [
	MaterialsPricesController::class,
	'create_tabular',
]);

Route::post('materials_prices/store/tabular', [
	MaterialsPricesController::class,
	'store_tabular',
]);

Route::post('materials_prices/store/price', [MaterialsPricesController::class, 'store_price']);

Route::resource('schedules', SchedulesController::class);

Route::resource('specific_renovation_objects', SpecificRenovationObjectsController::class);

Route::post('specific_renovation_objects/store/add_schedule_ajax', [
	SpecificRenovationObjectsController::class,
	'add_schedule_ajax',
]);

Route::post('specific_renovation_objects/store/add_passport_ajax', [
	SpecificRenovationObjectsController::class,
	'add_passport_ajax',
]);

Route::post('specific_renovation_objects/store/update_status_schedule_ajax', [
	SpecificRenovationObjectsController::class,
	'update_status_schedule_ajax',
]);

Route::resource('subdivisions', SubdivisionsController::class)->name(
	'index',
	'subdivisions'
);

Route::resource('technics', TechnicsController::class);
Route::resource('technics_prices', TechnicsPricesController::class);

Route::resource('type_repairs', TypeServicesController::class);

// Ciphers
Route::post('ciphers/store/create_ciphers_materials_ajax', [
	CiphersController::class,
	'create_ciphers_materials_ajax',
]);

Route::post('ciphers/store/create_ciphers_workers_ajax', [
	CiphersController::class,
	'create_ciphers_workers_ajax',
]);

Route::post('ciphers/store/create_ciphers_technics_ajax', [
	CiphersController::class,
	'create_ciphers_technics_ajax',
]);

Route::post('ciphers/show/get_resources_ajax', [
	CiphersController::class,
	'get_resources_ajax',
]);
// End cipher

Route::get('profile', [ProfileController::class, 'index']);

Route::post('profile/update_profile_ajax', [
	ProfileController::class,
	'update_profile_ajax',
]);

Route::resource('workers', WorkersController::class);
Route::resource('workers_prices', WorkersPricesController::class);

require __DIR__ . '/auth.php';
