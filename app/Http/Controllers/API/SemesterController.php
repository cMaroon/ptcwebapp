<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\OtherSettingsCollection;
use App\Http\Resources\OtherSettingsResource;

use App\Semester;

class SemesterController extends Controller
{
    protected $table = 'semester_info';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new OtherSettingsCollection(Semester::orderBy('id','DESC')->paginate(15));
    }

    public function semlist()
    {
        return new OtherSettingsCollection(Semester::get());

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
            'title' => 'required|string|max:191',
        ]);

        $sem = new Semester();
        $sem->title = $request->title;
        $sem->save();

        return new OtherSettingsResource($sem);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OtherSettingsResource(Semester::findOrFail($id));
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
            'title' => 'required|string|max:191',
        ]);

        $sem = Semester::findOrfail($id);
        $sem->title = $request->title;
        $sem->save();

        return new OtherSettingsResource($sem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sem = Semester::findOrfail($id);
        $sem->delete();
        return new OtherSettingsResource($sem);

    }

    public function searchSem($field,$query)
    {
        return new OtherSettingsCollection(Semester::where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }

}
