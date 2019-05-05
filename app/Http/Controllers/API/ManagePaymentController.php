<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\ManagePaymentCollection;
use App\Http\Resources\ManagePaymentResource;

use App\ManagePayment;

class ManagePaymentController extends Controller
{
    protected $table = 'payment_information';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return new ManagePaymentCollection(ManagePayment::with('pyFID','pySI','pysy','pysem','pysem','pyyl')->orderBy('id','DESC')->paginate(4));
    }

    public function paymentlist()
    {
        return new ManagePaymentCollection(ManagePayment::get());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        $mp = new ManagePayment();
        $mp->payment_id_num = $request->payment_id_num;
        $mp->sy = $request->sy;
        $mp->semester = $request->semester;
        $mp->yearlevel = $request->yearlevel;
        $mp->payment_form_id = $request->payment_form_id;
        $mp->tuition_fee = $request->tuition_fee;
        $mp->registration_fee = $request->registration_fee;
        $mp->library_fee = $request->library_fee;
        $mp->medical_fee = $request->medical_fee;
        $mp->cultural_fee = $request->cultural_fee;
        $mp->athletic_fee = $request->athletic_fee;
        $mp->bookrental_fee = $request->bookrental_fee;
        $mp->laboratory_fee = $request->laboratory_fee;
        $mp->penalty_fee = $request->penalty_fee;
        $mp->other_fee = $request->other_fee;
        $mp->total_amount_fee = $request->total_amount_fee;
        $mp->assessed_by = $request->assessed_by;
        $mp->prelim_or_num = $request->prelim_or_num;
        $mp->prelim_amount_paid = $request->prelim_amount_paid;
        $mp->prelim_paid_date = $request->prelim_paid_date;
        $mp->prelim_issued_by = $request->prelim_issued_by;
        $mp->midterm_or_num = $request->midterm_or_num;
        $mp->midterm_amount_paid = $request->midterm_amount_paid;
        $mp->midterm_paid_date = $request->midterm_paid_date;
        $mp->midterm_issued_by = $request->midterm_issued_by;
        $mp->finals_or_num = $request->finals_or_num;
        $mp->finals_amount_paid = $request->finals_amount_paid;
        $mp->finals_paid_date = $request->finals_paid_date;
        $mp->finals_issued_by = $request->finals_issued_by;
        $mp->save();
        
        return new ManagePaymentResource($mp);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ManagePaymentResource(ManagePayment::with('pyFID','pySI','pysy','pysem','pysem','pyyl')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mp = ManagePayment::findOrfail($id);
        $mp->payment_id_num = $request->payment_id_num;
        $mp->sy = $request->sy;
        $mp->semester = $request->semester;
        $mp->yearlevel = $request->yearlevel;
        $mp->payment_form_id = $request->payment_form_id;
        $mp->tuition_fee = $request->tuition_fee;
        $mp->registration_fee = $request->registration_fee;
        $mp->library_fee = $request->library_fee;
        $mp->medical_fee = $request->medical_fee;
        $mp->cultural_fee = $request->cultural_fee;
        $mp->athletic_fee = $request->athletic_fee;
        $mp->bookrental_fee = $request->bookrental_fee;
        $mp->laboratory_fee = $request->laboratory_fee;
        $mp->penalty_fee = $request->penalty_fee;
        $mp->other_fee = $request->other_fee;
        $mp->total_amount_fee = $request->total_amount_fee;
        $mp->assessed_by = $request->assessed_by;
        $mp->prelim_or_num = $request->prelim_or_num;
        $mp->prelim_amount_paid = $request->prelim_amount_paid;
        $mp->prelim_paid_date = $request->prelim_paid_date;
        $mp->prelim_issued_by = $request->prelim_issued_by;
        $mp->midterm_or_num = $request->midterm_or_num;
        $mp->midterm_amount_paid = $request->midterm_amount_paid;
        $mp->midterm_paid_date = $request->midterm_paid_date;
        $mp->midterm_issued_by = $request->midterm_issued_by;
        $mp->finals_or_num = $request->finals_or_num;
        $mp->finals_amount_paid = $request->finals_amount_paid;
        $mp->finals_paid_date = $request->finals_paid_date;
        $mp->finals_issued_by = $request->finals_issued_by;
        $mp->save();
        
        return new ManagePaymentResource($mp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mp = ManagePayment::findOrfail($id);
        $mp->delete();
        return new ManagePaymentResource($mp);
    }

    public function searchPayment($field,$query)
    {
        return new ManagePaymentCollection(ManagePayment::with('pyFID','pySI','pysy','pysem','pysem','pyyl')->where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }
}
