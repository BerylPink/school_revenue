<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('users_id')->unique();
            $table->unsignedBigInteger('country_id')->index();
            $table->unsignedBigInteger('states_id')->index();
            $table->unsignedBigInteger('colleges_id')->index();
            $table->unsignedBigInteger('departments_id')->index();
            $table->string('registration_number');
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('gender',['Male', 'Female']);
            $table->date('DOB');
            $table->string('phone_no', '11')->unique();
            $table->text('address');
            $table->text('profile_avatar');
            $table->date('registration_date');
            $table->unsignedBigInteger('updated_by')->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
