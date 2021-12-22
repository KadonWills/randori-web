<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $courses = Course::all();
        $nb_available_courses = Course::all()->where('is_available', True)->count();
        $nb_not_available_courses = Course::all()->where('is_available', False)->count();

        return view('course', compact('nb_available_courses', 'nb_not_available_courses'));
    }


    /**
     * Return offered courses data for datatable
     *
     */
    public function getOfferedCoursesDT(Request $request)
    {
        if ($request->ajax()) {
            $data = Course::all();



            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
