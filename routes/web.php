<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/not_permission', [AuthController::class, 'not_permission'])->name('not_permission');

//Admin

Route::middleware('admin')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('index');

    Route::get('/autocomplete-search', [AuthController::class, 'autocomplete_search'])->name('autocomplete-search');

    Route::prefix('type')->group(function () {
        Route::get('/add-type', [TypeController::class, 'create'])->name('add-type');
        Route::post('/save-type', [TypeController::class, 'store'])->name('save-type');
        Route::get('/all-type', [TypeController::class, 'index'])->name('all-type');
        Route::get('/edit-type/{id}', [TypeController::class, 'edit'])->name('edit-type');
        Route::post('/update-type{id}', [TypeController::class, 'update'])->name('update-type');
        Route::get('/delete-type/{id}', [TypeController::class, 'destroy'])->name('delete-type');
    });

    Route::prefix('equipment')->group(function () {
        Route::get('/add-equipment', [EquipmentController::class, 'create'])->name('add-equipment');
        Route::post('/save-equipment', [EquipmentController::class, 'store'])->name('save-equipment');
        Route::get('/all-equipment', [EquipmentController::class, 'index'])->name('all-equipment');
        Route::get('/edit-equipment/{id}', [EquipmentController::class, 'edit'])->name('edit-equipment');
        Route::post('/update-equipment/{id}', [EquipmentController::class, 'update'])->name('update-equipment');
        Route::get('/delete-equipment/{id}', [EquipmentController::class, 'destroy'])->name('delete-equipment');
        Route::post('/equipment_search', [EquipmentController::class, 'equipment_search'])->name('equipment_search');
    });

    Route::prefix('borrow')->group(function () {
        Route::get('/all-borrow', [BorrowController::class, 'all_borrow'])->name('all-borrow');
        Route::get('/accept-borrow/{id}', [BorrowController::class, 'accept_borrow'])->name('accept-borrow');
        Route::get('/reject-borrow/{id}', [BorrowController::class, 'reject_borrow'])->name('reject-borrow');
        Route::get('/give_back_equipment/{id}', [BorrowController::class, 'give_back_equipment'])->name('give_back_equipment');
        Route::post('/borrow_by_user', [BorrowController::class, 'borrow_by_user'])->name('borrow_by_user');
    });
});


//Employee
Route::middleware('employee')->group(function () {
    Route::get('/home', [EmployeeController::class, 'index'])->name('employee.index');

    Route::prefix('employee')->group(function () {
        Route::get('/show_equipment/{id}', [EmployeeController::class, 'show'])->name('show_equipment');
        Route::get('/detail_equipment/{id}', [EmployeeController::class, 'detail'])->name('detail_equipment');
        Route::get('/borrow_equipment/{id}', [EmployeeController::class, 'borrow'])->name('borrow_equipment');
        Route::get('/list_borrow_equipment/{id}', [EmployeeController::class, 'list_borrow'])->name('list_borrow_equipment');
        Route::get('/cancel_borrow/{id}', [EmployeeController::class, 'cancel_borrow'])->name('cancel_borrow');
    });
});





Route::prefix('auth')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::middleware('admin')->get('/register', [UserController::class, 'register'])->name('register');
    Route::middleware('admin')->post('/confirm_register', [UserController::class, 'create'])->name('confirm_register');
    Route::post('/confirm_login', [UserController::class, 'confirm_login'])->name('confirm_login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
