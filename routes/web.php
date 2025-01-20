<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TutorDetailsController;
use App\Http\Controllers\SubscriptionController;




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

// Clear All:
Route::get('/clear-all', function () {
	
	Artisan::call('route:clear');
	Artisan::call('config:clear');
	Artisan::call('cache:clear');
	Artisan::call('view:clear');
	Artisan::call('config:cache');
	Artisan::call('route:cache');
	return 'All cache cleared';
});

require __DIR__ . '/auth.php';

/** Front-end routes START  */
Route::get('/', [PageController::class, 'index'])->name('landingpage');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

Route::get('/tutors', [PageController::class, 'tutorFilter'])->name('tutors.tutorFilter');
Route::get('/student', [PageController::class, 'student'])->name('student.student');


Route::get('/tutors/{id}', [TutorDetailsController::class, 'show'])->name('tutors.show');

Route::get('/{slug}', [PageController::class, 'display'])->name('display');
Route::post('contact-us', [PageController::class, 'store'])->name('contact-us.store');

Route::get('/tutors/course/{id}', [PageController::class, 'tutorsByCourse'])->name('tutors.byCourse');

Route::get('/tutors/filter/{course_id}', [PageController::class, 'tutorFilter'])->name('tutors.filterByCourse');

Route::get('/subscribe', [SubscriptionController::class, 'showForm'])->name('subscribe.form');
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe.store');

Route::middleware(['auth', 'verified','disablepreventback'])->group(function () {
	/** public user  details page */
		});

/** Amin routes START */
Route::group(['middleware' => 'disablepreventback'], function () {
	Route::group(['namespace' => '', 'prefix' => 'admin', 'as' => 'admin.'], function () {
		require __DIR__ . '/admin_routes.php';
	});
});

/** frontend routes START */
//Route::group(['middleware' => 'disablepreventback'], function () {
	//Route::group(['namespace' => '', 'prefix' => 'customer', 'as' => 'customer.'], function () {
		//});
	//});
require __DIR__ . '/customer_routes.php';