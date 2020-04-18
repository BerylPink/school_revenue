<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNonAcademicStaffs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_academic_staffs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id')->index();
            $table->unsignedBigInteger('states_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->string('employee_number');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phone_no', '11')->unique();
            $table->enum('gender',['Male', 'Female']);
            $table->enum('marital_status',['Single', 'Married', 'divorced']);
            $table->date('DOB');
            $table->date('date_joined');
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
        Schema::dropIfExists('non_academic_staffs');
    }
}
