<?php
/* Tutor */
use App\Http\Controllers\Tutor\TutorController;
use App\Http\Controllers\Tutor\SubjectController;
use App\Http\Controllers\Tutor\BookingController;
use App\Http\Controllers\Tutor\TagController;


/* Student */
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\PostQuestion;
use App\Http\Controllers\Customer\SuggestedTutor;
use App\Http\Controllers\Customer\FeedbackController;
use App\Http\Controllers\Customer\EnquiryController;
use App\Http\Controllers\Customer\SubjectStudentController;
use App\Http\Controllers\Customer\BookingController as BookingStudentController;
use App\Http\Controllers\Customer\TagController as TagStudentController;


#use App\Models\Enquiry;

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

	Route::middleware('tutor')->group(function () {

		// dashboard route
		Route::get('/dashboard', [TutorController::class, 'index'])->name('tutor.dashboard');
		Route::get('/profile/view/', [TutorController::class, 'viewProfile'])->name('tutor.profile.view');
		Route::get('/verification', [TutorController::class, 'verification'])->name('tutor.verification');
		Route::get('/proofidentity', [TutorController::class, 'proofidentity'])->name('tutor.proofidentity');
		Route::post('/verification/submit', [TutorController::class, 'proofstore'])->name('verification.submit');
		Route::get('/proofdbs', [TutorController::class, 'proofdbs'])->name('tutor.proofdbs');
		Route::post('/proofdbs/submit', [TutorController::class, 'proofdbssubmit'])->name('proofdbs.submit');
		Route::get('/add/refernce', [TutorController::class, 'addrefernce'])->name('tutor.addrefernce');
		Route::post('/refernce/submit', [TutorController::class, 'submitreference'])->name('tutor.submitreference');
		Route::post('/resend-email/{id}', [TutorController::class, 'resendEmail'])->name('tutor.resend.email');


		Route::post('/profile/update', [TutorController::class, 'updateProfile'])->name('tutor.profile.update');
		Route::get('/qualification', [TutorController::class, 'profilequalification'])->name('tutor.qualification');
		Route::get('/add/qualification', [TutorController::class, 'newqualification'])->name('tutor.add.qualification');
		Route::post('/qualifications/store', [TutorController::class, 'newqualificationstore'])->name('tutor.qualifications.store');
		Route::get('/qualification/edit/{id}', [TutorController::class, 'edit'])->name('tutor.qualification.edit');
		Route::put('/qualification/update/{id}', [TutorController::class, 'update'])->name('qualification.update');
		Route::delete('/qualification/delete/{id}', [TutorController::class, 'qualificationdestroy'])->name('tutor.qualification.delete');
		Route::put('/profile/update/{id}', [TutorController::class, 'updateTutorprofile'])->name('tutor.profile.view.update');
		Route::get('/myavailability', [TutorController::class, 'myavailability'])->name('tutor.myavailability');
		Route::put('/availability/update', [TutorController::class, 'updateAvailability'])->name('tutor.availability.updateAvailability');
		
		Route::get('/enquiries', [TutorController::class, 'enquiries'])->name('tutor.enquiries.enquiries');
		Route::post('/enquiries/send-message',  [TutorController::class, 'sendEnquiryMessage'])->name('tutor.enquiries.sendMessage');
		Route::post('/enquiries/close/{id}', [TutorController::class, 'enquiryClose'])->name('tutor.enquiries.close');
		Route::match(['get','post'], '/enquiries/report/{id}', [TutorController::class, 'enquiryReport'])->name('tutor.enquiries.report');
		Route::get('/enquiries/{id}/{booking_id?}', [TutorController::class, 'showEnquire'])->name('tutor.enquiries.chat');
		
		#Route::get('/tags', [TutorController::class, 'tags'])->name('tutor.tags.index');
		Route::get('/history', [TutorController::class, 'history'])->name('tutor.history');
		
		Route::get('/articles', [TutorController::class, 'articles'])->name('tutor.articles.index');
		Route::get('/add/articles', [TutorController::class, 'addqarticles'])->name('tutor.articles.addqarticles');
		Route::post('/articles/store', [TutorController::class, 'articlesstore'])->name('tutor.articles.articlesstore');
		Route::get('/articles/edit/{id}', [TutorController::class, 'articlesedit'])->name('tutor.articles.edit');
		Route::post('/articles/update/{id}', [TutorController::class, 'articlesupdate'])->name('tutor.articles.update');
		Route::delete('/articles/{id}', [TutorController::class, 'articlesdestroy'])->name('tutor.articles.destroy');
		
		Route::get('/headlines', [TutorController::class, 'headlines'])->name('tutor.headlines');
		Route::get('/headlines/update', [TutorController::class, 'headlinesupdate'])->name('tutor.headlines.update');
		Route::get('/foundme', [TutorController::class, 'foundme'])->name('tutor.foundme');
		/*
			Route::get('/subjects', [SubjectController::class, 'index'])->name('tutor.subjects.index');
			Route::get('/subjects/create', [SubjectController::class, 'create'])->name('tutor.subjects.create');
			Route::post('/subjects/store', [SubjectController::class, 'store'])->name('tutor.subjects.store');
			Route::get('/subjects/edit', [SubjectController::class, 'edit'])->name('tutor.subjects.edit');
			Route::post('/subjects/update/{id}', [SubjectController::class, 'update'])->name('tutor.subjects.update');
			Route::delete('/subjects/destroy/{id}', [SubjectController::class, 'destroy'])->name('tutor.subjects.destroy');
		*/
		Route::name('tutor.')->group(function () {
			//Route::resource('subjects', SubjectController::class);
			
			/* Subject */
			Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
			Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
			Route::post('/subjects/store', [SubjectController::class, 'store'])->name('subjects.store');
			Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
			Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
			Route::post('/subjects/destroy', [SubjectController::class, 'destroy'])->name('subjects.destroy');
			//Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
			Route::get('/subjects/get_subject_by_course/{course_id?}', [SubjectController::class, 'getSubjectByCourse'])->name('subjects.get_subject_by_course');
			Route::get('/subjects/get_fields_by_course/{course_id?}', [SubjectController::class, 'getFieldsByCourse'])->name('subjects.get_fields_by_course');
			
			/* Booking */
			Route::get('/booking/help', [BookingController::class, 'help'])->name('booking.help');
			Route::get('/booking/payment_history', [BookingController::class, 'payment_history'])->name('booking.payment_history');
			Route::post('/booking/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
			Route::match(['get','post'], '/booking/online_lesson', [BookingController::class, 'online_lesson'])->name('booking.online_lesson');
			
			Route::resource('booking', BookingController::class);

			/* Tags */
			Route::get('/tags', [TagController::class, 'index'])->name('tag.index');
			Route::post('/tags/delete/{user_id}', [TagController::class, 'delete'])->name('tag.delete');
		});
		
		Route::get('/addsubject', [TutorController::class, 'addsubject'])->name('tutor.student_add_subject');
		Route::get('/personalinfo', [TutorController::class, 'personalinfo'])->name('tutor.personalinfo');
		Route::get('/password', [TutorController::class, 'studpassword'])->name('tutor.password');
		Route::get('/myclients', [TutorController::class, 'tutordmyclients'])->name('tutor.myclients');
		Route::get('/turorcontract', [TutorController::class, 'turorcontract'])->name('tutor.contract');
		Route::get('/privacy', [TutorController::class, 'tutorprivacy'])->name('tutor.privacy');
		Route::post('/update-personalinfo', [TutorController::class, 'personalinfoupdate'])->name('tutor.personalinfoupdate');
		Route::put('/update-password', [TutorController::class, 'studpasswordupdate'])->name('tutor.studpasswordupdate');
		Route::get('/profile-photo', [TutorController::class, 'showUploadForm'])->name('tutor.photo.upload');
		Route::put('/student/profile-photo', [TutorController::class, 'uploadProfilePhoto'])->name('tutor.photo.upload.submit');
	});

	/* Function with tutor middleware */
	Route::get('/tags/create/{user_id}', [TagController::class, 'create'])->name('tutor.tag.create');
});

/* Tutor Without Auth */
Route::get('/tutor/{id}', [TutorController::class, 'show'])->where('id', '[0-9]+')->name('tutor');


Route::middleware(['auth'])->prefix('customer')->group(function () {

	Route::middleware('student')->group(function () {
		// dashboard route
		Route::get('/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
		Route::get('/profile/view', [CustomerController::class, 'viewProfile'])->name('customer.profile.view');
		Route::post('/profile/update', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
		Route::get('/mysubject', [CustomerController::class, 'mysubject'])->name('customer.student_subject');
		Route::get('/addsubject', [CustomerController::class, 'addsubject'])->name('customer.student_add_subject');
		Route::get('/personalinfo', [CustomerController::class, 'personalinfo'])->name('customer.personalinfo');
		Route::get('/noaccess', [CustomerController::class, 'noaccess'])->name('customer.noaccess');
		Route::get('/password', [CustomerController::class, 'studpassword'])->name('customer.password');
		Route::get('/myclients', [CustomerController::class, 'studmyclients'])->name('customer.myclients');
		Route::get('/privacy', [CustomerController::class, 'studprivacy'])->name('customer.privacy');
		Route::post('/update-personalinfo', [CustomerController::class, 'personalinfoupdate'])->name('customer.personalinfoupdate');
		Route::put('/update-password', [CustomerController::class, 'studpasswordupdate'])->name('customer.studpasswordupdate');
		Route::get('/profile-photo', [CustomerController::class, 'showUploadForm'])->name('customer.photo.upload');
		Route::put('/student/profile-photo', [CustomerController::class, 'uploadProfilePhoto'])->name('customer.photo.upload.submit');
		
		#Route::get('/tags', [CustomerController::class, 'tags'])->name('student.tags');
		
		Route::get('/history', [CustomerController::class, 'history'])->name('student.history');
		Route::get('/myquestion', [PostQuestion::class, 'index'])->name('student.myquestion');
		Route::get('/add/myquestion', [PostQuestion::class, 'create'])->name('student.questions.addmyquestion');
		Route::post('/questions', [PostQuestion::class, 'store'])->name('student.questions.store');
		Route::delete('/questions/{id}', [PostQuestion::class, 'destroy'])->name('student.questions.destroy');
		Route::get('/suggested-tutor', [SuggestedTutor::class, 'index'])->name('student.suggested');
		Route::get('/feedbacklist', [FeedbackController::class, 'feedbackList'])->name('student.feedback');
		Route::get('/create/{tutor_id}', [FeedbackController::class, 'create'])->name('student.feedback.create');
		Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('student.feedback.store');
		
		Route::get('/enquiries', [EnquiryController::class, 'enquiries'])->name('student.enquiries.enquiries');
		Route::post('/enquiries/send-message', [EnquiryController::class, 'sendEnquiryMessage'])->name('student.enquiries.sendMessage');
		Route::post('/enquiries/close/{id}', [EnquiryController::class, 'enquiryClose'])->name('student.enquiries.close');
		Route::match(['get','post'], '/enquiries/report/{id}', [EnquiryController::class, 'enquiryReport'])->name('student.enquiries.report');
		Route::get('/enquiries/{id}/{booking_id?}', [EnquiryController::class, 'showEnquire'])->name('student.enquiries.chat');

		Route::name('customer.')->group(function () {
			//Route::resource('subjects', SubjectController::class);
			
			/* Subjects */
			Route::get('/subjects', [SubjectStudentController::class, 'index'])->name('subjects.index');
			Route::get('/subjects/create', [SubjectStudentController::class, 'create'])->name('subjects.create');
			Route::post('/subjects/store', [SubjectStudentController::class, 'store'])->name('subjects.store');
			Route::get('/subjects/{subject}/edit', [SubjectStudentController::class, 'edit'])->name('subjects.edit');
			Route::put('/subjects/{subject}', [SubjectStudentController::class, 'update'])->name('subjects.update');
			Route::post('/subjects/destroy', [SubjectStudentController::class, 'destroy'])->name('subjects.destroy');
			
			Route::get('/subjects/get_subject_by_course/{course_id?}', [SubjectStudentController::class, 'getSubjectByCourse'])->name('subjects.get_subject_by_course');
			Route::get('/subjects/get_fields_by_course/{course_id?}', [SubjectStudentController::class, 'getFieldsByCourse'])->name('subjects.get_fields_by_course');
			
			
			/* Booking */
			Route::get('/booking/payment_history', [BookingStudentController::class, 'payment_history'])->name('booking.payment_history');
			Route::match(['get','post'],'/booking/payment_details', [BookingStudentController::class, 'payment_details'])->name('booking.payment_details');
			Route::post('/booking/cancel', [BookingStudentController::class, 'cancel'])->name('booking.cancel');
			Route::get('/booking/confirmed/{id}', [BookingStudentController::class, 'confirmed'])->name('booking.confirmed');
			Route::match(['get','post'], '/booking/online_lesson', [BookingStudentController::class, 'online_lesson'])->name('booking.online_lesson');
			Route::get('/booking', [BookingStudentController::class, 'index'])->name('booking.index');
			Route::get('/booking/view/{booking}', [BookingStudentController::class, 'view'])->name('booking.view');
			
			
			/* Payment */
			Route::get('/booking/stripe_account_create', [BookingStudentController::class, 'stripe_account_create'])->name('booking.stripe_account_create');

			/* Tags */
			Route::get('/tags', [TagStudentController::class, 'index'])->name('tag.index');
			Route::post('/tags/delete/{user_id}', [TagStudentController::class, 'delete'])->name('tag.delete');
		});

	});

	/* Functions without student middleware */
	Route::get('/tags/create/{user_id}', [TagStudentController::class, 'create'])->name('customer.tag.create');
	
});

/* Customer Without Auth */
Route::get('profile/{id}', [CustomerController::class, 'show'])->prefix('customer')->where('id', '[0-9]+')->name('profile');


Route::match(['get','post'],'/stripe/refresh_url', [BookingStudentController::class, 'stripe_refresh_url'])->name('stripe.refresh_url');
Route::match(['get','post'],'/stripe/return_url', [BookingStudentController::class, 'stripe_return_url'])->name('stripe.return_url');

