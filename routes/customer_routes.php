<?php

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Tutor\TutorController;
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

Route::middleware(['auth'])->prefix('tutor')->group(function () {
	// dashboard route
	Route::get('/dashboard', [TutorController::class, 'index'])->name('tutor.dashboard');
	Route::get('/profile/view', [TutorController::class, 'viewProfile'])->name('tutor.profile.view');
	Route::get('/verification', [TutorController::class, 'verification'])->name('tutor.verification');
	Route::get('/proofidentity', [TutorController::class, 'proofidentity'])->name('tutor.proofidentity');
	Route::post('/verification/submit', [TutorController::class, 'proofstore'])->name('verification.submit');


	Route::post('/profile/update', [TutorController::class, 'updateProfile'])->name('tutor.profile.update');
	Route::get('/mysubject', [TutorController::class, 'mysubject'])->name('tutor.student_subject');
	Route::get('/addsubject', [TutorController::class, 'addsubject'])->name('tutor.student_add_subject');
	Route::get('/personalinfo', [TutorController::class, 'personalinfo'])->name('tutor.personalinfo');
	Route::get('/password', [TutorController::class, 'studpassword'])->name('tutor.password');
	Route::get('/myclients', [TutorController::class, 'studmyclients'])->name('tutor.myclients');
	Route::get('/privacy', [TutorController::class, 'studprivacy'])->name('tutor.privacy');
	Route::post('/update-personalinfo', [TutorController::class, 'personalinfoupdate'])->name('tutor.personalinfoupdate');
	Route::put('/update-password', [TutorController::class, 'studpasswordupdate'])->name('tutor.studpasswordupdate');
	Route::get('/profile-photo', [TutorController::class, 'showUploadForm'])->name('tutor.photo.upload');
	Route::put('/student/profile-photo', [TutorController::class, 'uploadProfilePhoto'])->name('tutor.photo.upload.submit');
	Route::get('/{id}', [TutorController::class, 'show'])->name('tutor');

});

Route::middleware(['auth'])->prefix('customer')->group(function () {
	// dashboard route
	Route::get('/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
	Route::get('/profile/view', [CustomerController::class, 'viewProfile'])->name('customer.profile.view');
	Route::post('/profile/update', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
	Route::get('/mysubject', [CustomerController::class, 'mysubject'])->name('customer.student_subject');
	Route::get('/addsubject', [CustomerController::class, 'addsubject'])->name('customer.student_add_subject');
	Route::get('/personalinfo', [CustomerController::class, 'personalinfo'])->name('customer.personalinfo');
	Route::get('/password', [CustomerController::class, 'studpassword'])->name('customer.password');
	Route::get('/myclients', [CustomerController::class, 'studmyclients'])->name('customer.myclients');
	Route::get('/privacy', [CustomerController::class, 'studprivacy'])->name('customer.privacy');
	Route::post('/update-personalinfo', [CustomerController::class, 'personalinfoupdate'])->name('customer.personalinfoupdate');
	Route::put('/update-password', [CustomerController::class, 'studpasswordupdate'])->name('customer.studpasswordupdate');
	Route::get('/profile-photo', [CustomerController::class, 'showUploadForm'])->name('customer.photo.upload');
	Route::put('/student/profile-photo', [CustomerController::class, 'uploadProfilePhoto'])->name('customer.photo.upload.submit');
	Route::get('profile/{id}', [CustomerController::class, 'show'])->name('profile');
	
});

