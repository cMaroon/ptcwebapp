<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentUserCollection;
use App\Http\Resources\StudentUserResource;

use App\StudentInformation;

class StudentInformationController extends Controller
{
    protected $table = 'student_information';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return new StudentUserCollection(StudentInformation::orderBy('lastname','ASC')->paginate(15));
    }

    public function studentInfoList()
    {
        return new StudentUserCollection(StudentInformation::get());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $studentinfo = new StudentInformation();
        $studentinfo->sex = $request->sex;
        $studentinfo->ca_st_num = $request->ca_st_num;
        $studentinfo->ca_st_name = $request->ca_st_name;
        $studentinfo->ca_subd = $request->ca_subd;
        $studentinfo->ca_brgy = $request->ca_brgy;
        $studentinfo->ca_city = $request->ca_city;

        $studentinfo->save();
        
        return new StudentUserResource($studentinfo);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new StudentUserResource(StudentInformation::findOrFail($id));
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
        $studentinfo = StudentInformation::findOrfail($id);
        $studentinfo->sex = $request->sex;
        $studentinfo->ca_st_num = $request->ca_st_num;
        $studentinfo->ca_st_name = $request->ca_st_name;
        $studentinfo->ca_subd = $request->ca_subd;
        $studentinfo->ca_brgy = $request->ca_brgy;
        $studentinfo->ca_city = $request->ca_city;
        $studentinfo->save();

        return new StudentUserResource($studentinfo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $studentinfo = StudentInformation::findOrfail($id);
        // $studentinfo->delete();
        // return new StudentUserResource($studentinfo);
    }

    public function searchInfo($field,$query)
    {
        return new StudentUserCollection(StudentInformation::where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }

    public function searchUser($field,$query)
    {
        return new StudentUserCollection(Student::with('studInfo')->where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }
}
