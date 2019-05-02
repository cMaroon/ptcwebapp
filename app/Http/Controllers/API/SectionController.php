<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\OtherSettingsCollection;
use App\Http\Resources\OtherSettingsResource;

use App\Section;

class SectionController extends Controller
{
    protected $table = 'section_info';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new OtherSettingsCollection(Section::orderBy('id','DESC')->paginate(15));
    }

    public function sectionlist()
    {
        return new OtherSettingsCollection(Section::get());

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

        $sec = new Section();
        $sec->title = $request->title;
        $sec->save();

        return new OtherSettingsResource($sec);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OtherSettingsResource(Section::findOrFail($id));
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

        $sec = Section::findOrfail($id);
        $sec->title = $request->title;
        $sec->save();

        return new OtherSettingsResource($sec);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sec = Section::findOrfail($id);
        $sec->delete();
        return new OtherSettingsResource($sec);

    }

    public function searchSEC($field,$query)
    {
        return new OtherSettingsCollection(Section::where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }

}
