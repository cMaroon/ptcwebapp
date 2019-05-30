<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoursesCollection;
use App\Http\Resources\CoursesResource;

use App\Courses;

class CoursesController extends Controller
{
    protected $table = 'courses_information';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CoursesCollection(Courses::orderBy('id','DESC')->paginate(10));
    }

    public function courselist()
    {
        return new CoursesCollection(Courses::orderBy('course_code','ASC')->get());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'course_code' => 'required|string|max:191',
            'descriptive_title' => 'required|string|max:191',
            'lec_hr' => 'required',
            'lab_hr' => 'required',
            'course_unit' => 'required',
        ]);
        // 'course_code','descriptive_title','lec_hr','lab_hr','course_unit','course_pre_req'

        $cs = new Courses();
        $cs->course_code = $request->course_code;
        $cs->descriptive_title = $request->descriptive_title;
        $cs->lec_hr = $request->lec_hr;
        $cs->lab_hr = $request->lab_hr;
        $cs->course_unit = $request->course_unit;
        $cs->course_pre_req = $request->course_pre_req;
        $cs->save();

        return new CoursesResource($cs);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CoursesResource(Courses::findOrFail($id));
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
        $this->validate($request,[
            'course_code' => 'required|string|max:191',
            'descriptive_title' => 'required|string|max:191',
            'lec_hr' => 'required',
            'lab_hr' => 'required',
            'course_unit' => 'required',
        ]);

        $cs = Courses::findOrfail($id);
        $cs->course_code = $request->course_code;
        $cs->descriptive_title = $request->descriptive_title;
        $cs->lec_hr = $request->lec_hr;
        $cs->lab_hr = $request->lab_hr;
        $cs->course_unit = $request->course_unit;
        $cs->course_pre_req = $request->course_pre_req;
        $cs->save();

        return new CoursesResource($cs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cs = Courses::findOrfail($id);
        $cs->delete();
        return new CoursesResource($cs);

    }

    public function searchCourses($field,$query)
    {
        return new CoursesCollection(Courses::where($field,'LIKE',"%$query%")->latest()
        ->paginate(10));
    }

}
