<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
public function up():void
{
    Schema::create('tutors', function (Blueprint $table) {
        $table->id();
        $table->string('fullname');
        $table->string('email')->unique();
        $table->string('contact');
        $table->string('specialization');
        $table->string('password');
        $table->timestamps();
    });
}
public function down(): void
{
    Schema::dropIfExists('students');
}


};
