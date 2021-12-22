<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseOffer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Routing\Route;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $nb_courses = Course::all()->count();
        $nb_members = User::all()->where('role', '=',"student" )->count();
         $nb_admin= User::all()->where('role', '=',"admin" )->count();
         $nb_teachers= User::all()->where('role', '=',"teacher" )->count();
         $nb_tutors= User::all()->where('role', '=',"tutor" )->count();
        // $users = User::all();

        return view('dashboard', compact('nb_courses', 'nb_members', 'nb_teachers', 'nb_tutors', 'nb_admin'));
    }


    public function getUsersDT(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {return $this->userActionModals($row);})
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getStudentsDT(Request $request)
    {
        if ($request->ajax()) {

            $data = User::all()->where('role', "student");
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',  function($row) {return $this->userActionModals($row);})
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function getTrainersDT(Request $request)
    {
        if ($request->ajax()) {

            $data = User::all()->where('role', "teacher");
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action',  function($row) {return $this->userActionModals($row);})
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function create(Request $request)
    {
        $user =  array(
            'firstname' => $request->firstname ,
            "lastname" => $request->lastname ,
            "username" => $request->username ,
            'email' => $request->email ,
            'phone' => $request->phone ,
            'dob' => $request->dob ,
            'gender' => $request->gender ,
            'password' => Hash::make($request->password) ,
            'role' => $request->role ,
        );

     $created_user = User::create( $user );

      return  redirect()->back()->withInput($created_user );
    }


    public function delete(Request $request)
    {
        $isDeleted = User::where('id', $request->id)->first()->delete();
      return  redirect()->back()->withInput( $isDeleted);
    }


    public function edit(Request $request)
    {
        $previousUserData = User::where("id", json_decode($request->user)->id)->first();

        $defaultPassword = $previousUserData->password;

        $password = ($request->password == "" ||  Hash::make($request->password)== $defaultPassword ) ?
                                  $defaultPassword :  Hash::make($request->password);

        $user_data =  array(
            'firstname' => $request->firstname ,
            "lastname" => $request->lastname ,
            "username" => $request->username ,
            'email' => $request->email ,
            'phone' => $request->phone ,
            'dob' => $request->dob ? $request->dob  :  $previousUserData->dob, //date(now()),
            'gender' => $request->gender ,
            'password' => $password,
            'role' => $request->role ,
           'id' => (int) $previousUserData->id
        );

      $previousUserData->update($user_data, ['id' => (int) $previousUserData->id]);

      Log::info("User [ ". $request->username ." ] infos has been updated successfully.");

      return  redirect()->back();
    }


    function userActionModals($row){
      $actionBtn = '
      <button data-toggle="modal" data-target="#viewUserModal-'. $row->id .'" class="view btn btn-secondary btn-sm"><i class="bx bx-show"></i></button>
      <button data-toggle="modal" data-target="#editUserModal-'.$row->id.'"  class="edit btn btn-secondary btn-sm"><i class="bx bx-edit"></i></button>
      <button data-toggle="modal" data-target="#deleteUserModal-'. $row->id .'" class="delete btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>

      <!-- Edit User Modal -->
<div class="modal fade" id="editUserModal-'. $row->id .'" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
  <h5 class="modal-title">Edit user '. $row->username .'</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
</div>

<form action="'.route("user.edit").'" method="post">
      '. csrf_field() .'
<div class="modal-body">
      <input type="hidden"  name="user" value= '.$row.' />

      <div class="form-group col-md-6 float-left">
        <label for="eFirstname">First Name</label>
        <input type="text" name="firstname" id="eFirstname" value="'. $row->firstname .'"  class="form-control" placeholder="first name" aria-describedby="firstname">
        <small id="firstname" class="text-muted"></small>
      </div>
      <div class="form-group col-md-6 float-right">
        <label for="eLastname">Last Name</label>
        <input type="text" name="lastname" id="eLastname" value="'. $row->lastname .'"  class="form-control" placeholder="last name" aria-describedby="lastname">
        <small id="lastname" class="text-muted"></small>
      </div>
      <div class="form-group col-md-6 float-left">
          <label for="eDob">Date of birth</label>
          <input type="date" name="dob" id="eDob" class="form-control"  aria-describedby="eDob">
          <small id="eDob" class="text-muted"></small>
        </div>
        <div class="form-group col-md-6 float-right">
          <label for="eTel">Phone number</label>
          <input type="Tel" name="phone" id="eTel" value="'. $row->phone.'"  class="form-control" placeholder="phone number" aria-describedby="cTel">
          <small id="eTel" class="text-muted"></small>
        </div>
      <div class="form-group col-md-6 float-left">
          <label for="eEmail">Email</label>
          <input type="email" name="email" id="eEmail" value="'. $row->email .'"  class="form-control" placeholder="email" aria-describedby="email">
          <small id="eEmail" class="text-muted"></small>
        </div>
      <div class="form-group col-md-6 float-right">

            <label for="eGender">Gender :</label>
            <select class="form-control" name="gender" id="eGender">
              <option '. ($row->gender == "male" ? "selected": '' ).' value="male">Male</option>
              <option '. ($row->gender == "female" ? "selected": '' ).' value="female">Female</option>
              <option '. ($row->gender == "other" ? "selected": '' ).' value="other">Other</option>
            </select>
      </div>

      <hr title="account info" />

        <div class="form-group col-md-6 float-left">
          <label for="eLogin">Username/login</label>
          <input type="text" name="username" id="eLogin" value="'. $row->username .'" class="form-control" placeholder="login or user name" aria-describedby="clogin">
          <small id="eLogin" class="text-muted"></small>
        </div>

        <div class="form-group col-md-6 float-left">
          <label for="ePassword">Password </label>
          <input type="password" name="password" id="ePassword" class="form-control" placeholder="password" aria-describedby="password">
          <small id="ePassword" class="text-muted"></small>
        </div>
        <div class="form-group col-md-6 float-right">
          <label for="ePassword"> Confirm Password </label>
          <input type="password" name="eCPassword" id="ePassword" class="form-control" placeholder="confirm password" aria-describedby="cCPassword">
          <small id="ePassword" class="text-muted"></small>
        </div>
        <div class="form-group col-md-6 float-left">
          <label for="eRole">Account type</label>

            <select class="form-control" name="role" id="eRole">
              <option  '. ($row->role == "student" ? "selected": '' ).' value="student">Student / Member</option>
              <option  '. ($row->role == "tutor" ? "selected": '' ).' value="tutor">Legal Tutor</option>
              <option  '. ($row->role == "teacher" ? "selected": '' ).' value="teacher">Teacher</option>
              <option  '. ($row->role == "admin" ? "selected": '' ).' value="admin">Administrator</option>
            </select>
          </div>


</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Save</button>
</div>
</form>

</div>
</div>
</div>


<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal-'. $row->id .'" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm " role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Delete User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid text-center">
                    <h4 class="text-danger">Are you sure ?</h4>
                    You are about to delete the '. $row->role .'  <b>'. $row->firstname .'</b>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="'.route("user.delete").'" method="post">
                '. csrf_field() .'
                <input type="hidden" value="'.$row->id.'" name="id"/>
                <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- View User Modal -->
<div class="modal fade" id="viewUserModal-'. $row->id .'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> User Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="row cols-col-2">
                    <div class="col-12 m-1"><b>Firstname: </b>'. $row->firstname .'</div>
                    <div class="col -12 m-1"><b>Lastname: </b>'. $row->lastname .'</div>
                    <div class="col-12 m-1"><b>Email: </b>'. $row->email .'</div>
                    <div class="col-12  m-1"><b>Phone: </b>'. $row->phone .'</div>
                    <div class="col-12 m-1"><b>Date of birth: </b>'. $row->dob .'</div>
                    <div class="col  m-1"><b>Verified?: </b>'. ($row->verified? "YES" : "NO").'</div>
                    <div class="col m-1 "><b>Status: </b> <span  class=" text-'.( ($row->status == "ACTIVE") ? "success":"danger") .'">'.  $row->status .'</span></div>
                    <div class="col m-1"><b>role: </b>  <span class="badge badge-md badge-pill btn-'.( ($row->role == "admin") ? "dark":"primary") .'"> '. strtoupper($row->role) .'</span></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

';
      return $actionBtn;
  }
}
