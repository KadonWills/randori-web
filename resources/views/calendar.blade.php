@extends('layout.app')

@section('title')
    @lang('_.calendar')
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('lib/main.css') }}">

    <style>
        .fc-h-event {
            background: var(--theme);
            /* color: var(--theme) !important;
           var(--theme);*/
            border: 2px solid transparent;
        }

        .fc-daygrid-event-dot {
            border-color: red;
        }

    </style>
@endsection


@section('main')
    <div class="container p-5">
        <div id='calendar'>
            <h3 id='loading'>loading...</h3>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#scheduleCourseModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="scheduleCourseModal" tabindex="-1" role="dialog" aria-labelledby="scheduleCourse"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Schedule a Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="scheduleCourseForm">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 mb-5">
                                    <em> <span class="font-weight-bold text-justify" id="selectedPeriod"></span> </em>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="course">Course</label>
                                        <select class="form-control" id="course">
                                            <option>Select a course</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="course">Available Space</label>
                                        <select class="form-control" id="space">
                                            <option>Course Space</option>
                                            @foreach( range(1,40) as $nb)
                                                <option value="{{ $nb}}">{{ $nb }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="course">Course Capacity</label>
                                        <select class="form-control" id="capacity">
                                            <option>Select Course capacity</option>
                                            @foreach( range(1,40) as $nb)
                                                <option value="{{ $nb}}">{{ $nb }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });
    </script>
@endsection


@section('scripts')

    <script src="{{ asset('lib/main.js') }}"></script>
    <script src="{{ asset('lib/locales-all.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let initialLocaleCode = document.getElementsByTagName('html')[0].lang
            let localeSelectorEl = document.getElementById('locale-selector');
            const calendarEl = document.getElementById('calendar');

            var courseEvents = [];


            fetch(`{{ route('calendar.events') }}`)
                .then(raw => raw.json())
                .then(res => data = res)
                .then(() => {

                    data.forEach((e) => {
                        // add calender attributes  from attributes from the database
                        e.title = e.description;
                        e.start = e.start_time;
                        if (e.end_time) e.end = e.end_time;
                    });


                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                        },
                        initialDate: new Date(),
                        locale: initialLocaleCode,
                        buttonIcons: true,
                        navLinks: true, // can click day/week names to navigate views
                        selectable: true,
                        selectMirror: true,
                        select: function(arg) {
                            $('#selectedPeriod').text( `From ${arg.start} \n to ${arg.end} \n ${arg.allDay ? "(All day)" : ""}  `)
                            $('#scheduleCourseModal').modal('show');
                           // var title = prompt('Event Title:');

                        //Course scheduling Modal form submission
                        $('#scheduleCourseForm').submit(function (e) {
                            e.preventDefault();

                            let courseId = $('#course').val();
                            title = $('#course option:selected').text();
                            space = $('#course #space').text();
                            capacity = $('#course #capacity').text();

                            if (title) {
                                let eventData = {
                                    title: title,
                                    description: title,
                                    start: arg.start,
                                    end: arg.end,
                                    allDay: arg.allDay,
                                    user: 1,
                                    course: courseId
                                }

                              $.ajax({
                                  type: "post",
                                  url: "{{route('calendar.store')}}",
                                  data: eventData,
                                  dataType: "dataType",
                                  success: function (response) {
                                      alert(response);
                                         calendar.addEvent({eventData})
                                  }
                              });
                              $('#scheduleCourseModal').modal('hide');
                            $('#scheduleCourseForm').reset;
                            }

                            calendar.unselect()
                        });

                        },
                        eventClick: function(arg) {
                            if (confirm('Are you sure you want to delete this event?')) {
                                arg.event.remove()
                            }
                        },
                        editable: true,
                        dayMaxEvents: true, // allow "more" link when too many events
                        events: data

                    });

                    calendar.render();
                    document.querySelector('#loading').innerText = "";


                });


        });
        /*[
                  {
                    title: 'All Day Event',
                    start: '2020-09-01'
                  },
                  {
                    title: 'Long Event',
                    start: '2020-09-07',
                    end: '2020-09-10'
                  },
                  {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2020-09-09T16:00:00'
                  },
                  {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2020-09-16T16:00:00'
                  },
                  {
                    title: 'Conference',
                    start: '2020-09-11',
                    end: '2020-09-13'
                  },
                  {
                    title: 'Meeting',
                    start: '2020-09-12T10:30:00',
                    end: '2020-09-12T12:30:00'
                  },
                  {
                    title: 'Lunch',
                    start: '2020-09-12T12:00:00'
                  },
                  {
                    title: 'Meeting',
                    start: '2020-09-12T14:30:00'
                  },
                  {
                    title: 'Happy Hour',
                    start: '2020-09-12T17:30:00'
                  },
                  {
                    title: 'Dinner',
                    start: '2020-09-12T20:00:00'
                  },
                  {
                    title: 'Birthday Party',
                    start: '2020-09-13T07:00:00'
                  },
                  {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2020-09-28'
                  }
                ]*/
    </script>

@endsection
