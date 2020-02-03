<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentInformation extends Migration
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
            $table->integer('payment_form_id')->unsigned();
            $table->integer('category')->unsigned();
            $table->integer('tuition_fee')->nullable();
            //
            $table->integer('municipal_subsidy')->nullable();
            //
            $table->integer('registration_fee')->nullable();
            $table->integer('library_fee')->nullable();
            $table->integer('medical_fee')->nullable();
            $table->integer('cultural_fee')->nullable();
            $table->integer('athletic_fee')->nullable();
            $table->integer('bookrental_fee')->nullable();
            $table->integer('laboratory_fee')->nullable();
            $table->integer('penalty_fee')->nullable();
            $table->integer('other_fee')->nullable();
            //New breakdown fee
            $table->integer('idval_fee')->nullable();
            $table->integer('guidance_fee')->nullable();
            $table->integer('devt_fee')->nullable();
            $table->integer('ptccup_fee')->nullable();
            $table->integer('admission_fee')->nullable();
            $table->integer('studenthb_fee')->nullable();
            $table->integer('insurance_fee')->nullable();
            $table->integer('ssc_fee')->nullable();
            //
            $table->integer('total_amount_fee')->nullable();
            //
            $table->integer('balance_fee')->nullable();
            $table->string('assessed_by');
            $table->integer('downpayment_topaid')->nullable();
            //
            $table->string('adding_or_num');
            $table->integer('adding_amount_paid')->nullable();
            $table->string('adding_paid_date');
            $table->string('adding_issued_by');
            //
            $table->string('downpayment_or_num');
            $table->integer('downpayment_amount_paid')->nullable();
            $table->string('downpayment_paid_date');
            $table->string('downpayment_issued_by');
            //
            $table->integer('prelim_topaid')->nullable();
            $table->string('prelim_or_num');
            $table->integer('prelim_amount_paid')->nullable();
            $table->string('prelim_paid_date');
            $table->string('prelim_issued_by');
            //
            $table->integer('midterm_topaid')->nullable();
            $table->string('midterm_or_num');
            $table->integer('midterm_amount_paid')->nullable();
            $table->string('midterm_paid_date');
            $table->string('midterm_issued_by');
            //
            $table->integer('finals_topaid')->nullable();
            $table->string('finals_or_num');
            $table->integer('finals_amount_paid')->nullable();
            $table->string('finals_paid_date');
            $table->string('finals_issued_by');
            $table->timestamps();

            $table->foreign('payment_id_num')->references('id_num')->on('student_information')->onDelete('cascade');
            $table->foreign('payment_form_id')->references('enr_form_id')->on('enrollment_information')->onDelete('cascade');
            $table->foreign('semester')->references('id')->on('semester_info')->onDelete('cascade');
            $table->foreign('yearlevel')->references('id')->on('yearlevel_info')->onDelete('cascade');
            $table->foreign('sy')->references('id')->on('school_year')->onDelete('cascade');
            $table->foreign('category')->references('id')->on('category')->onDelete('cascade');
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
