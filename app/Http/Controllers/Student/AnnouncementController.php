<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::active()->latest()->paginate(10);
        return view("student.announcements", compact("announcements"));
    }
}
