<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('activity_id')->index();
            $table->uuid('student_id')->index();
            $table->integer('score');
            $table->jsonb('answers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_results');
    }
}
