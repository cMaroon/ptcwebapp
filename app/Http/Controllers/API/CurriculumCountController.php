<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\CurriculumCollection;
use App\Http\Resources\CurriculumResource;

use App\Curriculum;

class CurriculumCountController extends Controller
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
     

        $cu = Curriculum::findOrfail($id);

        $cu->curr_stud_count = $request->curr_stud_count;

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



}
