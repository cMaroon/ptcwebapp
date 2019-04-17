<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_id_num');
            $table->integer('sy')->unsigned();
            $table->integer('semester')->unsigned();
            $table->integer('yearlevel')->unsigned();
            $table->integer('payment_form_id')->unsigned();;
            $table->integer('tuition_fee')->nullable();
            $table->integer('registration_fee')->nullable();
            $table->integer('library_fee')->nullable();
            $table->integer('medical_fee')->nullable();
            $table->integer('cultural_fee')->nullable();
            $table->integer('athletic_fee')->nullable();
            $table->integer('bookrental_fee')->nullable();
            $table->integer('laboratory_fee')->nullable();
            $table->integer('penalty_fee')->nullable();
            $table->integer('other_fee')->nullable();
            $table->integer('total_amount_fee')->nullable();
            $table->integer('prelim_or_num')->nullable();
            $table->integer('prelim_amount_paid')->nullable();
            $table->integer('prelim_paid_date')->nullable();
            $table->integer('prelim_issued_by')->nullable();
            $table->integer('midterm_or_num')->nullable();
            $table->integer('midterm_amount_paid')->nullable();
            $table->integer('midterm_paid_date')->nullable();
            $table->integer('midterm_issued_by')->nullable();
            $table->integer('finals_or_num')->nullable();
            $table->integer('finals_amount_paid')->nullable();
            $table->integer('finals_paid_date')->nullable();
            $table->integer('finals_issued_by')->nullable();
            $table->timestamps();

            $table->foreign('payment_id_num')->references('id_num')->on('student_information')->onDelete('cascade');
            $table->foreign('payment_form_id')->references('id')->on('enrollment_information')->onDelete('cascade');
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
        Schema::dropIfExists('payment_information');
    }
}
