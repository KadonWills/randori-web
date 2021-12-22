<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('phone')->nullable();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->date('dob');
            $table->string('gender', 22);
            $table->text('password');
            $table->string('resetPasswordHash')->nullable();
            $table->string('verificationCode')->nullable();
            $table->boolean('verified')->default(false);
            $table->string('abo')->nullable();
            $table->string('photo')->nullable();
            $table->string('role', 11)->nullable(); //member, admin, tester, teacher
            $table->string("status")->default("ACTIVE");
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
        Schema::dropIfExists('users');
    }
}
