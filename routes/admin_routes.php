<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Admin\ManageContractController;
use Illuminate\Support\Facades\Route;


use Mockery\VerificationDirector;

Route::get('/', 'App\Http\Controllers\Admin\AdminController@login')->name('adlogin');
#Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@login')->name('login');
Route::get('/login', 'App\Http\Controllers\Admin\AdminController@login')->name('login');
Route::post('/loginProcess', 'App\Http\Controllers\Admin\AdminController@loginProcess')->name('loginprocess');
Route::get('/forgot-password', 'App\Http\Controllers\Admin\AdminController@forgotPassword')->name('forgotpassword');
Route::get('/logout', 'App\Http\Controllers\Admin\AdminController@logout')->name('logout');

Route::group(['middleware' => ['admin']], function () {

	// dashboard route
	Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');

	// Change password
	Route::get('/change-password', 'App\Http\Controllers\Admin\DashboardController@changePassword')->name('changepassword');
	Route::post('/updatepassword', 'App\Http\Controllers\Admin\DashboardController@UpdatePassword')->name('updatepassword');

	// My profile routes
	Route::get('/profile', 'App\Http\Controllers\Admin\DashboardController@profile')->name('profile');
	Route::post('/submit-profile', 'App\Http\Controllers\Admin\DashboardController@submit_profile')->name('submit_profile');

	// admin settings routes
	Route::post('/settings/update', 'App\Http\Controllers\Admin\SettingController@update_option')->name('settings.updates');
	Route::get('/settings/{slug}', 'App\Http\Controllers\Admin\SettingController@index')->name('settings.tab');
	Route::any('/email-settings', 'App\Http\Controllers\Admin\SettingController@emailSetting')->name('emailsetting.index');
	Route::any('delete-settings-image/{imagename}', 'App\Http\Controllers\Admin\SettingController@destroySettingsImage')->name('delete-settings-image');

	//emaillogs
	Route::resource('emaillogs', 'App\Http\Controllers\Admin\EmaillogController');
	Route::any('delete-emaillog/{id}', 'App\Http\Controllers\Admin\EmaillogController@destroy')->name('delete-emaillog');

	//user panel route
	Route::resource('users', 'App\Http\Controllers\Admin\UserController');
	Route::any('delete-user/{id}', 'App\Http\Controllers\Admin\UserController@destroy')->name('delete-user');


	/** Manage email templates */
	Route::resource('emailtemplates', 'App\Http\Controllers\Admin\EmailtemplateController');

	/** Manage header */
	Route::resource('header', 'App\Http\Controllers\Admin\SettingsController');
	Route::put('/header', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');

	/** Manage footer */
	Route::resource('footer', 'App\Http\Controllers\Admin\FooterController');

	//Route::resource('footer', 'App\Http\Controllers\Admin\FooterController@index')->name('admin.footer.index');
	Route::any('footer', 'App\Http\Controllers\Admin\FooterController@index')->name('admin.footer.store');

	/* Media routes*/
	Route::resource('media', 'App\Http\Controllers\Admin\MediaController');
	Route::any('delete-media-image/{id}', 'App\Http\Controllers\Admin\MediaController@destroyImage')->name('delete-media-image');
	Route::any('media/upload',  'App\Http\Controllers\Admin\MediaController@Upload2')->name('upload');

	//pages route
	Route::resource('pages', 'App\Http\Controllers\Admin\PageController');
	Route::any('/get-page-form', 'App\Http\Controllers\Admin\PageController@getForm')->name('pages.getform');
	Route::any('delete-page/{id}', 'App\Http\Controllers\Admin\PageController@destroy')->name('delete-page');
	Route::any('delete-page-image/{id}', 'App\Http\Controllers\Admin\PageController@destroyPageImage')->name('delete-page-image');
	Route::any('delete-pagemeta-image/{id}/{imagename}', 'App\Http\Controllers\Admin\PageController@destroyImage')->name('delete-pagemeta-image');

	//users student
	Route::resource('student', 'App\Http\Controllers\Admin\ManageUserController');
	#Route::post('/student/store', 'App\Http\Controllers\Admin\ManageUserController@store')->name('student.store');
	Route::any('delete-student/{id}', 'App\Http\Controllers\Admin\ManageUserController@destroy')->name('delete-student');

	//users tutors
	Route::resource('tutors', 'App\Http\Controllers\Admin\TutorsController');
	Route::any('delete-tutors/{id}', 'App\Http\Controllers\Admin\TutorsController@destroy')->name('delete-tutors');

	//users category
	Route::resource('category', 'App\Http\Controllers\Admin\CategoryController');
	Route::resource('categories', 'App\Http\Controllers\Admin\CategoryController');
	Route::any('delete-cate/{id}', 'App\Http\Controllers\Admin\CategoryController@destroy')->name('delete-cat');

	//manage course
	Route::resource('course', 'App\Http\Controllers\Admin\CourseController');
	Route::resource('courses', 'App\Http\Controllers\Admin\CourseController');
	Route::any('delete-course/{id}', 'App\Http\Controllers\Admin\CourseController@destroy')->name('delete-course');


	//manage subjects
	Route::resource('subjects', SubjectController::class);

	//manage levels
	Route::resource('levels', LevelController::class);

	//manage city course
	Route::resource('cities', 'App\Http\Controllers\Admin\CityController');

	//Manage Contact us
	Route::resource('contact-us', 'App\Http\Controllers\Admin\ContactUsController');
	Route::any('contact-us/{id}', 'App\Http\Controllers\Admin\ContactUsController@destroy')->name('admin.contact-us.destroy');

	//Manage Subscriber
	Route::resource('subscriber', 'App\Http\Controllers\Admin\SubscriberController');
	Route::any('subscriber-destroy/{id}', 'App\Http\Controllers\Admin\SubscriberController@destroy')->name('subscriber-destroy');
	//article 
	Route::prefix('article')->name('article.')->group(function () {
		Route::resource('/', \App\Http\Controllers\Admin\ArticleController::class)->parameters(['' => 'article']);
		Route::post('approve', [\App\Http\Controllers\Admin\ArticleController::class, 'approve'])->name('approve');
		Route::post('reject', [\App\Http\Controllers\Admin\ArticleController::class, 'reject'])->name('reject');
	});
	//verification
	Route::resource('verification', VerificationController::class);
	Route::post('/admin/verification/{id}/approve', [VerificationController::class, 'approve'])->name('verification.approve');
	Route::post('/admin/verification/{id}/reject', [VerificationController::class, 'reject'])->name('verification.reject');

	//booking
	Route::resource('booking', BookingController::class);

	//notificationtemplates
	Route::resource('notification-templates', NotificationController::class);
	Route::any('delete-notification/{id}', 'App\Http\Controllers\Admin\NotificationController@destroy')->name('delete-notification');


	//feedback
	Route::resource('feedback', FeedbackController::class);
	Route::post('/feedback/approve', [FeedbackController::class, 'approve'])->name('feedback.approve');
	Route::post('/feedback/reject', [FeedbackController::class, 'reject'])->name('feedback.reject');

	//question
	Route::get('questions', [QuestionController::class, 'index'])->name('questions.index');
	Route::post('/questions/accept', [QuestionController::class, 'accept'])->name('questions.accept');
	Route::post('/questions/reject', [QuestionController::class, 'reject'])->name('questions.reject');

	Route::get('/contract', [ManageContractController::class, 'index'])->name('contract.index');
	Route::post('/contractStore', [ManageContractController::class, 'store'])->name('contract.store');
});
