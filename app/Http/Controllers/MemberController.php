<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    
    public function students()
    {
        $nb_members = User::all()->where('role', '=',"student" )->count();
        return view('student', compact(  'nb_members'));
    }

    public function trainers()
    {
        $nb_members = User::all()->where('role', '=',"teacher" )->count();
        return view('trainer', compact(  'nb_members'));
    }



}
