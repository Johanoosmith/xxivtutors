<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingMailController extends Controller
{
    public function sendTutorBookingRelatedMail(Booking $booking, string $templateSlug)
    {
        $subjectName = $booking->subject ? $booking->subject->title : 'N/A';
        $levelName = $booking->level ? $booking->level->title : 'N/A';
        $studentName = $booking->student ? $booking->student->firstname . ' ' . $booking->student->lastname : 'N/A';
        $tutorName = $booking->tutor ? $booking->tutor->firstname . ' ' . $booking->tutor->lastname : 'N/A';
        $bookingDateTime = $booking->start_date . ' ' . $booking->start_time;
        $duration = $booking->duration;
        $coursePrice = $booking->hourly_rate;

        $referenceArray = [
            'tutor_name' => $tutorName,
            'student_name' => $studentName,
            'booking_date_time' => $bookingDateTime,
            'duration' => $duration,
            'subject' => $subjectName,
            'level' => $levelName,
            'price' => $coursePrice,
        ];

        if ($booking->tutor && $booking->tutor->email) {
            sendMail($booking->tutor->email, $referenceArray, $templateSlug);
        }

       
    }

    public function sendStudentBookingRelatedMail(Booking $booking, string $templateSlug)
    {
        $subjectName = $booking->subject ? $booking->subject->title : 'N/A';
        $levelName = $booking->level ? $booking->level->title : 'N/A';
        $studentName = $booking->student ? $booking->student->firstname . ' ' . $booking->student->lastname : 'N/A';
        $tutorName = $booking->tutor ? $booking->tutor->firstname . ' ' . $booking->tutor->lastname : 'N/A';
        $bookingDateTime = $booking->start_date . ' ' . $booking->start_time;
        $duration = $booking->duration;
        $coursePrice = $booking->student_rate;


        $referenceArray = [
            'tutor_name' => $tutorName,
            'student_name' => $studentName,
            'booking_date_time' => $bookingDateTime,
            'duration' => $duration,
            'subject' => $subjectName,
            'level' => $levelName,
            'price' => $coursePrice,
        ];

        if ($booking->student && $booking->student->email) {
            sendMail($booking->student->email, $referenceArray, $templateSlug);
        }

       
    }
}
