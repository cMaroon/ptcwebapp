<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminUserCollection;
use App\Http\Resources\AdminUserResource;

use App\Admin;
use App\AdminInformation;

class AdminUserController extends Controller
{
    protected $table = 'users_admin';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return new AdminUserCollection(Admin::latest()->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'id_num' => 'required|string|max:191|unique:users_admin',
        //     'firstname' => 'required|string|max:191|alpha_spaces',
        //     'middlename' => 'max:191|alpha_spaces|nullable',
        //     'lastname' => 'required|string|max:191|alpha_spaces',
        //     'email' => 'required|string|email|max:191|unique:users_admin',
        //     'password' => 'required|string|min:6',
        // ]);

        $admininfo = new AdminInformation();
        // $admininfo->user_id = $request->user_id;
        $admininfo->firstname = $request->firstname;
        $admininfo->middlename = $request->middlename;
        $admininfo->lastname = $request->lastname;
        $admininfo->suffixname = $request->suffixname;
        $admininfo->admin_type = $request->admin_type;
        $admininfo->save();

        $admin = new Admin();
        $admin->id_num = $request->id_num;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->usertype = $request->usertype;
        $admin->save();

        return new AdminUserResource($admininfo,$admin);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new AdminUserResource(Admin::findOrFail($id));
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
        $admininfo = AdminInformation::findOrfail($id);
        // $admininfo->user_id = $request->user_id;
        $admininfo->firstname = $request->firstname;
        $admininfo->middlename = $request->middlename;
        $admininfo->lastname = $request->lastname;
        $admininfo->suffixname = $request->suffixname;
        $admininfo->admin_type = $request->admin_type;
        $admininfo->save();

        $admin = Admin::findOrfail($id);
        $admin->id_num = $request->id_num;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->usertype = $request->usertype;
        $admin->save();

        return new AdminUserResource($admininfo,$admin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admininfo = AdminInformation::findOrfail($id);
        $admin = Admin::findOrfail($id);
        $admininfo->delete();
        $admin->delete();
        return new AdminUserResource($admininfo,$admin);
    }

    public function search($field,$query)
    {
        
    }
}
