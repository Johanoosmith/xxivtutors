<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('document_type', ['passport', 'national_id', 'other'])->nullable();
            $table->string('firstname_on_doc')->nullable();
            $table->string('lastname_on_doc')->nullable();
            $table->string('othername_on_doc')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->date('expire_date')->nullable();
            $table->string('file');
            $table->tinyInteger('status')->default(2)->comment("1 => 'Approved', 2 => 'Pending', 3 => 'Rejected'");
            $table->text('reject_reason')->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifications');
    }
};
