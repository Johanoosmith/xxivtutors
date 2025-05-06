<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Booking;
use App\Http\Controllers\BookingMailController;
use Illuminate\Support\Facades\Log;


class AutoCancelBookings extends Command
{
    protected $signature = 'bookings:auto-cancel';

    protected $description = 'Cancel unconfirmed bookings 12 hours before start time';

    public function handle()
    {
        $now = Carbon::now();

        // Find bookings with pending status that passed 12 hour window
        $bookings = Booking::where('status', 1) // pending
        ->whereRaw("TIMESTAMP(CONCAT(start_date, ' ', start_time)) <= ?", [$now->copy()->addHours(12)])
        ->get();

        foreach ($bookings as $booking) {
            $booking->status = 3; // canceled
            $booking->cancel_by="Lesson not confirmed by student so lesson has cancelled by the system.";
            $booking->save();
            $bookingMail = new BookingMailController();

            // $bookingMail->sendStudentBookingRelatedMail($booking, 'STUDENT_AUTO_BOOKING_CANCELLATION');
            // $bookingMail->sendTutorBookingRelatedMail($booking, 'TUTOR_AUTO_BOOKING_CANCELLATION');
            // Optional: Send email notifications here
            \Log::info("Canceled booking ID: {$booking->id}");
        }

        return 0;
    }
}
