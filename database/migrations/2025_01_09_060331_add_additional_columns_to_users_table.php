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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('dob_year')->nullable();
            $table->integer('dob_month')->nullable();
            $table->integer('dob_day')->nullable();
            $table->string('language')->nullable();
            $table->integer('distance')->nullable();
            $table->text('bio')->nullable();
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['dob_year', 'dob_month', 'dob_day', 'language', 'distance', 'bio']);
        });
    }
};
