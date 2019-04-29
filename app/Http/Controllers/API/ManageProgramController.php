<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\ManageProgramCollection;
use App\Http\Resources\ManageProgramResource;

use App\ManageProgram;

class ManageProgramController extends Controller
{
    protected $table = 'program_information';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return new ManageProgramCollection(ManageProgram::with('aID')->orderBy('id','DESC')->paginate(4));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $mp = new ManageProgram();
        $mp->program_code = $request->program_code;
        $mp->descriptive_title = $request->descriptive_title;
        $mp->advising_id = $request->advising_id;
        $mp->save();
        
        return new ManageProgramResource($mp);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ManageProgramResource(ManageProgram::findOrFail($id));
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
        $mp = new ManageProgram();
        $mp->program_code = $request->program_code;
        $mp->descriptive_title = $request->descriptive_title;
        $mp->advising_id = $request->advising_id;
        $mp->save();
        
        return new ManageProgramResource($mp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mp = ManageProgram::findOrfail($id);
        $mp->delete();
        return new ManageProgramResource($mp);
    }

    public function searchProgram($field,$query)
    {
        return new ManageProgramCollection(ManageProgram::where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }
}
