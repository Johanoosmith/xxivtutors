<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->unique();
            }
    
            if (!Schema::hasColumn('categories', 'category_image')) {
                $table->string('category_image')->nullable();
            }
    
            if (!Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable();
            }
    
            if (!Schema::hasColumn('categories', 'status')) {
                $table->boolean('status')->default(1);
            }
    
            if (!Schema::hasColumn('categories', 'meta_title')) {
                $table->string('meta_title')->nullable();
            }
    
            if (!Schema::hasColumn('categories', 'meta_description')) {
                $table->text('meta_description')->nullable();
            }
        });
    }
    
};
