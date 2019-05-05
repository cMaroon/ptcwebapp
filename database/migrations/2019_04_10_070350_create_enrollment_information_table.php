<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollment_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enr_form_id')->unsigned()->unique();
            $table->string('enr_id_num');
            $table->integer('sy')->unsigned();
            $table->integer('semester')->unsigned();
            $table->integer('yearlevel')->unsigned();
            $table->integer('section')->unsigned();
            $table->integer('enr_program_id')->unsigned();
            $table->integer('total_course_unit')->nullable();
            $table->timestamps();

            $table->foreign('enr_id_num')->references('id_num')->on('student_information')->onDelete('cascade');
            $table->foreign('enr_program_id')->references('id')->on('program_information')->onDelete('cascade');
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
        Schema::dropIfExists('enrollment_information');
    }
}
