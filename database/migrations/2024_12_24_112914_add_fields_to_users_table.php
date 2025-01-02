<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('postcode')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->float('rating', 3, 2)->nullable(); // Allow values like 4.5
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['postcode', 'gender', 'rating']);
        });
    }
}
