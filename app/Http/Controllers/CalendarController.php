<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Descriptor\Descriptor;

class CalendarController extends Controller
{

    public function index()
    {
    $courses = Course::all();

        return view('calendar', compact('courses'));
    }


    public function getEvents()
    {
        return json_encode(CourseEvent::all()) ;
    }

    /**
     * Creates a new course event from the given request
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
    * @author Kapol Brondon <kapolw@gmail.com>
     */
    public function store( Request $request)
    {
        $courseEvent = [];
        $courseEvent["description"] = $request->title;
        $courseEvent["start_time"] = $request->start;
        $courseEvent["end_time"] = $request->end;
        $courseEvent["user_id"] = $request->user;
        $courseEvent["course_offer_id"] = $request->course;
        $courseEvent["space"] = $request->space;
        $courseEvent["capacity"] = $request->capacity;

        if (CourseEvent::store($courseEvent)){
            return response()->json( [ 'success' => true ] );
        } else {
            return response()->json( [ 'success' => false ] );
        }


    }
}
