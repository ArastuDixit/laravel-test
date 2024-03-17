<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', [AdminController::class, 'admin'])->name('admin.login');
Route::get('admin/login', [AdminController::class, 'index'])->name('admin.login');

Route::post('admin/admin-login', [AdminController::class, 'adminLogin'])->name('login.admin');



Route::get('admin/registration', [AdminController::class, 'registration'])->name('register-admin');

Route::post('admin/admin-registration', [AdminController::class, 'adminRegistration'])->name('register.admin');


Route::middleware('auth:user')->prefix('admin')->group(function () {



Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');





Route::get('signout', [AdminController::class, 'signOut'])->name('admin-signout');


Route::post('api/fetch-states', [AdminController::class, 'fetchState']);
Route::post('api/fetch-cities', [AdminController::class, 'fetchCity']);

Route::get('profile', [AdminController::class, 'show'])->name('profile.show');


    Route::get('user', [AdminController::class, 'userList'])->name('admin.user');
    Route::get('user/createuser', [AdminController::class, 'addUser'])->name('admin.user.createuser');
    Route::post('user/saveuser', [AdminController::class, 'saveUser'])->name('admin.user.saveuser');
    Route::get('user/edituser/{id}', [AdminController::class, 'editUser'])->name('admin.user.edituser');
    Route::get('user/viewuser/{id}', [AdminController::class, 'viewUser'])->name('admin.user.viewuser');
    Route::post('user/updateuser/{id}', [AdminController::class, 'updateUser'])->name('admin.user.updateuser');
    Route::get('user/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
    Route::post('user/updateuserPassword/{id}', [AdminController::class, 'updateuserPassword'])->name('admin.user.updateuserPassword');

});


Route::get('admin/employee', [EmployeeController::class, 'employee'])->name('admin.employee');
Route::post('/store', [EmployeeController::class, 'store'])->name('store');
Route::get('/fetchall', [EmployeeController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete', [EmployeeController::class, 'delete'])->name('delete');
Route::get('/edit', [EmployeeController::class, 'edit'])->name('edit');
Route::post('/update', [EmployeeController::class, 'update'])->name('update');
