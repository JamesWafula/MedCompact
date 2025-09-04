<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ErrorFormController;
use App\Http\Controllers\DropDownDataController;
/*
|--------------------------------------------------------------------------
| Web Routes
| --------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ErrorFormController::class, 'load_form'])->name('errorform');

Route::post('/', [ErrorFormController::class, 'post_error'] )->name('errors.post');

Route::get('/success', function () {
    return Inertia::render('Success');
})->name('success');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () { 
        Route::get('/dashboard', [DashboardController::class, 'dash_home'])->name('dashboard');
      
        Route::get('/dashboard/tables', [DashboardController::class, 'dash_tables'])->name('dashboard.tables');

        Route::get('/dashboard/fields', [DropDownDataController::class, 'index'])->name('dashboard.fields');

        Route::get('/dashboard/profile', function () {
            return Inertia::render('Profile/Profile');
        })->name('dashboard.profile');
       
       Route::get('/dashboard/accounts', [DashboardController::class, 'dash_accounts'])->name('dashboard.accounts');

       Route::get('/dashboard/errorform', [DashboardController::class, 'dash_errorform'])->name('dashboard.errorform');

       Route::get('/dashboard/adduser', [DashboardController::class, 'dash_adduser'])->name('dashboard.adduser');

       Route::put('/user/update/accounttype/{id}', [DashboardController::class, 'put_accounttype'] )->name('dashboard.updateuser');
       Route::put('/user/update/password/{id}', [DashboardController::class, 'put_password'] )->name('dashboard.updatepassword');
       Route::get('/dashboard/user/register', [DashboardController::class, 'dash_register_account'] )->name('dashboard.registeruser');
       Route::post('/user/update/register', [DashboardController::class, 'dash_register_account_post'] )->name('dashboard.registeruserpost');
});

//posting dropdown data
Route::post('/errorfields/incidents', [DropDownDataController::class, 'post_incidents'] )->name('post_incident');
Route::post('/errorfields/location', [DropDownDataController::class, 'post_locations'] )->name('post_location');
Route::post('/errorfields/occupation', [DropDownDataController::class, 'post_occupation'] )->name('post_occuppation');
Route::post('/errorfields/outcome', [DropDownDataController::class, 'post_outcome'] )->name('post_outcome');
Route::post('/errorfields/possiblefactors', [DropDownDataController::class, 'post_possiblefactors'] )->name('post_possiblefactors');
Route::post('/errorfields/preventability', [DropDownDataController::class, 'post_preventability'] )->name('post_preventability');
Route::post('/errorfields/typeoferror', [DropDownDataController::class, 'post_typeoferror'] )->name('post_typeoferror');
Route::post('/errorfields/specificlocation', [DropDownDataController::class, 'post_specificlocation'] )->name('post_specificlocation');

//deleting dropdown data controller
Route::delete('/errorfields/incidents/{id}', [DropDownDataController::class, 'delete_incidents'])->name('delete_incidents');
Route::delete('/errorfields/location/{id}', [DropDownDataController::class, 'delete_locations'] )->name('delete_locations');
Route::delete('/errorfields/occupation/{id}', [DropDownDataController::class, 'delete_occupation'] )->name('delete_occupation');
Route::delete('/errorfields/outcome/{id}', [DropDownDataController::class, 'delete_outcome'] )->name('delete_outcome');
Route::delete('/errorfields/possiblefactors/{id}', [DropDownDataController::class, 'delete_possiblefactors'] )->name('delete_possiblefactors');
Route::delete('/errorfields/preventability/{id}', [DropDownDataController::class, 'delete_preventability'] )->name('delete_preventability');
Route::delete('/errorfields/typeoferror/{id}', [DropDownDataController::class, 'delete_typeoferror'] )->name('delete_typeoferror'); 
Route::delete('/errorfields/specificlocation/{id}', [DropDownDataController::class, 'delete_specificlocation'] )->name('delete_specificlocation'); 
