<?php

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\DashboardController;

// Route::get('/', 'App\Http\Controllers\Customer\CustomerController@login')->name('login');
// Route::get('/login', 'App\Http\Controllers\Customer\CustomerController@login')->name('login');
// Route::post('/loginProcess', 'App\Http\Controllers\Customer\CustomerController@loginProcess')->name('loginprocess');	
// Route::get('/forgot-password', 'App\Http\Controllers\Customer\CustomerController@forgotPassword')->name('forgotpassword');
// Route::get('/logout', 'App\Http\Controllers\Customer\CustomerController@logout')->name('logout');


// Route::get('user/register/', function () {
// 	return redirect()->route('register.step');
// });

Route::get('user/register/{step?}', [CustomerController::class, 'create'])->name('register.step');
Route::post('user/register/{step}', [CustomerController::class, 'store'])->name('register.step.post');

Route::get('/student/{username}', [CustomerController::class, 'viewStudent'])->name('student.profile');
//Route::get('customer/dashboard', [DashboardController::class, 'dashboard'])->name('customer.dashboard');

Route::middleware(['auth'])->prefix('customer')->group(function () {

	// dashboard route
	Route::get('/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
	Route::get('/profile/view', [CustomerController::class, 'viewProfile'])->name('customer.profile.view');
	Route::post('/profile/update', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
	Route::get('/mysubject', [CustomerController::class, 'mysubject'])->name('customer.student_subject');
	Route::get('/addsubject', [CustomerController::class, 'addsubject'])->name('customer.student_add_subject');
	Route::get('/personalinfo', [CustomerController::class, 'personalinfo'])->name('customer.personalinfo');



	//Route::get('/edit-info-profile', [CustomerController::class, 'index'])->name('customer.edit-info-profile');
	//Route::get('/dashboard', 'App\Http\Controllers\Customer\CustomerController@index')->name('home');

});

