<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\InstructorUserCollection;
use App\Http\Resources\InstructorUserResource;

use App\Instructor;
use App\InstructorInformation;

class InstructorUserController extends Controller
{
    protected $table = 'users_instructor';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return new InstructorUserCollection(Instructor::with('instructorInfo')->orderBy('id','DESC')->paginate(15));
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
            'id_num' => 'required|string|max:191|unique:users_instructor',
            'firstname' => 'required|string|max:191|alpha_spaces',
            'middlename' => 'max:191|alpha_spaces|nullable',
            'lastname' => 'required|string|max:191|alpha_spaces',
            'suffixname' => 'max:191|alpha_spaces|nullable',
            'usertype' => 'required|string',
            'email' => 'required|string|email|max:191|unique:users_instructor',
            'password' => 'required|string|min:6',
        ]);

        $ins = new Instructor();
        $ins->id_num = $request->id_num;
        $ins->email = $request->email;
        $ins->firstname = $request->firstname;
        $ins->middlename = $request->middlename;
        $ins->lastname = $request->lastname;
        $ins->suffixname = $request->suffixname;
        $ins->password = Hash::make($request->password);
        $ins->usertype = $request->usertype;
        $ins->save();

        $insinfo = new InstructorInformation();
        $insinfo->user_id = $request->user_id;
        $insinfo->firstname = $request->firstname;
        $insinfo->middlename = $request->middlename;
        $insinfo->lastname = $request->lastname;
        $insinfo->suffixname = $request->suffixname;
        $insinfo->save();
        
        return new InstructorUserResource($insinfo,$ins);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new InstructorUserResource(Instructor::findOrFail($id));
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
        $insinfo = InstructorInformation::findOrfail($id);
        // $admininfo->user_id = $request->user_id;
        $insinfo->firstname = $request->firstname;
        $insinfo->middlename = $request->middlename;
        $insinfo->lastname = $request->lastname;
        $insinfo->suffixname = $request->suffixname;
        $insinfo->save();

        $ins = Instructor::findOrfail($id);
        $ins->id_num = $request->id_num;
        $ins->email = $request->email;
        $ins->firstname = $request->firstname;
        $ins->middlename = $request->middlename;
        $ins->lastname = $request->lastname;
        $ins->suffixname = $request->suffixname;
        $ins->password = Hash::make($request->password);
        $ins->usertype = $request->usertype;
        $ins->save();

        return new InstructorUserResource($insinfo,$ins);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $insinfo = InstructorInformation::findOrfail($id);
        $ins = Instructor::findOrfail($id);
        $insinfo->delete();
        $ins->delete();
        return new InstructorUserResource($insinfo,$ins);
    }

    public function searchInfo($field,$query)
    {
        return new InstructorUserCollection(InstructorInformation::with('instructorUserID')->where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }

    public function searchUser($field,$query)
    {
        return new InstructorUserCollection(Intructor::with('instructorInfo')->where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }
}
