<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Booking;
use App\Http\Controllers\BookingMailController;
use Illuminate\Support\Facades\Log;

class SendLessonReminderEmails extends Command
{
    protected $signature = 'reminder:lesson-emails';
    protected $description = 'Send reminder emails to tutors and students 24 hours before their lessons.';

    public function handle()
    {
        $now = Carbon::now();

        // Tomorrow's date (Y-m-d format)
        $tomorrow = $now->copy()->addDay()->toDateString(); // e.g. 2025-04-22

        // Fetch all bookings with status 2 whose start_date is tomorrow
        $bookings = Booking::with(['student', 'tutor', 'subject', 'level'])
            ->where('status', 2) // only confirmed
            ->whereDate('start_date', $tomorrow)
            ->get();

        if ($bookings->isEmpty()) {
            Log::channel('booking')->info('No lesson reminders to send at this time.');
            return;
        }

        foreach ($bookings as $booking) {
            try {
                $bookingMail = new BookingMailController();
                // $bookingMail->sendTutorBookingRelatedMail($booking, 'tutor-lesson-reminder');
                $bookingMail->sendStudentBookingRelatedMail($booking, 'STUDENT_BOOKING_REMINDER');

                Log::channel('booking')->info("Sent reminder emails for booking ID: {$booking->id}");
            } catch (\Exception $e) {
                Log::channel('booking')->error("Failed to send reminder for booking ID: {$booking->id}. Error: " . $e->getMessage());
                continue;
            }
        }
    }
}
