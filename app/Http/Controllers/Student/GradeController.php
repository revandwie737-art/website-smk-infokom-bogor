<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $grades = $student ? $student->grades()->with("subject")->get() : collect();
        return view("student.grades", compact("grades", "student"));
    }
}
