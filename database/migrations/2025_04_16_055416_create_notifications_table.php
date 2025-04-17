<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->boolean('display_postcode')->default(1);
            $table->boolean('display_qualification')->default(1);
            $table->boolean('new_enquiry_email')->default(1);
            $table->boolean('email_on_profile_view')->default(1);
            $table->boolean('feedback_email')->default(1);
            $table->boolean('payment_email')->default(1);
            $table->boolean('lesson_reminder_email')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('notifications');
    }
};
