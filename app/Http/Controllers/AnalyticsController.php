<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseEvent;
use App\Models\User;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{

    public function index()
    {

        $nb_courses = Course::all()->count();
        $nb_members = User::all()->where('role', '=', "student")->count();
        $nb_admin = User::all()->where('role', '=', "admin")->count();
        $nb_teachers = User::all()->where('role', '=', "teacher")->count();
        $nb_tutors = User::all()->where('role', '=', "tutor")->count();
        $users = User::all();


        $usersTypeChart = app()->chartjs
            ->name('barChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Students', 'Tutor(s)', 'Teacher(s)', 'Administrator(s)'])
            ->datasets([
                [
                    "label" => "User account types",
                    'backgroundColor' => ['rgba(255, 30, 20, 0.7)', 'rgba(255, 100, 11, 0.5)', 'rgba(254, 200, 11, 0.5)','rgba(54, 200, 10, 0.5)' , 'rgba(54, 162, 235, 0.5)'],
                    'data' => [$nb_members, $nb_tutors,  $nb_teachers, $nb_admin]
                ],

            ])
            ->options([
            ]);

        return view('analytics', compact('nb_courses', 'nb_members', 'nb_teachers', 'nb_tutors', 'nb_admin', 'usersTypeChart'));
    }
}
