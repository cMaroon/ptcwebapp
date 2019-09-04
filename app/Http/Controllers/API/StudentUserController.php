<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentUserCollection;
use App\Http\Resources\StudentUserResource;

use App\Student;
use App\StudentInformation;

class StudentUserController extends Controller
{
    protected $table = 'users_student';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return new StudentUserCollection(Student::with('studInfo')->orderBy('id','DESC')->paginate(15));
    }

    public function studentlist()
    {
        return new StudentUserCollection(Student::orderBy('lastname','ASC')->get());

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
            'id_num' => 'required|string|max:191|unique:users_student',
            'firstname' => 'required|string|max:191|alpha_spaces',
            'middlename' => 'max:191|alpha_spaces|nullable',
            'lastname' => 'required|string|max:191|alpha_spaces',
            'suffixname' => 'max:191|alpha_spaces|nullable',
            'usertype' => 'required|string',
            'email' => 'required|string|email|max:191|unique:users_student',
            'cd_email' => 'required|string|email|max:191|unique:student_information',
            'password' => 'required|string|min:6',
        ]);

        $student = new Student();
        $student->id_num = $request->id_num;
        $student->email = $request->email;
        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename;
        $student->lastname = $request->lastname;
        $student->suffixname = $request->suffixname;
        $student->password = Hash::make($request->password);
        $student->usertype = $request->usertype;
        $student->save();

        $studentinfo = new StudentInformation();
        $studentinfo->user_id = $request->user_id;
        $studentinfo->id_num = $request->id_num;
        $studentinfo->firstname = $request->firstname;
        $studentinfo->middlename = $request->middlename;
        $studentinfo->lastname = $request->lastname;
        $studentinfo->suffixname = $request->suffixname;
        $studentinfo->cd_email = $request->cd_email;
        $studentinfo->save();
        
        return new StudentUserResource($studentinfo,$student);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new StudentUserResource(Student::findOrFail($id));
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
        $studentinfo = StudentInformation::findOrfail($id);
        $studentinfo->id_num = $request->id_num;
        $studentinfo->firstname = $request->firstname;
        $studentinfo->middlename = $request->middlename;
        $studentinfo->lastname = $request->lastname;
        $studentinfo->suffixname = $request->suffixname;
        $studentinfo->cd_email = $request->cd_email;
        $studentinfo->save();

        $student = Student::findOrfail($id);
        $student->id_num = $request->id_num;
        $student->email = $request->email;
        $student->firstname = $request->firstname;
        $student->middlename = $request->middlename;
        $student->lastname = $request->lastname;
        $student->suffixname = $request->suffixname;
        $student->password = Hash::make($request->password);
        $student->usertype = $request->usertype;
        $student->save();

        return new StudentUserResource($studentinfo,$student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentinfo = StudentInformation::findOrfail($id);
        $student = Student::findOrfail($id);
        $studentinfo->delete();
        $student->delete();
        return new StudentUserResource($studentinfo,$student);
    }

    public function searchInfo($field,$query)
    {
        return new StudentUserCollection(StudentInformation::with('adminUserID')->where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }

    public function searchUser($field,$query)
    {
        return new StudentUserCollection(Student::with('studInfo')->where($field,'LIKE',"%$query%")->latest()
        ->paginate(15));
    }
}
