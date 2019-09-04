<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\ManageEnrollmentAssocCollection;
use App\Http\Resources\ManageEnrollmentAssocResource;

use App\EnrollmentAssoc;

class ManageEnrollmentAssocController extends Controller
{
    protected $table = 'assoc_enr_cou';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return new ManageEnrollmentAssocCollection(EnrollmentAssoc::with('assocformid.payment','assocformid.studinfo.studInfo','assoccurrid.currsemester','assoccurrid.curryearlevel','assoccurrid.currcourses','assoccurrid.currsection','assoccurrid.currprograms')->orderBy('id','DESC')->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      

        $ea = new EnrollmentAssoc();
        $ea->assoc_form_id = $request->assoc_form_id;
        $ea->assoc_curr_id = $request->assoc_curr_id;
        $ea->save();
       
        return new ManageEnrollmentAssocResource($ea);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ManageEnrollmentAssocResource(EnrollmentAssoc::with('assocformid.payment.pycat','assocformid.studinfo.studInfo','assoccurrid.currsemester','assoccurrid.curryearlevel','assoccurrid.currcourses','assoccurrid.currsection','assoccurrid.currprograms')->findOrFail($id));
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
        $ea = EnrollmentAssoc::findOrfail($id);
        $ea->assoc_form_id = $request->assoc_form_id;
        $ea->assoc_curr_id = $request->assoc_curr_id;
        $ea->save();
        
        return new ManageEnrollmentAssocResource($ea);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ea = EnrollmentAssoc::findOrfail($id);
        $ea->delete();
        return new ManageEnrollmentAssocResource($ea);
    }

    public function searchAssoc($field,$query)
    {
        return new ManageEnrollmentAssocCollection(EnrollmentAssoc::with('assocformid.payment.pycat','assocformid.studinfo.studInfo','assoccurrid.currsemester','assoccurrid.curryearlevel','assoccurrid.currcourses','assoccurrid.currsection','assoccurrid.currprograms')->where($field,'LIKE',"$query")->latest()
        ->paginate(15));
    }

    public function searchClassList($field,$query)
    {
        return new ManageEnrollmentAssocCollection(EnrollmentAssoc::with('assocformid.payment.pycat','assocformid.studinfo.studInfo','assoccurrid.currsemester','assoccurrid.curryearlevel','assoccurrid.currcourses','assoccurrid.currsection','assoccurrid.currprograms')->where($field,'LIKE',"%$query%")->get());
    }
}
