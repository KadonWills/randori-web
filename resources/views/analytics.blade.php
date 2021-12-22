@extends('layout.app')

@section('title')
@lang('_.analytics')
@endsection


@section('css')

@endsection


@section('main')
<div
class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

<h1 class="h2">@lang('_.analytics')</h1>

<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
        <button type="button" class="btn btn-sm btn-outline-primary"> {{ $nb_courses }} Courses</button>
        <button type="button" class="btn btn-sm btn-outline-secondary"> {{  $nb_members }} Members</button>
        <button type="button" class="btn btn-sm btn-outline-secondary"> {{  $nb_tutors }} Tutors</button>
        <button type="button" class="btn btn-sm btn-outline-secondary"> {{  $nb_admin }} Admin</button>
      </div>
</div>
</div>



<section class="container">
    <div class="row col-12 mx-auto ">

         <div class="col-md-4">
            {!! $usersTypeChart->render() !!}
        </div>
         <div class="col-md-4">
            {!! $usersTypeChart->render() !!}
        </div>
         <div class="col-md-4">
            {!! $usersTypeChart->render() !!}
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
                <th>Username</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



{{-- <div style="width:75%;">
    {!! $chartjs->render() !!}
</div> --}}

@endsection


@section('scripts')


<script type="text/javascript">
    $(function () {

      const table = $('.users-datatable').DataTable({
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
