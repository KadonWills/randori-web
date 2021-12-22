<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCourseEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->datetime('start_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('end_time')->default(DB::raw('CURRENT_TIMESTAMP'));
           // $table->date('course_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('space', 25);
            $table->integer('capacity');
            $table->integer('user_id');
            $table->foreign("user_id")
                        ->references('id')
                        ->on("users");
            $table->integer('course_offer_id');
            $table->foreign("course_offer_id")
                        ->references('id')
                        ->on("course_offer");
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_events');
    }
}
