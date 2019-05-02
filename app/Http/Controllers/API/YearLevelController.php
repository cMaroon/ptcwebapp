<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\OtherSettingsCollection;
use App\Http\Resources\OtherSettingsResource;

use App\YearLevel;

class YearLevelController extends Controller
{
    protected $table = 'yearlevel_info';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new OtherSettingsCollection(YearLevel::orderBy('id','DESC')->paginate(15));
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

        $yl = new YearLevel();
        $yl->title = $request->title;
        $yl->save();

        return new OtherSettingsResource($yl);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OtherSettingsResource(YearLevel::findOrFail($id));
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

        $yl = YearLevel::findOrfail($id);
        $yl->title = $request->title;
        $yl->save();

        return new OtherSettingsResource($yl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $yl = YearLevel::findOrfail($id);
        $yl->delete();
        return new OtherSettingsResource($yl);

    }

    public function searchYearLevel($field,$query)
    {
        return new OtherSettingsCollection(YearLevel::where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }

}
