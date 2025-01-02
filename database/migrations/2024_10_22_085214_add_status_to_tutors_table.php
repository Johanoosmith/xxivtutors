<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToTutorsTable extends Migration
{
    public function up()
    {
        Schema::table('tutors', function (Blueprint $table) {
            $table->string('status')->default('active'); // or use 'inactive', depending on your use case
        });
    }

    public function down()
    {
        Schema::table('tutors', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
