<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\ManageEnrollmentCollection;
use App\Http\Resources\ManageEnrollmentResource;

use App\ManageEnrollment;
use App\ManagePayment;

class ManageEnrollmentCountController extends Controller
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
        $me->total_course_unit = $request->total_course_unit;
        $me->total_lab = $request->total_lab;
        $me->total_comp = $request->total_comp;
        $me->save();

        
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
