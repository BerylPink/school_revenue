<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicStaffs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_staffs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('states_id')->index();
            $table->unsignedBigInteger('country_id')->index();
            $table->unsignedBigInteger('colleges_id')->index();
            $table->unsignedBigInteger('departments_id')->index();
            $table->unsignedBigInteger('courses_id')->index();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->enum('gender',['Male', 'Female']);
            $table->enum('marital_status',['Single', 'Married', 'divorced']);
            $table->date('DOB');
            $table->date('date_joined');
            $table->string('employee_number');
            $table->string('phone_no', '11')->unique();
            $table->text('address');
            $table->unsignedBigInteger('created_by')->default(NULL);
            $table->unsignedBigInteger('updated_by')->default(NULL);
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
        Schema::dropIfExists('academic_staffs');
    }
}
