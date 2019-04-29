<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\ManageEnrollmentCollection;
use App\Http\Resources\ManageEnrollmentResource;

use App\ManageEnrollment;

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

        return new ManageEnrollmentCollection(ManageEnrollment::orderBy('id','DESC')->paginate(15));
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
        return new ManageEnrollmentResource(ManageEnrollment::findOrFail($id));
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
        $me = new ManageEnrollment();
        $me->enr_form_id = $request->enr_form_id;
        $me->sy = $request->sy;
        $me->semester = $request->semester;
        $me->yearlevel = $request->yearlevel;
        $me->enr_id_num = $request->enr_id_num;
        $me->enr_program_id = $request->enr_program_id;
        $me->total_course_unit = $request->total_course_unit;
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
        $me->delete();
        return new ManageEnrollmentResource($me);
    }

    public function searchEnroll($field,$query)
    {
        return new ManageEnrollmentCollection(ManageEnrollment::where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }
}
