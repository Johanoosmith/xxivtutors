<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tutor_specializations', function (Blueprint $table) {
            $table->id();            
            $table->integer('tutor_id')->nullable();
            $table->integer('course_id')->nullable();            
            $table->timestamps();
        });
    }
    
};
