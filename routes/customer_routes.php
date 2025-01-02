<?php

use App\Http\Controllers\Customer\CustomerController;

// Route::get('/', 'App\Http\Controllers\Customer\CustomerController@login')->name('login');
// Route::get('/login', 'App\Http\Controllers\Customer\CustomerController@login')->name('login');
// Route::post('/loginProcess', 'App\Http\Controllers\Customer\CustomerController@loginProcess')->name('loginprocess');	
// Route::get('/forgot-password', 'App\Http\Controllers\Customer\CustomerController@forgotPassword')->name('forgotpassword');
// Route::get('/logout', 'App\Http\Controllers\Customer\CustomerController@logout')->name('logout');


Route::get('user/register/', function () {
	return redirect()->route('register.step');
});

Route::get('register/step/{step}', [MultiStepRegistrationController::class, 'create'])->name('user.register.step');
Route::post('register/step/{step}', [MultiStepRegistrationController::class, 'store'])->name('user.register.step.post');

Route::middleware(['auth'])->prefix('customer')->group(function () {
	// dashboard route
	Route::get('/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
	//Route::get('/dashboard', 'App\Http\Controllers\Customer\CustomerController@index')->name('home');

});

