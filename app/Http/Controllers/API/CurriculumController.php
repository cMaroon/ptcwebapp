<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\CurriculumCollection;
use App\Http\Resources\CurriculumResource;

use App\Curriculum;

class CurriculumController extends Controller
{
    protected $table = 'curriculum_information';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CurriculumCollection(Curriculum::with('currsy','currprograms','currcourses','currsemester','curryearlevel','currsection','currinstructor')->orderBy('id','DESC')->paginate(10));
    }

    public function currlist()
    {
        return new CurriculumCollection(Curriculum::with('currsy','currprograms','currcourses','currsemester','curryearlevel','currsection','currinstructor')->get());

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
            'sy' => 'required',
            'semester' => 'required',
            'curr_year' => 'required',
            'curr_program_id' => 'required',
            'curr_course_id' => 'required',
            'curr_section_id' => 'required',
            'sched_days'=>'required',
            'sched_time'=>'required',
            'sched_room'=>'required',
            'curr_limit_persec'=>'required',
            'curr_id_ins'=>'required',

        ]);

        $cu = new Curriculum();
        $cu->sy = $request->sy;
        $cu->semester = $request->semester;
        $cu->curr_year = $request->curr_year;
        $cu->curr_program_id = $request->curr_program_id;
        $cu->curr_course_id = $request->curr_course_id;
        $cu->curr_section_id = $request->curr_section_id;
        $cu->curr_stud_count = $request->curr_stud_count;
        $cu->curr_limit_persec = $request->curr_limit_persec;
        $cu->sched_days = $request->sched_days;
        $cu->sched_time = $request->sched_time;
        $cu->sched_room = $request->sched_room;
        $cu->curr_id_ins = $request->curr_id_ins;
        $cu->save();

        return new CurriculumResource($cu);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CurriculumResource(Curriculum::with('currsy','currprograms','currcourses','currsemester','curryearlevel','currsection','currinstructor')->findOrFail($id));
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
            'sy' => 'required',
            'semester' => 'required',
            'curr_year' => 'required',
            'curr_program_id' => 'required',
            'curr_course_id' => 'required',
            'curr_section_id' => 'required',
            'sched_days'=>'required',
            'sched_time'=>'required',
            'sched_room'=>'required',
            'curr_limit_persec'=>'required',
            'curr_id_ins'=>'required',

        ]);

        $cu = Curriculum::findOrfail($id);
        $cu->sy = $request->sy;
        $cu->semester = $request->semester;
        $cu->curr_year = $request->curr_year;
        $cu->curr_program_id = $request->curr_program_id;
        $cu->curr_course_id = $request->curr_course_id;
        $cu->curr_section_id = $request->curr_section_id;
        $cu->curr_stud_count = $request->curr_stud_count;
        $cu->curr_limit_persec = $request->curr_limit_persec;
        $cu->sched_days = $request->sched_days;
        $cu->sched_time = $request->sched_time;
        $cu->sched_room = $request->sched_room;
        $cu->curr_id_ins = $request->curr_id_ins;
        $cu->save();

        return new CurriculumResource($cu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cu = Curriculum::findOrfail($id);
        $cu->delete();
        return new CurriculumResource($cu);

    }

    public function searchCurriculum($field,$query)
    {
        return new CurriculumCollection(Curriculum::with('currsy','currprograms','currcourses','currsemester','curryearlevel','currsection','currinstructor')->where($field,'LIKE',"%$query%")->latest()
        ->paginate(10));
    }

}
