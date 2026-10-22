<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassMember;
use Illuminate\Support\Facades\Auth;

class ClassmatesController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $members = collect();

        if ($student && $student->class_id) {
            $members = ClassMember::where("class_id", $student->class_id)
                ->orderBy("sort_order")->get();
        }

        return view("student.classmates", compact("members", "student"));
    }
}
