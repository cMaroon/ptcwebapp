<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\ManageEnrollmentCollection;
use App\Http\Resources\ManageEnrollmentResource;

use App\ManageEnrollment;
use App\ManagePayment;

class ManageEnrollmentController extends Controller
{
    protected $table = 'enrollment_information';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return new ManageEnrollmentCollection(ManageEnrollment::with('enrollprograms','studinfo','enrollassoc','enrsy','enrsem','enryearlevel','enrsection')->orderBy('id','DESC')->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      

        $me = new ManageEnrollment();
        $me->enr_form_id = $request->enr_form_id;
        $me->sy = $request->sy;
        $me->semester = $request->semester;
        $me->yearlevel = $request->yearlevel;
        $me->enr_id_num = $request->enr_id_num;
        $me->enr_program_id = $request->enr_program_id;
        $me->total_course_unit = $request->total_course_unit;
        $me->save();

        // $mp = new ManagePayment();
        // $mp->payment_id_num = $request->payment_id_num;
        // $mp->sy = $request->sy;
        // $mp->semester = $request->semester;
        // $mp->yearlevel = $request->yearlevel;
        // $mp->payment_form_id = $request->payment_form_id;
        // $mp->save();
        
        return new ManageEnrollmentResource($me);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ManageEnrollmentResource(ManageEnrollment::with('enrollprograms','studinfo','enrollassoc','enrsy','enrsem','enryearlevel','enrsection')->findOrFail($id));
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
        $me = ManageEnrollment::findOrfail($id);
        $me->sy = $request->sy;
        $me->semester = $request->semester;
        $me->yearlevel = $request->yearlevel;
        $me->enr_id_num = $request->enr_id_num;
        $me->enr_program_id = $request->enr_program_id;
        $me->total_course_unit = $request->total_course_unit;
        $me->save();

        // $mp = ManagePayment::findOrfail($id);
        // $mp->payment_id_num = $request->payment_id_num;
        // $mp->sy = $request->sy;
        // $mp->semester = $request->semester;
        // $mp->yearlevel = $request->yearlevel;
        // $mp->save();
        
        return new ManageEnrollmentResource($me);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $me = ManageEnrollment::findOrfail($id);
        $mp = ManagePayment::findOrfail($id);
        $me->delete();
        $mp->delete();
        return new ManageEnrollmentResource($me,$mp);
    }

    public function searchEnroll($field,$query)
    {
        return new ManageEnrollmentCollection(ManageEnrollment::with('enrollprograms','studinfo','enrollassoc','enrsy','enrsem','enryearlevel','enrsection')->where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }
}
