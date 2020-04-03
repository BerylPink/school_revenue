<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('users_id')->index();
            $table->unsignedBigInteger('college_id')->index();
            $table->unsignedBigInteger('states_id')->index();
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('gender',['Male', 'Female']);
            $table->string('phone_no', '11')->unique();
            $table->text('address');
            $table->text('profile_avatar');
            $table->unsignedBigInteger('created_by');
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
        Schema::dropIfExists('admin_infos');
    }
}
