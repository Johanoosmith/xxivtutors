<?php

namespace App\Http\Controllers\Tutor;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Booking;
use App\Models\Subject;
use App\Models\SubjectTutor;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\BookingMailController;


class BookingController extends Controller
{
    public function index(Request $request)
    {
		
        $perPage = 10; // Adjust as necessary
		
		$user_id = Auth::user()->id;

		// Create a new query for the Subject model
		$query = Booking::query();

		$booking_on = [
			'upcoming' => 'Upcoming Booking',
			'past'	   => 'Previous Booking',
			'cancel'   => 'Cancel Booking',
		];
		
		$query->where('tutor_id',$user_id)->with(['Tutor','Student','Subject','Level','booking_enquiry']);
							
		
		if (!empty($request->booking_on) && $request->booking_on == 'past') {
			// Past Records 
			$query->where(function ($q) {
				$q->where('start_date', '<', now()->toDateString())
				  ->orWhere(function ($subQ) {
					  $subQ->where('start_date', now()->toDateString())
						   ->where('start_time', '<', now()->format('H:i:s'));
				  });
			})->orderBy('start_date', 'DESC')->orderBy('start_time', 'DESC');
		} else { 
			// Upcoming by default
			$query->where(function ($q) {
				$q->where('start_date', '>', now()->toDateString())
				  ->orWhere(function ($subQ) {
					  $subQ->where('start_date', now()->toDateString())
						   ->where('start_time', '>=', now()->format('H:i:s'));
				  });
			})->orderBy('start_date', 'ASC')->orderBy('start_time', 'ASC');
		}
		
		if (!empty($request->booking_on) && $request->booking_on == 'cancel') {
			$query->where('status',3);
		}else{
			$query->whereIn('status',[1,2]);
		}
							
		
		// Paginate the query results
		$bookings = $query->paginate($perPage);

		$booking_json = $this->getBookingsJson();
		//pr($booking_json);

		return view('tutor.booking.index', compact('bookings','booking_json','booking_on'));
    }

	public function getBookingsJson()
	{
		$now = Carbon::now();
		$startRange = $now->copy()->subMonths(6)->startOfDay();
		$endRange = $now->copy()->addMonths(6)->endOfDay();

		$bookings = Booking::whereBetween('start_date', [$startRange, $endRange])->get();

		$events = [];

		foreach ($bookings as $booking) {
			$startDateTime = Carbon::parse($booking->start_date . ' ' . $booking->start_time);

			$isPast = $startDateTime->lt($now);

			$events[] = [
				'title' => $booking->student->full_name .' @ '.date('H:i', strtotime($booking->start_time)),
				'start' => $startDateTime->toIso8601String(),
				'end' => $startDateTime->toIso8601String(),
				'url'   => $isPast ? '' : route('tutor.booking.edit', $booking),
				'className' => $isPast ? 'bg-secondary text-light' : 'bg-success text-white',
			];
		}
		return $events;
		//return response()->json($events);
	}

    public function create()
    {
		$user_id = Auth::user()->id;
		
		$tutor_subjects = $students = [];
		if(empty(request()->old('lesson_repeat'))){
			//request()->old('lesson_repeat', 1);
		}
		
		
		$students = User::getStudentList('name_email');
		$tutor_subjects = SubjectTutor::getTutorSubjectList($user_id);
		$days = [ 1 => 'Mon', 2 => 'Tue', 3 => 'Wed',
			4 => 'Thus', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun'];
		
		
		return view('tutor.booking.create', compact('tutor_subjects','students','days'));
    }
	
	public function store(Request $request)
	{
		$user_id = Auth::user()->id;

		$request->merge([
			'start_date' => Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d'),
			'start_time' => sprintf('%02d:%02d', $request->start_time_hour, $request->start_time_minute)
		]);
		
		


		$request->validate([
			'student_id'        => 'required|integer',
			'subject_tutor_id'  => 'required|integer',
			'teaching_location' => 'required|integer',
			'lesson_repeat'     => 'required|in:1,2,3',
			'hourly_rate'       => 'required|numeric',
			'start_date'        => ['required', 'date', 'after_or_equal:' . now()->toDateString()],
			'start_time_hour' => 'required|min:00|max:23',
			'start_time_minute' => 'required|in:00,15,30,45',
			'start_time'        => [
				'required',
				'date_format:H:i',
				function ($attribute, $value, $fail) use ($request) {
					$currentDate = Carbon::today()->toDateString();
					$selectedDate = $request->start_date;

					if ($selectedDate === $currentDate) {
						$currentTime = now()->format('H:i');
						if ($value < $currentTime) {
							$fail('The start time must be greater than the current time.');
						}
					}
				},
			],
			'day'       => 'required|array', // Ensure `day` is an array
			'day.*'     => 'required|integer|in:1,2,3,4,5,6,7',
			'duration'  => 'required|integer'
		]);

		$startDate = Carbon::parse($request->start_date);
		$startTime = $request->start_time;
		$lessonRepeat = $request->lesson_repeat;
		$days = $request->day; // Array of days
		$records = [];
		
		$subject_tutor = SubjectTutor::where('id', $request->subject_tutor_id)->first();
		
		$request->merge([
			'subject_id'	=> $subject_tutor->subject_id,
			'level_id' 		=> $subject_tutor->level_id,
			'student_rate'	=> getStudentPrice($subject_tutor->hourly_rate),
		]);


		// Condition 1: One-time booking on multiple days
		if ($lessonRepeat == 1) {
			foreach ($days as $day) {
				$bookingDate = $this->getNextDateByDay($startDate, $day);
				$records[] = $this->createBookingRecord($request, $user_id, $bookingDate, $startTime, $day);
			}
		}

		// Condition 2: Weekly lessons for 10 weeks
		if ($lessonRepeat == 2) {
			for ($i = 0; $i < 5; $i++) {
				foreach ($days as $day) {
					$bookingDate = $this->getNextDateByDay($startDate->copy()->addWeeks($i), $day);
					$records[] = $this->createBookingRecord($request, $user_id, $bookingDate, $startTime, $day);
				}
			}
		}

		// Condition 3: Fortnightly lessons (every 2 weeks for 5 sessions)
		if ($lessonRepeat == 3) {
			for ($i = 0; $i < 5; $i++) { // 5 sessions
				foreach ($days as $day) {
					$bookingDate = $this->getNextDateByDay($startDate->copy()->addWeeks($i * 2), $day);
					$records[] = $this->createBookingRecord($request, $user_id, $bookingDate, $startTime, $day);
				}
			}
		}

		//dd($records);
		// Insert all records at once
		//Booking::insert($records);
		
		//$this->__createEnquiry($request);


		// **Insert all bookings & retrieve inserted booking IDs**
		$bookingIds = [];
		$firstBooking=null;
		foreach ($records as $index => $record) {
			$booking = Booking::create($record);
			$bookingIds[] = $booking->id;
			if($index === 0){
				$firstBooking=$booking;
			}
		}
		
		
		// **Create a new enquiry & get its ID**
		$enquiry = $this->__createEnquiry($request);
	
		// **Insert into booking_enquiries table**
		if ($enquiry) {
			$enquiryId = $enquiry->id;
			$bookingEnquiryRecords = [];
			
			foreach ($bookingIds as $bookingId) {
				$bookingEnquiryRecords[] = [
					'booking_id'  => $bookingId,
					'enquiry_id'  => $enquiryId,
				];
			}
	
			// Bulk insert into booking_enquiries table
			\App\Models\BookingEnquiry::insert($bookingEnquiryRecords);
		}



		/* Contract & BookingContract Entries */
		$last_record = end($records);
		$contract_end_date = $last_record['start_date'];

		$contract = $this->__createContract($request, $contract_end_date);

		// **Insert into booking_enquiries table**
		if ($contract) {
			$contractId = $contract->id;
			$bookingContractRecords = [];
			
			foreach ($bookingIds as $bookingId) {
				$bookingContractRecords[] = [
					'booking_id'  => $bookingId,
					'contract_id'  => $contractId,
				];
			}
	
			// Bulk insert into booking_contracts table
			\App\Models\BookingContract::insert($bookingContractRecords);
		}

		if($firstBooking){
		$mailController = new BookingMailController();
		$mailController->sendStudentBookingRelatedMail($firstBooking, 'STUDENT_BOOKING_INITIATED');
		}



		return redirect()->route('tutor.booking.index')->with('success', 'Bookings created successfully.');
	}
	
	private function __createEnquiry($request){
		$user_id = Auth::user()->id;
		
		$enquiry = [
			'sender_id'			=> $user_id,
			'receiver_id'		=> $request->student_id,
			'subject_tutor_id'	=> $request->subject_tutor_id,
			'status'		=> 1,
			'content'		=> 'Tutor create booking enquiries.',
			'is_read'		=> 0,
		];
		
		return \App\Models\Enquiry::create($enquiry);
	}

	private function __createContract($request, $contract_end_date){
		$user_id = Auth::user()->id;
		
		$contract = [
			'tutor_id'	=> $user_id,
			'student_id'=> $request->student_id,
			'start_date'=> $request->start_date,
			'end_date'	=> $contract_end_date,
		];
		
		return \App\Models\Contract::create($contract);
	}

	/**
	 * Get the next occurrence of a specific weekday from a given date.
	 */
	private function getNextDateByDay(Carbon $date, $targetDay)
	{
		while ($date->dayOfWeekIso != $targetDay) {
			$date->addDay();
		}
		return $date;
	}

	/**
	 * Helper function to create a booking record.
	 */
	private function createBookingRecord($request, $user_id, $date, $time, $day)
	{
		return [
			'tutor_id'         => $user_id,
			'student_id'       => $request->student_id,
			'subject_tutor_id' => $request->subject_tutor_id,
			'subject_id' 	   => $request->subject_id,
			'level_id' 		   => $request->level_id,
			'teaching_location'=> $request->teaching_location,
			'lesson_repeat'    => $request->lesson_repeat,
			'hourly_rate'      => $request->hourly_rate,
			'student_rate'      => $request->student_rate,
			'start_date'       => $date->toDateString(),
			'start_time'       => $time,
			'day'              => $day,
			'duration'         => $request->duration,
			'created_at'       => now(),
			'updated_at'       => now(),
		];
	}
	
	

    
	/*
    public function store(Request $request)
    {
		$user_id = Auth::user()->id;
        
		$request->validate([
			'student_id'  		=> 'required|integer',
			'subject_tutor_id' 	=> 'required|integer',
			'teaching_location' => 'required|integer',
			'lesson_repeat' 	=> 'required|in:1,2,3',
			'hourly_rate' 		=> 'required|numeric',
			'start_date' 		=> ['required', 'date', 'after_or_equal:' . now()->toDateString()],
			'start_time' => [
				'required',
				'date_format:H:i',
				function ($attribute, $value, $fail) use ($request) {
					$currentDate = Carbon::today()->toDateString();
					$selectedDate = $request->start_date;

					if ($selectedDate === $currentDate) {
						$currentTime = now()->format('H:i');
						if ($value < $currentTime) {
							$fail('The start time must be greater than the current time.');
						}
					}
				},
			],
			'day' => 'required|numeric|in:1,2,3,4,5,6,7',
			'duration'=>'required|integer'
		]);
		
		$records = $request->all();
		$records['tutor_id'] = $user_id;
		
		dd($records);		
		Booking::create($records);
		
		return redirect()->route('tutor.booking.index')->with('success', 'Booking created successfully.');
    }
	*/
	
    public function edit(Booking $booking)
    {
		$request = request();
		
		list($startHour, $startMinute) = explode(':', $booking->start_time);
		$booking->start_date = date('d/m/Y', strtotime($booking->start_date));
		
		
		if(!empty(request()->old('start_time'))){
			list($startHour, $startMinute) = explode(':', request()->old('start_time'));
		}
		
		if(!empty(request()->old('start_date'))){
			$booking->start_date = date('d/m/Y', strtotime(request()->old('start_date')));
		}
		
		return view('tutor.booking.edit', compact('booking', 'startHour', 'startMinute'));
    }

    public function update(Request $request, Booking $booking)
    {
		
		$request->merge([
			'start_date' => Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d'),
			'start_time' => Carbon::parse($request->start_time)->format('H:i')
		]);
		
        $request->validate([
			'teaching_location' => 'required|integer',
			'hourly_rate'       => 'required|numeric',
			'start_date'        => ['required', 'date', 'after_or_equal:' . now()->toDateString()],
			'start_time_hour' => 'required|min:00|max:23',
			'start_time_minute' => 'required|in:00,15,30,45',
			'start_time'        => [
				'required',
				'date_format:H:i',
				function ($attribute, $value, $fail) use ($request) {
					$currentDate = Carbon::today()->toDateString();
					$selectedDate = $request->start_date;

					if ($selectedDate === $currentDate) {
						$currentTime = now()->format('H:i');
						if ($value < $currentTime) {
							$fail('The start time must be greater than the current time.');
						}
					}
				},
			],
			'duration'  => 'required|integer'
		]);
		
		$user_id = Auth::user()->id;
		
		$booking = Booking::where('tutor_id',$user_id)->findOrFail($booking->id);
		
		$booking->hourly_rate 		= $request->hourly_rate;
		$booking->student_rate 		= getStudentPrice($request->hourly_rate);
		$booking->teaching_location = $request->teaching_location;
		$booking->start_date		= Carbon::parse($request->start_date);
		$booking->start_time		= $request->start_time;
		$booking->duration			= $request->duration;
		$booking->save();
		$mailController = new BookingMailController();
		$mailController->sendStudentBookingRelatedMail($booking, 'STUDENT_BOOKING_DETAIL_CHANGED');
		
        return redirect()->route('tutor.booking.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Request $request)
    {
	}
	
	public function cancel(Request $request)
    {
		
		$user_id = Auth::user()->id;
		$booking = Booking::where('tutor_id',$user_id)->findOrFail($request->booking_id);
		
		$booking->status = 3;
		$booking->cancel_by = 'Lesson cancel by tutor.';
		$booking->save();
		$mailController = new BookingMailController();
		$mailController->sendStudentBookingRelatedMail($booking, 'STUDENT_BOOKING_CANCELLED');
        return redirect()->route('tutor.booking.index')->with('success', 'Booking cancelled successfully.');
    }
	
	public function help()
    {
		$page_id = config('constants.SITE.TUTOR_PAYMENT_HELP_PAGE_ID');
		$page = \App\Models\Page::getPage($page_id);
		return view('tutor.booking.help', compact('page'));
    }
	
	public function payment_history(Request $request)
    {
		$payment_history = '';
		
		$perPage = 10;
		
		$auth_user_id = Auth::user()->id;
		
		$query = Payment::query();
		
		$query->where('tutor_id',$auth_user_id)
				->with(['booking','student'])
				->orderBy('created_at','DESC');
							
		// Paginate the query results
		$payments = $query->paginate($perPage);
		
		return view('tutor.booking.payment_history', compact('payments'));
    }
	
	public function online_lesson(Request $request)
    {
		$user_id = Auth::user()->id;
		$tutor = \App\Models\Tutor::where('user_id',$user_id)->first();
		if($request->isMethod('post')){
			$tutor->teaching_experience = $request->teaching_experience;
			$tutor->learning_online		= $request->learning_online;
			$tutor->additional_comments = $request->additional_comments;
			$tutor->save();
		}
		
		return view('tutor.booking.online_lesson', compact('tutor'));
    }
	
	/*
	public function getSubjectByCourse($course_id, $selected_id=NULL)
    {
        $subjectObj = new Subject();
		$subjects = $subjectObj->getSubjectByCourse($course_id);
        return view('tutor.booking.get_subject_by_course',compact('subjects','selected_id'));
    }
	*/

	/* You will get level and rate fields */
	/*
	public function getFieldsByCourse($course_id, $selected_id=NULL)
    {
		$request = request();
		if($request->ajax()){
			$course	= Course::where('status',1)->where('id',$course_id)->first();
			$course_levels = [];
			$levels = [];
			if(!empty($course)){
				$course_levels  = Course::getCouseLevelList($course_id, 'id');
				if(!empty($course_levels)){
					$levels = \App\Models\Level::getLevelList($course_levels);
				}
			}
		
			return view('tutor.booking.get_fields_by_course',compact('levels','course','selected_id'));
		}
    }
	*/
    
}

