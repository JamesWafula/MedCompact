<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reported_errors', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('email')->nullable();
            $table->string('gender');
            $table->date('date');
            $table->string('time');
            $table->string('age');
            // location of error
            $table->foreign('location_of_error_id')->references('id')->on('locations')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('location_of_error_id')->unsigned();
     
            $table->string('diagnosis');
            // incidents
            $table->foreign('incident_id')->references('id')->on('incidents')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('incident_id')->unsigned();
            
            // //type of error
            $table->foreign('type_of_error_id')->references('id')->on('type_of_errors')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('type_of_error_id')->unsigned();
            // // possible factors
            $table->foreign('possible_factor_id')->references('id')->on('possible_factors')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('possible_factor_id')->unsigned();
            // //specific location
            $table->foreign('specific_location_id')->references('id')->on('specific_locations')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('specific_location_id')->unsigned();
            //  //specific location other
            $table->string('specific_location_by_user')->nullable();
            // // preventability
            $table->foreign('preventability_id')->references('id')->on('preventabilities')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('preventability_id')->unsigned();
            $table->string('suggestions');
            // // outcome of error
            $table->foreign('outcome_id')->references('id')->on('outcomes')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('outcome_id')->unsigned();
            // // reporting by occupation
            $table->foreign('occupation_id')->references('id')->on('occupations')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('occupation_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('user_id')->unsigned()->nullable();
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
        Schema::dropIfExists('reported_errors');
    }
};
