@extends('layout.app')

@section('title')
@lang('_.dashboard')
@endsection


@section('css')

@endsection


@section('main')
<div
class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">@lang('_.dashboard')</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
        <button type="button" class="btn btn-sm btn-outline-primary"> {{ $nb_courses }} Courses</button>
        <button type="button" class="btn btn-sm btn-outline-secondary"> {{  $nb_members }} Members</button>
        <button type="button" class="btn btn-sm btn-outline-secondary"> {{  $nb_tutors }} Tutors</button>
        <button type="button" class="btn btn-sm btn-outline-secondary"> {{  $nb_admin }} Admin</button>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
    </button>
</div>
</div>



<section class="container">
    <div class="row col-12 mx-auto ">
    <div class="card shadow border-1 bg-theme text-white   col-md-3 float-left" >
        <div class="card-body m-0 p-1 pb-0 ">
        <h6 class="card-title ">
            @lang('_.create_course')
        <span class="ml-auto float-end">
            <div class=" m-0 btn btn-light   btn-sm"> <i class="bx bx-plus"></i> @lang('_.add')</div>
        </span>
    </h6>

      </div>
    </div>
    <div class="card shadow border-1 bg-theme text-white   col-md-3 float-right ml-auto" >
        <div class="card-body m-0 p-1 pb-0 ">
        <h6 class="card-title ">
            @lang('_.create_member')
        <span class="ml-auto float-end">
            <div class=" m-0 btn btn-light   btn-sm" data-toggle="modal" data-target="#createUserModal"> <i class="bx bx-plus"></i> @lang('_.add')</div>
        </span>
    </h6>

      </div>
    </div>
</div>
</section>


<div class="container mt-5">
    <h3 class="mb-4">List of Users</h3>
    <table class="table table-bordered users-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUser" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create a user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>

            <form action="{{route('user.create')}}" method="post">
                    @csrf
            <div class="modal-body">


                    <div class="form-group col-md-6 float-left">
                      <label for="cFirstname">First Name</label>
                      <input type="text" name="firstname" id="cFirstname" class="form-control" placeholder="first name" aria-describedby="firstname">
                      <small id="firstname" class="text-muted"></small>
                    </div>
                    <div class="form-group col-md-6 float-right">
                      <label for="cLastname">Last Name</label>
                      <input type="text" name="lastname" id="cLastname" class="form-control" placeholder="last name" aria-describedby="lastname">
                      <small id="lastname" class="text-muted"></small>
                    </div>
                    <div class="form-group col-md-6 float-left">
                        <label for="cDob">Date of birth</label>
                        <input type="date" name="dob" id="cDob" class="form-control"  aria-describedby="cDob">
                        <small id="cDob" class="text-muted"></small>
                      </div>
                      <div class="form-group col-md-6 float-right">
                        <label for="cTel">Phone number</label>
                        <input type="Tel" name="phone" id="cTel" class="form-control" placeholder="phone number" aria-describedby="cTel">
                        <small id="cTel" class="text-muted"></small>
                      </div>
                    <div class="form-group col-md-6 float-left">
                        <label for="cEmail">Email</label>
                        <input type="email" name="email" id="cEmail" class="form-control" placeholder="email" aria-describedby="email">
                        <small id="cEmail" class="text-muted"></small>
                      </div>
                    <div class="form-group col-md-6 float-right">

                          <label for="cGender">Gender :</label>
                          <select class="form-control" name="gender" id="cGender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                          </select>
                    </div>

                    <hr title="account info" />

                      <div class="form-group col-md-6 float-left">
                        <label for="cLogin">Username/login</label>
                        <input type="text" name="username" id="cLogin" class="form-control" placeholder="login or user name" aria-describedby="clogin">
                        <small id="cLogin" class="text-muted"></small>
                      </div>

                      <div class="form-group col-md-6 float-left">
                        <label for="cPassword">Password </label>
                        <input type="password" name="password" id="cPassword" class="form-control" placeholder="password" aria-describedby="password">
                        <small id="cPassword" class="text-muted"></small>
                      </div>
                      <div class="form-group col-md-6 float-right">
                        <label for="cPassword"> Confirm Password </label>
                        <input type="password" name="cPassword" id="cPassword" class="form-control" placeholder="confirm password" aria-describedby="cCPassword">
                        <small id="cPassword" class="text-muted"></small>
                      </div>
                      <div class="form-group col-md-6 float-left">
                        <label for="cRole">Account type</label>

                          <select class="form-control" name="role" id="cRole">
                            <option value="student" selected>Student / Member</option>
                            <option value="tutor">Legal Tutor</option>
                            <option value="teacher">Teacher</option>
                            <option value="admin">Administrator</option>
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


{{-- <div style="width:75%;">
    {!! $chartjs->render() !!}
</div> --}}

@endsection


@section('scripts')


<script type="text/javascript">
    $(function () {

      let    table = $('.users-datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('dashboard.data') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'firstname', name: 'firstname'},
              {data: 'email', name: 'email'},
              {data: 'role', name: 'role'},
              {data: 'phone', name: 'phone'},
              {data: 'dob', name: 'dob'},
              {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  searchable: false
              },
          ]
      });

    });
  </script>
@endsection
