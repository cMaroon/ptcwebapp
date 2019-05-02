<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\OtherSettingsCollection;
use App\Http\Resources\OtherSettingsResource;

use App\SchoolYear;

class SchoolYearController extends Controller
{
    protected $table = 'school_year';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new OtherSettingsCollection(SchoolYear::orderBy('id','DESC')->paginate(15));
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

        $sy = new SchoolYear();
        $sy->title = $request->title;
        $sy->save();

        return new OtherSettingsResource($sy);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OtherSettingsResource(SchoolYear::findOrFail($id));
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

        $sy = SchoolYear::findOrfail($id);
        $sy->title = $request->title;
        $sy->save();

        return new OtherSettingsResource($sy);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sy = SchoolYear::findOrfail($id);
        $sy->delete();
        return new OtherSettingsResource($sy);

    }

    public function searchSY($field,$query)
    {
        return new OtherSettingsCollection(SchoolYear::where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }

}
