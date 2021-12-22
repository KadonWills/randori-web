@extends('layout.app')

@section('title')
@lang('_.course')
@endsection


@section('css')

@endsection


@section('main')
<div
class=" pt-3 pb-2 mb-3 border-bottom">

<div class="btn-toolbar mb-2 mb-md-0 float-end ml-auto">
    <div class="btn-group mr-2">
        <button type="button" class="btn btn-sm btn-outline-primary"> Total Courses :{{ $nb_not_available_courses + $nb_available_courses }}  </button>
        <button type="button" class="btn btn-sm btn-outline-danger"> {{ $nb_not_available_courses }} Not available Courses </button>
        <button type="button" class="btn btn-sm btn-outline-success"> {{ $nb_available_courses }} Available Courses </button>
    </div>

</div>
</div>



<section class=" container">
    <div class=" row">
    <div class="card shadow-0 border-0  text-white  ml-auto col-md-3 float-right" >
        <div class="card-body m-0 p-1 pb-0 ">
        <h6 class="card-title ">
        <span class="ml-auto float-right">
            <div class=" m-0 btn btn-dark  bg-theme btn-sm"> <i class="bx bx-plus"></i> @lang('_.add') </div>
        </span>
    </h6>

      </div>
    </div>

    </div>

</section>


<div class="container mt-5">
    <h3 class="mb-4">List of Courses</h3>
    <table class="table table-bordered courses-dt" id="courses-dt">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Available</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        <tfoot></tfoot>
    </table>
</div>



{{-- <div style="width:75%;">
    {!! $chartjs->render() !!}
</div> --}}

@endsection


@section('scripts')


<script type="text/javascript"  >
    $(function () {
  $('#courses-dt').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('courses.data')}}",
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'title', name: 'title'},
              {data: 'description' , name: 'description'},
              {data: 'is_available', name: 'is_availabile'},
              {data: 'created_at', name: 'created_at'},
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
