@extends('layout.app')

@section('title')
@lang('_.members')
@endsection


@section('css')

@endsection


@section('main')
<div
class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">@lang('_.members')</h1>
<div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
        <button type="button" class="btn btn-sm btn-outline-secondary"> {{  $nb_members }} Members</button>

    </div>

</div>
</div>



<section class="container">
    <div class="row col-12 mx-auto ">

    <div class="card shadow-0 border-0 text-white w-auto float-right ml-auto" >
        <div class="card-body m-0 p-1 pb-0 ">
        <h6 class="card-title ">
        <span class="ml-auto float-end float-right"> &nbsp;
            <div class=" m-0 btn btn-dark bg-theme   btn-sm"> <i class="bx bx-plus"></i> @lang('_.add')</div>
        </span>
    </h6>

      </div>
    </div>
</div>
</section>





<div class="container mt-5">
    <h3 class="mb-4">List of Students</h3>
    <table class="table table-bordered students-dt">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>







@endsection


@section('scripts')


<script type="text/javascript">
    $(function () {

      let table = $('.students-dt').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('students.data') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'firstname', name: 'firstname'},
              {data: 'email', name: 'email'},
              {data: 'phone', name: 'phone'},
              {data: 'dob', name: 'dob'},
              {data: 'gender', name: 'gender'},
              {data: 'status', name: 'status'},
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
