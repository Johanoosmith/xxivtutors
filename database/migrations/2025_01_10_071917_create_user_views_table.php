<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserViewsTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_views', function (Blueprint $table) {
            $table->id(); // auto-incrementing primary key
            $table->unsignedBigInteger('user_id'); // ID of the user being viewed
            $table->unsignedBigInteger('viewer_id'); // ID of the viewer
            $table->boolean('view'); // Whether the user was viewed (true/false)
            $table->timestamp('date')->useCurrent(); // Date and time when the view occurred
            $table->timestamps(); // created_at and updated_at

            // Adding foreign key constraints (optional, if users table exists)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('viewer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_views');
    }
}
