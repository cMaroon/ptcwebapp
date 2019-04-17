<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssocEnrCouTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assoc_enr_cou', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sy')->unsigned();
            $table->integer('semester')->unsigned();
            $table->integer('yearlevel')->unsigned();
            $table->integer('assoc_form_id')->unsigned();
            $table->integer('assoc_curr_id')->unsigned();
            $table->timestamps();

            $table->foreign('assoc_form_id')->references('id')->on('enrollment_information')->onDelete('cascade');
            $table->foreign('assoc_curr_id')->references('id')->on('curriculum_information')->onDelete('cascade');
            $table->foreign('semester')->references('id')->on('semester_info')->onDelete('cascade');
            $table->foreign('yearlevel')->references('id')->on('yearlevel_info')->onDelete('cascade');
            $table->foreign('sy')->references('id')->on('school_year')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assoc_enr_cou');
    }
}
