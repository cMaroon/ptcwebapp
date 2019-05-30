<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\OtherSettingsCollection;
use App\Http\Resources\OtherSettingsResource;

use App\ResidencyCategory;

class ResidencyCategoryController extends Controller
{
    protected $table = 'residency_category';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new OtherSettingsCollection(ResidencyCategory::orderBy('id','DESC')->paginate(15));
    }

    public function rclist()
    {
        return new OtherSettingsCollection(ResidencyCategory::orderBy('id','ASC')->get());

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
            'description' => 'required|string|max:191',
        ]);

        $rc = new ResidencyCategory();
        $rc->title = $request->title;
        $rc->description = $request->description;
        $rc->save();

        return new OtherSettingsResource($rc);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OtherSettingsResource(ResidencyCategory::findOrFail($id));
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
            'description' => 'required|string|max:191',
        ]);

        $rc = ResidencyCategory::findOrfail($id);
        $rc->title = $request->title;
        $rc->description = $request->description;
        $rc->save();

        return new OtherSettingsResource($rc);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rc = ResidencyCategory::findOrfail($id);
        $rc->delete();
        return new OtherSettingsResource($rc);

    }

    public function searchRC($field,$query)
    {
        return new OtherSettingsCollection(ResidencyCategory::where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }

}
