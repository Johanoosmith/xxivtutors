<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;

class StudentLessonPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student-lesson-payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Every day charge student payment for the confirmed lesson in last 24 hours.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $paymentObj = new Payment();
		$paymentObj->studentLessonCharge();
    }
}
