<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradingInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grading_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sy')->unsigned();
            $table->integer('semester')->unsigned();
            $table->integer('grad_year')->unsigned();
            $table->integer('grad_section_id')->unsigned();
            $table->integer('prelim_grade')->nullable();
            $table->integer('midterm_grade')->nullable();
            $table->integer('finals_grade')->nullable();
            $table->integer('gen_ave')->nullable();
            $table->string('trans_grade')->nullable();
            $table->string('g_id_num');
            $table->integer('g_course_id')->unsigned();
            $table->integer('g_id_ins')->unsigned();
            $table->timestamps();

            $table->foreign('g_id_num')->references('id_num')->on('student_information')->onDelete('cascade');
            $table->foreign('g_course_id')->references('id')->on('courses_information')->onDelete('cascade');
            $table->foreign('g_id_ins')->references('id')->on('users_instructor')->onDelete('cascade');
            $table->foreign('semester')->references('id')->on('semester_info')->onDelete('cascade');
            $table->foreign('grad_year')->references('id')->on('yearlevel_info')->onDelete('cascade');
            $table->foreign('grad_section_id')->references('id')->on('section_info')->onDelete('cascade');
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
        Schema::dropIfExists('grading_information');
    }
}
