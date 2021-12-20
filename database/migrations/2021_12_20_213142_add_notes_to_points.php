<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotesToPoints extends Migration
{
    public function up()
    {
        Schema::table('points', function (Blueprint $table) {
            $table->text('notes')->after('muscle_pain')->nullable();
        });
    }
}
