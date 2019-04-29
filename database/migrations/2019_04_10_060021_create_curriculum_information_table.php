<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculumInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculum_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sy')->unsigned();
            $table->integer('semester')->unsigned();
            $table->integer('curr_year')->unsigned();
            $table->integer('curr_program_id')->unsigned();
            $table->integer('curr_course_id')->unsigned();
            $table->integer('curr_section_id')->unsigned();
            $table->integer('curr_stud_count')->unsigned();
            $table->integer('curr_limit_persec')->unsigned();
            $table->string('sched_days')->nullable();
            $table->string('sched_time')->nullable();
            $table->string('sched_room')->nullable();
            $table->integer('curr_id_ins')->unsigned();
            $table->timestamps();

            $table->foreign('curr_program_id')->references('id')->on('program_information')->onDelete('cascade');
            $table->foreign('curr_course_id')->references('id')->on('courses_information')->onDelete('cascade');
            $table->foreign('curr_section_id')->references('id')->on('section_info')->onDelete('cascade');
            $table->foreign('semester')->references('id')->on('semester_info')->onDelete('cascade');
            $table->foreign('curr_year')->references('id')->on('yearlevel_info')->onDelete('cascade');
            $table->foreign('sy')->references('id')->on('school_year')->onDelete('cascade');
            $table->foreign('curr_id_ins')->references('id')->on('instructor_information')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculum_information');
    }
}
