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

        return new ManagePaymentCollection(ManagePayment::with('pyFID','pySI.studInfo','pysy','pysem','pyyl','pycat')->orderBy('id','DESC')->paginate(10));
    }

    public function paymentlist()
    {
        return new ManagePaymentCollection(ManagePayment::with('pyFID','pySI.studInfo','pysy','pysem','pyyl','pycat')->orderBy('id','DESC')->where('sy',2)->paginate(10000));

    }

    public function searchPaymentList($field,$query)
    {
        return new ManagePaymentCollection(ManagePayment::with('pyFID.enrollprograms','pySI.studInfo','pysy','pysem','pyyl','pycat')->orderBy('id','DESC')->where($field,'LIKE',"%$query%")->get());
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
        $mp->computer_fee = $request->computer_fee;
        $mp->penalty_fee = $request->penalty_fee;
        //
        $mp->idval_fee = $request->idval_fee;
        $mp->guidance_fee = $request->guidance_fee;
        $mp->careerdev_fee = $request->careerdev_fee;
        $mp->ptccup_fee = $request->ptccup_fee;
        $mp->studenthb_fee = $request->studenthb_fee;
        $mp->insurance_fee = $request->insurance_fee;
        $mp->ssc_fee = $request->ssc_fee;
        //
        $mp->total_amount_fee = $request->total_amount_fee;
        $mp->assessed_by = $request->assessed_by;
        $mp->downpayment_or_num = $request->downpayment_or_num;
        $mp->downpayment_amount_paid = $request->downpayment_amount_paid;
        $mp->downpayment_paid_date = $request->downpayment_paid_date;
        $mp->downpayment_issued_by = $request->downpayment_issued_by;
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
        return new ManagePaymentResource(ManagePayment::with('pyFID','pySI.studInfo','pysy','pysem','pysem','pyyl','pycat')->findOrFail($id));
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


        $mp->yearlevel = $request->yearlevel;
        $mp->balance_fee = $request->balance_fee;
        // Adding
        $mp->adding_or_num = $request->adding_or_num;
        $mp->adding_amount_paid = $request->adding_amount_paid;
        $mp->adding_paid_date = $request->adding_paid_date;
        $mp->adding_issued_by = $request->adding_issued_by;
        // Downpayment
        $mp->downpayment_or_num = $request->downpayment_or_num;
        $mp->downpayment_amount_paid = $request->downpayment_amount_paid;
        $mp->downpayment_paid_date = $request->downpayment_paid_date;
        $mp->downpayment_issued_by = $request->downpayment_issued_by;
        // $mp->prelim_topaid = $request->prelim_topaid;
        // Prelim
        $mp->prelim_topaid = $request->prelim_topaid;
        $mp->prelim_or_num = $request->prelim_or_num;
        $mp->prelim_amount_paid = $request->prelim_amount_paid;
        $mp->prelim_paid_date = $request->prelim_paid_date;
        $mp->prelim_issued_by = $request->prelim_issued_by;
        // $mp->midterm_topaid = $request->midterm_topaid;
        // Midterm
        $mp->midterm_topaid = $request->midterm_topaid;
        $mp->midterm_or_num = $request->midterm_or_num;
        $mp->midterm_amount_paid = $request->midterm_amount_paid;
        $mp->midterm_paid_date = $request->midterm_paid_date;
        $mp->midterm_issued_by = $request->midterm_issued_by;
        // $mp->finals_topaid = $request->finals_topaid;
        // Finals
        $mp->finals_topaid = $request->finals_topaid;
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
        return new ManagePaymentCollection(ManagePayment::with('pyFID','pySI.studInfo','pysy','pysem','pysem','pyyl','pycat')->where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }
}
