<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')
            ->whereHas('user', fn ($q) => $q->where('role', 'teacher'))
            ->get()
            ->sortBy(fn ($t) => $t->user->name);

        return view('public.teachers', compact('teachers'));
    }
}
