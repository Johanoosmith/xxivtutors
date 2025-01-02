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
            $table->string('profile_image')->nullable(); // Profile Image
            $table->text('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->string('qualification_1')->nullable();
            $table->string('qualification_2')->nullable();
            $table->string('qualification_3')->nullable();
            $table->string('qualification_4')->nullable();
            $table->string('experience')->nullable();
            $table->string('rate')->nullable();
        });
    }
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_image','short_description', 'full_description', 'qualification_1', 'qualification_2',
                'qualification_3', 'qualification_4', 'experience', 'rate'
            ]);
        });
    }
};
